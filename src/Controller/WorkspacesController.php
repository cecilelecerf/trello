<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Workspaces Controller
 *
 * @property \App\Model\Table\WorkspacesTable $Workspaces
 * @method \App\Model\Entity\Workspace[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WorkspacesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
        $this->Authorization->skipAuthorization();
        $workspaces = $this->Workspaces->findByAdmin($this->request->getAttribute('identity')->id);
        // les transmets à la vue



        $this->set(compact('workspaces'));
    }

    /**
     * View method
     *
     * @param string|null $id Workspace id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $workspace = $this->Workspaces->get($id, [
            'contain' => ['Users', 'Categories.Cards.Managinguser', 'Logs', 'Categories.Cards.Creatoringuser'],
        ]);
        
        
        $this->Authorization->skipAuthorization();
         
        $users = $this->fetchTable('Users')->find('list')->all();
        
        $category = TableRegistry::getTableLocator()->get('Categories');
        $newCategory = $category->newEmptyEntity();  
        $editCategory = $category->get($id);
        $categoriesList = $this->fetchTable('Categories')->find('list', [
            'conditions' => ['Categories.workspace_id' => $workspace->id],
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $membersList = $this->fetchTable('Users')->find('list', [
            'keyField' => 'id',
            'valueField' => 'username'
        ])->notMatching('UsersWorkspaces', function ($q) use ($id) {
            return $q->where(['UsersWorkspaces.workspace_id' => $id]);
        });

        $memberList = $this->fetchTable('Users')->find('list', [
            'keyField' => 'id',
            'valueField' => 'username'
        ])->matching('UsersWorkspaces', function ($q) use ($id) {
            return $q->where(['UsersWorkspaces.workspace_id' => $id]);
        });

        $cards = TableRegistry::getTableLocator()->get('Cards');
        $newCards = $cards->newEmptyEntity();   

        $usersworkspaces = $this->fetchTable('UsersWorkspaces');
        $usersworkspacesList = $usersworkspaces->find('list')->all();
        $newGuest = $usersworkspaces->newEmptyEntity(); 

        $this->set(compact(['workspace', 'newCards', 'newCategory', 'editCategory', 'newGuest', 'users', 'categoriesList', 'membersList', 'memberList'] ));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $workspace = $this->Workspaces->newEmptyEntity();
        // $this->Authorization->authorize($workspace);
        if ($this->request->is('post')) {
            $workspace = $this->Workspaces->patchEntity($workspace, $this->request->getData());
            $workspace->admin= $this->request->getAttribute('identity')->id;
            if ($this->Workspaces->save($workspace)) {
                $this->Flash->success(__('The workspace has been saved.'));
                $logs = $this->getTableLocator()->get('Logs');
                $newLogs = $logs->newEntity([
                    'content' => $workspace->name.': workspace créée',
                    'user_id' => $this->request->getAttribute('identity')->id,
                    'workspace_id' => $this->request->getData('workspace_id'),
                ]);
                $logs->save($newLogs);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workspace could not be saved. Please, try again.'));
        }
        $users = $this->Workspaces->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('workspace', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Workspace id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $this->Authorization->skipAuthorization();
        $workspace = $this->Workspaces->get($id, [
            'contain' => ['Users'],
        ]);
        $membersList = $this->fetchTable('Users')->find('list', [
            'keyField' => 'id',
            'valueField' => 'username'
        ])->notMatching('UsersWorkspaces', function ($q) use ($id) {
            return $q->where(['UsersWorkspaces.workspace_id' => $id]);
        });
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workspace = $this->Workspaces->patchEntity($workspace, $this->request->getData());
            $this->Authorization->authorize($workspace);
            if ($this->Workspaces->save($workspace)) {
                $this->Flash->success(__('The workspace has been saved.'));
                $logs = $this->getTableLocator()->get('Logs');
                $newLogs = $logs->newEntity([
                    'content' => $workspace->name.': workspace modifiée',
                    'user_id' => $this->request->getAttribute('identity')->id,
                    'workspace_id' => $this->request->getData('workspace_id'),
                ]);
                $logs->save($newLogs);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workspace could not be saved. Please, try again.'));
        }
        $users = $this->Workspaces->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('workspace', 'users', 'membersList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Workspace id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workspace = $this->Workspaces->get($id);
        $this->Authorization->authorize($workspace);
        if ($this->Workspaces->delete($workspace)) {
            $this->Flash->success(__('The workspace has been deleted.'));
        } else {
            $this->Flash->error(__('The workspace could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function deleteGuests($id = null){    
        $this->Authorization->skipAuthorization(); 
        $this->request->allowMethod(['post', 'delete']);
        $usersworkspaces = $this->fetchTable('UsersWorkspaces');
        $guest = $usersworkspaces->get($id);
        $workspaceId = $guest->workspace_id;
        if ($usersworkspaces->delete($guest)) {
            $this->Flash->success(__('The guest has been deleted.'));
        } else {
            $this->Flash->error(__('The guest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $workspaceId]);
    }

    public function addGuest(){
        $this->Authorization->skipAuthorization(); 
        $usersworkspaces = $this->fetchTable('UsersWorkspaces');
        $guest = $usersworkspaces->newEmptyEntity();
        if ($this->request->is('post')) {
            $guest = $usersworkspaces->patchEntity($guest, $this->request->getData());
            $workspaceId = $guest->workspace_id;
            if ($usersworkspaces->save($guest)) {
                $this->Flash->success(__('The guest has been saved.'));
            } else{
                $this->Flash->error(__('The guest could not be saved. Please, try again.'));
            }
        }
        return $this->redirect(['action' => 'view', $workspaceId]);
    }

}
