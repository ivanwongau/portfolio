<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ClinicianQualifications Controller
 *
 * @property \App\Model\Table\ClinicianQualificationsTable $ClinicianQualifications
 * @method \App\Model\Entity\ClinicianQualification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClinicianQualificationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

//    public function isAuthorized($user)
//    {
//        // If you are a user, you can access this dashboard.
//        return Role::isUser($user['role']);
//    }


    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Clinicians'],
        ];
        $clinicianQualifications = $this->paginate($this->ClinicianQualifications);

        $this->set(compact('clinicianQualifications'));
    }

    /**
     * View method
     *
     * @param string|null $id Clinician Qualification id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clinicianQualification = $this->ClinicianQualifications->newEmptyEntity();

        $this->Authorization->skipAuthorization();
        //$this->Authorization->authorize($clinicianQualification);

        $this->paginate = [
            'contain' => ['Clinicians'],
        ];
        $clinicianQualifications = $this->paginate($this->ClinicianQualifications);

        $this->set(compact('clinicianQualifications'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clinicianQualification = $this->ClinicianQualifications->newEmptyEntity();

        $this->Authorization->authorize($clinicianQualification);

        if ($this->request->is('post')) {
            $clinicianQualification = $this->ClinicianQualifications->patchEntity($clinicianQualification, $this->request->getData());
            if ($this->ClinicianQualifications->save($clinicianQualification)) {
                $this->Flash->success(__('The clinician qualification has been saved.'));

                return $this->redirect(['action' => 'view']);
            }
            $this->Flash->error(__('The clinician qualification could not be saved. Please, try again.'));
        }
        $clinicians = $this->ClinicianQualifications->Clinicians->find('list', ['limit' => 200]);
        $this->set(compact('clinicianQualification', 'clinicians'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clinician Qualification id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clinicianQualification = $this->ClinicianQualifications->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($clinicianQualification);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $clinicianQualification = $this->ClinicianQualifications->patchEntity($clinicianQualification, $this->request->getData());
            if ($this->ClinicianQualifications->save($clinicianQualification)) {
                $this->Flash->success(__('The clinician qualification has been saved.'));

                return $this->redirect(['action' => 'view']);
            }
            $this->Flash->error(__('The clinician qualification could not be saved. Please, try again.'));
        }
        $clinicians = $this->ClinicianQualifications->Clinicians->find('list', ['limit' => 200]);
        $this->set(compact('clinicianQualification', 'clinicians'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clinician Qualification id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clinicianQualification = $this->ClinicianQualifications->get($id);
        $this->Authorization->authorize($clinicianQualification);
        if ($this->ClinicianQualifications->delete($clinicianQualification)) {
            $this->Flash->success(__('The clinician qualification has been deleted.'));
        } else {
            $this->Flash->error(__('The clinician qualification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view']);
    }
}
