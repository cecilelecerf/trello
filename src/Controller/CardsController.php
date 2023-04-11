<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CardsController extends AppController
{

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $card = $this->Cards->newEmptyEntity();
        if ($this->request->is('post')) {
            $card = $this->Cards->patchEntity($card, $this->request->getData());
            if ($this->Cards->save($card)) {
                $this->Flash->success(__('The card has been saved.'));  
                $logs = $this->getTableLocator()->get('Logs');
                $newLogs = $logs->newEntity([
                    'content' => $card->title.': carte ajoutée',
                    'user_id' => $this->request->getAttribute('identity')->id,
                    'workspace_id' => $this->request->getData('workspace_id'),
                ]);
                $logs->save($newLogs);
            }
            else
                $this->Flash->error(__('The card could not be saved. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Workspaces', 'action' => 'view', $this->request->getData('workspace_id')]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $card = $this->Cards->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $card = $this->Cards->patchEntity($card, $this->request->getData());
            if ($this->Cards->save($card)) {
                $this->Flash->success(__('The card has been saved.'));
                $logs = $this->getTableLocator()->get('Logs');
                $newLogs = $logs->newEntity([
                    'content' => $card->title.': carte modifiée',
                    'user_id' => $this->request->getAttribute('identity')->id,
                    'workspace_id' => $this->request->getData('workspace_id'),
                ]);
                $logs->save($newLogs);

            }
            else{
                $this->Flash->error(__('The card could not be saved. Please, try again.'));
            }
        }
        return $this->redirect(['controller'=>'Workspaces','action' => 'view', $this->request->getData('workspace_id')]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $this->request->allowMethod(['post', 'delete']);
        $card = $this->Cards->get($id, [
            'contain'=>['Categories'],
        ]);
        if ($this->Cards->delete($card)) {
            $logs = $this->getTableLocator()->get('Logs');
                $newLogs = $logs->newEntity([
                    'content' => $card->title.': carte supprimé',
                    'user_id' => $this->request->getAttribute('identity')->id,
                    'workspace_id' => $card->category->workspace_id,
                ]);
            $logs->save($newLogs);
            $this->Flash->success(__('The card has been deleted.'));
        } else {
            $this->Flash->error(__('The card could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Workspaces','action' => 'view', $card->category->workspace_id]);
    }
}
