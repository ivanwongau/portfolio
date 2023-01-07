<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
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
            'contain' => ['Users'],
        ];
        $clients = $this->paginate($this->Clients);

        $userQuery = TableRegistry::getTableLocator()->get('Users')->find();
        $users = $userQuery->where(['role' => '3'])->all();

        $this->set(compact('clients', 'users'));
    }

    public function overview()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Users'],
        ];
        $clients = $this->paginate($this->Clients);

        $userQuery = TableRegistry::getTableLocator()->get('Users')->find();
        $users = $userQuery->where(['role' => '3'])->all();

        $this->set(compact('clients', 'users'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Users', 'Clinicians', 'ClientConditions', 'FoodIntakes'],
        ]);

        $this->Authorization->authorize($client);

        $this->set(compact('client'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $client = $this->Clients->newEmptyEntity();

        $this->Authorization->authorize($client);

        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'overview']);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $users = $this->Clients->Users->find('list', ['limit' => 200]);
        $clinicians = $this->Clients->Clinicians->find('list', ['limit' => 200]);
        $this->set(compact('client', 'users', 'clinicians'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Clinicians'],
        ]);

        $this->Authorization->authorize($client);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'overview', $id]);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $users = $this->Clients->Users->find('list', ['limit' => 200]);
        $clinicians = $this->Clients->Clinicians->find('list', ['limit' => 200]);
        $this->set(compact('client', 'users', 'clinicians'));
    }

    public function selfedit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Clinicians'],
        ]);

        $this->Authorization->authorize($client);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'profile', $client->user_id]);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $users = $this->Clients->Users->find('list', ['limit' => 200]);
        $clinicians = $this->Clients->Clinicians->find('list', ['limit' => 200]);
        $this->set(compact('client', 'users', 'clinicians'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $client = $this->Clients->get($id);
        $this->Authorization->authorize($client);

        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'overview']);
    }


}
