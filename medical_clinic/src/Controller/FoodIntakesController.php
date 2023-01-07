<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * FoodIntakes Controller
 *
 * @property \App\Model\Table\FoodIntakesTable $FoodIntakes
 * @method \App\Model\Entity\FoodIntake[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use App\Model\Entity\FoodIntake;
use Cake\ORM\TableRegistry;

class FoodIntakesController extends AppController
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

        $usersQuery = TableRegistry::getTableLocator()->get('Users')->find();
        $users = $usersQuery
            ->select(['first_name', 'last_name'])
            ->where(['id !=' => 1])
            ->order(['created' => 'DESC']);

        $foodIntakes = $this->paginate($this->FoodIntakes);

        $this->set(compact('foodIntakes','users'));
    }

    public function overview()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Clients'],
        ];

        $usersQuery = TableRegistry::getTableLocator()->get('Users')->find();
        $users = $usersQuery
            ->select(['first_name', 'last_name'])
            ->where(['id !=' => 1])
            ->order(['created' => 'DESC']);

        $foodIntakes = $this->paginate($this->FoodIntakes);

        $this->set(compact('foodIntakes','users'));
    }

    /**
     * View method
     *
     * @param string|null $id Food Intake id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $foodIntake = $this->FoodIntakes->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('foodIntake'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $foodIntake = $this->FoodIntakes->newEmptyEntity();

        $this->Authorization->authorize($foodIntake);

        if ($this->request->is('post')) {
            $foodIntake = $this->FoodIntakes->patchEntity($foodIntake, $this->request->getData());
            if ($this->FoodIntakes->save($foodIntake)) {
                $this->Flash->success(__('The food intake has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The food intake could not be saved. Please, try again.'));
        }
        $clients = $this->FoodIntakes->Clients->find('list', ['limit' => 200]);
        $this->set(compact('foodIntake', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Food Intake id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $foodIntake = $this->FoodIntakes->get($id, [
            'contain' => [],
        ]);

        //$this->Authorization->authorize($foodIntake);
        $this->Authorization->skipAuthorization();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $foodIntake = $this->FoodIntakes->patchEntity($foodIntake, $this->request->getData());
            if ($this->FoodIntakes->save($foodIntake)) {
                $this->Flash->success(__('The food intake has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The food intake could not be saved. Please, try again.'));
        }
        $clients = $this->FoodIntakes->Clients->find('list', ['limit' => 200]);
        $this->set(compact('foodIntake', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Food Intake id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $foodIntake = $this->FoodIntakes->get($id);

        $this->Authorization->authorize($foodIntake);

        if ($this->FoodIntakes->delete($foodIntake)) {
            $this->Flash->success(__('The food intake has been deleted.'));
        } else {
            $this->Flash->error(__('The food intake could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
