<?php
declare(strict_types=1);

namespace App\Controller;

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
        var_dump($workspaces);
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
            'contain' => ['Users', 'Categories', 'Logs'],
        ]);

        $this->set(compact('workspace'));
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
            $workspace->admin=1;
            var_dump($workspace->admin);
            if ($this->Workspaces->save($workspace)) {
                $this->Flash->success(__('The workspace has been saved.'));

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
}
