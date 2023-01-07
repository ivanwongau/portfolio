<?php
declare(strict_types=1);

namespace App\Controller;

use App\Policy\ClientConditionPolicy;
use Authorization\Policy\MapResolver;

/**
 * ClientConditions Controller
 *
 * @property \App\Model\Table\ClientConditionsTable $ClientConditions
 * @method \App\Model\Entity\ClientCondition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientConditionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Clients'],
        ];

        $clientConditions = $this->paginate($this->ClientConditions);

        $this->set(compact('clientConditions'));
    }

    public function overview()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Clients'],
        ];

        $clientConditions = $this->paginate($this->ClientConditions);

        $this->set(compact('clientConditions'));
    }

    /**
     * View method
     *
     * @param string|null $id Client Condition id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientCondition = $this->ClientConditions->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->Authorization->authorize($clientCondition);

        $this->set(compact('clientCondition'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientCondition = $this->ClientConditions->newEmptyEntity();

        $this->Authorization->authorize($clientCondition);

        if ($this->request->is('post')) {
            $clientCondition = $this->ClientConditions->patchEntity($clientCondition, $this->request->getData());
            if ($this->ClientConditions->save($clientCondition)) {
                $this->Flash->success(__('The client condition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client condition could not be saved. Please, try again.'));
        }
        $clients = $this->ClientConditions->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientCondition', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client Condition id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientCondition = $this->ClientConditions->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($clientCondition);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientCondition = $this->ClientConditions->patchEntity($clientCondition, $this->request->getData());
            if ($this->ClientConditions->save($clientCondition)) {
                $this->Flash->success(__('The client condition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client condition could not be saved. Please, try again.'));
        }
        $clients = $this->ClientConditions->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientCondition', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client Condition id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientCondition = $this->ClientConditions->get($id);

        $this->Authorization->authorize($clientCondition);

        if ($this->ClientConditions->delete($clientCondition)) {
            $this->Flash->success(__('The client condition has been deleted.'));
        } else {
            $this->Flash->error(__('The client condition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
