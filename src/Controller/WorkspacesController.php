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


        $categories = TableRegistry::getTableLocator()->get('Categories');
        $cards = TableRegistry::getTableLocator()->get('Cards');
        $usersworkspaces = $this->fetchTable('UsersWorkspaces');
        
        $users = $this->fetchTable('Users')->find('list')->all();
        
        $categoriesList = $categories->find('list')->all();
        $newCategory = $categories->newEmptyEntity();  
        $newCards = $cards->newEmptyEntity();   
        $newGuest = $usersworkspaces->newEmptyEntity();
        $editCategory = $categories->get($id);

        $this->set(compact(['workspace', 'newCards', 'newCategory', 'editCategory', 'newGuest', 'users', 'categoriesList'] ));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $workspace = $this->Workspaces->newEmptyEntity();
        if ($this->request->is('post')) {
            $workspace = $this->Workspaces->patchEntity($workspace, $this->request->getData());
            $workspace->admin= $this->request->getAttribute('identity')->id;
            var_dump($workspace->admin);
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
        $workspace = $this->Workspaces->get($id, [
            'contain' => ['Users'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workspace = $this->Workspaces->patchEntity($workspace, $this->request->getData());
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
        $this->set(compact('workspace', 'users'));
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
        if ($this->Workspaces->delete($workspace)) {
            $this->Flash->success(__('The workspace has been deleted.'));
        } else {
            $this->Flash->error(__('The workspace could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function deleteGuests($id = null){     
        $this->request->allowMethod(['post', 'delete']);
        $usersworkspaces = $this->fetchTable('UsersWorkspaces');
        $guest = $usersworkspaces->get($id);
        var_dump($guest);
        $workspaceId = $guest->workspace_id;
        if ($usersworkspaces->delete($guest)) {
            $this->Flash->success(__('The guest has been deleted.'));
        } else {
            $this->Flash->error(__('The guest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $workspaceId]);
    }

    public function addGuest(){

    }

}
