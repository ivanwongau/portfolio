<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Clinicians Controller
 *
 * @property \App\Model\Table\CliniciansTable $Clinicians
 * @method \App\Model\Entity\Clinician[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CliniciansController extends AppController
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
        $clinicians = $this->paginate($this->Clinicians);

        $userQuery = TableRegistry::getTableLocator()->get('Users')->find();
        $users = $userQuery->where(['role' => '2'])->all();

        $this->set(compact('clinicians', 'users'));
    }

    /**
     * View method
     *
     * @param string|null $id Clinician id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $clinician = $this->Clinicians->get($id, [
            'contain' => ['Users', 'Clients', 'ClinicianQualifications'],
        ]);

        $this->set(compact('clinician'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clinician = $this->Clinicians->newEmptyEntity();

        $this->Authorization->authorize($clinician);

        if ($this->request->is('post')) {
            $clinician = $this->Clinicians->patchEntity($clinician, $this->request->getData());
            if ($this->Clinicians->save($clinician)) {
                $this->Flash->success(__('The clinician has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clinician could not be saved. Please, try again.'));
        }
        $users = $this->Clinicians->Users->find('list', ['limit' => 200]);
        $clients = $this->Clinicians->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clinician', 'users', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clinician id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clinician = $this->Clinicians->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->Authorization->authorize($clinician);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $clinician = $this->Clinicians->patchEntity($clinician, $this->request->getData());
            if ($this->Clinicians->save($clinician)) {
                $this->Flash->success(__('The clinician has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clinician could not be saved. Please, try again.'));
        }
        $users = $this->Clinicians->Users->find('list', ['limit' => 200]);
        $clients = $this->Clinicians->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clinician', 'users', 'clients'));
    }


    public function selfedit($id = null)
    {
        $clinician = $this->Clinicians->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->Authorization->authorize($clinician);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $clinician = $this->Clinicians->patchEntity($clinician, $this->request->getData());
            if ($this->Clinicians->save($clinician)) {
                $this->Flash->success(__('The clinician has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'profile', $clinician->user_id]);
            }
            $this->Flash->error(__('The clinician could not be saved. Please, try again.'));
        }
        $users = $this->Clinicians->Users->find('list', ['limit' => 200]);
        $clients = $this->Clinicians->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clinician', 'users', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clinician id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clinician = $this->Clinicians->get($id);
        $this->Authorization->authorize($clinician);
        if ($this->Clinicians->delete($clinician)) {
            $this->Flash->success(__('The clinician has been deleted.'));
        } else {
            $this->Flash->error(__('The clinician could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
