<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ClientsClinicians Controller
 *
 * @property \App\Model\Table\ClientsCliniciansTable $ClientsClinicians
 * @method \App\Model\Entity\ClientsClinician[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsCliniciansController extends AppController
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
            'contain' => ['Clients', 'Clinicians'],
        ];
        $clientsClinicians = $this->paginate($this->ClientsClinicians);

        $this->set(compact('clientsClinicians'));
    }

    /**
     * View method
     *
     * @param string|null $id Clients Clinician id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientsClinician = $this->ClientsClinicians->get($id, [
            'contain' => ['Clients', 'Clinicians'],
        ]);

        $this->Authorization->authorize($clientsClinician);

        $this->set(compact('clientsClinician'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientsClinician = $this->ClientsClinicians->newEmptyEntity();

        $this->Authorization->authorize($clientsClinician);

        if ($this->request->is('post')) {
            $clientsClinician = $this->ClientsClinicians->patchEntity($clientsClinician, $this->request->getData());
            if ($this->ClientsClinicians->save($clientsClinician)) {
                $this->Flash->success(__('The clients clinician has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clients clinician could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsClinicians->Clients->find('list', ['limit' => 200]);
        $clinicians = $this->ClientsClinicians->Clinicians->find('list', ['limit' => 200]);
        $this->set(compact('clientsClinician', 'clients', 'clinicians'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clients Clinician id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientsClinician = $this->ClientsClinicians->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($clientsClinician);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientsClinician = $this->ClientsClinicians->patchEntity($clientsClinician, $this->request->getData());
            if ($this->ClientsClinicians->save($clientsClinician)) {
                $this->Flash->success(__('The clients clinician has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clients clinician could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsClinicians->Clients->find('list', ['limit' => 200]);
        $clinicians = $this->ClientsClinicians->Clinicians->find('list', ['limit' => 200]);
        $this->set(compact('clientsClinician', 'clients', 'clinicians'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clients Clinician id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientsClinician = $this->ClientsClinicians->get($id);

        $this->Authorization->authorize($clientsClinician);

        if ($this->ClientsClinicians->delete($clientsClinician)) {
            $this->Flash->success(__('The clients clinician has been deleted.'));
        } else {
            $this->Flash->error(__('The clients clinician could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
