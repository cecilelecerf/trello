<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logs = $this->getTableLocator()->get('Logs');


        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'), ['class' => 'alert alert-success']);
                $newLogs = $logs->newEntity([
                    'content' =>  $category->name.' : catégorie créée',
                    'user_id' => $this->request->getAttribute('identity')->id,
                    'workspace_id' => $category->workspace_id,
                ]);
                $logs->save($newLogs);

            }
            else{
                $this->Flash->error(__('The category could not be saved. Please, try again.'), ['class'=>'alert alert-error']);
            }
        }
        return $this->redirect(['controller'=>'Workspaces', 'action' => 'view', $this->request->getData('workspace_id')]);
        $workspaces = $this->Categories->Workspaces->find('list', ['limit' => 200])->all();
        $this->set(compact('category', 'workspaces'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logs = $this->getTableLocator()->get('Logs');

        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'), ['class'=>'alert alert-success']);
                $newLogs = $logs->newEntity([
                    'content' => $category->name.': catégorie modifiée',
                    'user_id' => $this->request->getAttribute('identity')->id,
                    'workspace_id' => $category->workspace_id,
                ]);
                $logs->save($newLogs);

                return $this->redirect(['controller'=>'Workspaces','action' => 'view', $category->workspace_id]);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'), ['class' => 'alert alert-error']);
        }
        $workspaces = $this->Categories->Workspaces->find('list', ['limit' => 200])->all();
        $this->set(compact('category', 'workspaces'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $logs = $this->getTableLocator()->get('Logs');
        
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'), ['class'=> 'alert alert-success']);
            $newLogs = $logs->newEntity([
                'content' => $category->name.' : catégorie suprimée',
                'user_id' => $this->request->getAttribute('identity')->id,
                'workspace_id' => $category->workspace_id,
            ]);
            $logs->save($newLogs);
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'), ['class'=>'alert alert-error']);
        }

        return $this->redirect(['action' => 'index']);
    }
}
