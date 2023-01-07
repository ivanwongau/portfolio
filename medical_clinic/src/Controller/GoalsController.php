<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Goals Controller
 *
 * @property \App\Model\Table\GoalsTable $Goals
 * @method \App\Model\Entity\Goal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
use App\Model\Entity\Goal;
use Cake\ORM\TableRegistry;

class GoalsController extends AppController
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

        $goals = $this->paginate($this->Goals);

        $this->set(compact('goals','users'));
    }

    /**
     * View method
     *
     * @param string|null $id Goal id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

        $goal = $this->paginate($this->Goals);

        $this->set(compact('goal','users'));
    }




    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $goal = $this->Goals->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('goal'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $goal = $this->Goals->newEmptyEntity();

        $this->Authorization->skipAuthorization();

        if ($this->request->is('post')) {
            $goal = $this->Goals->patchEntity($goal, $this->request->getData());
            if ($this->Goals->save($goal)) {
                $this->Flash->success(__('The goal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The goal could not be saved. Please, try again.'));
        }
        $clients = $this->Goals->Clients->find('list', ['limit' => 200]);
        $this->set(compact('goal', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Goal id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();
        $goal = $this->Goals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $goal = $this->Goals->patchEntity($goal, $this->request->getData());
            if ($this->Goals->save($goal)) {
                $this->Flash->success(__('The goal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The goal could not be saved. Please, try again.'));
        }
        $clients = $this->Goals->Clients->find('list', ['limit' => 200]);
        $this->set(compact('goal', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Goal id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $goal = $this->Goals->get($id);
        if ($this->Goals->delete($goal)) {
            $this->Flash->success(__('The goal has been deleted.'));
        } else {
            $this->Flash->error(__('The goal could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
