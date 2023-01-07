<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Education Controller
 *
 * @property \App\Model\Table\EducationTable $Education
 * @method \App\Model\Entity\Education[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EducationController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $education = $this->paginate($this->Education);

        $this->set(compact('education'));



        // $this->loadModel('Article');
        // $Article = $this->Article->find('all', [
        // 'limit' => 10,
        // 'order' => 'Article.created_date DESC'
        // ])
        //     ->all();
    }

    /**
     * View method
     *
     * @param string|null $id Education id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $education = $this->Education->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('education'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $education = $this->Education->newEmptyEntity();
        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            $education = $this->Education->patchEntity($education, $this->request->getData());
            if ($this->Education->save($education)) {
                $this->Flash->success(__('The education has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The education could not be saved. Please, try again.'));
        }
        $users = $this->Education->Users->find('list', ['limit' => 200]);
        $this->set(compact('education', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Education id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $education = $this->Education->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->skipAuthorization();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $education = $this->Education->patchEntity($education, $this->request->getData());
            if ($this->Education->save($education)) {
                $this->Flash->success(__('The education has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The education could not be saved. Please, try again.'));
        }
        $users = $this->Education->Users->find('list', ['limit' => 200]);
        $this->set(compact('education', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Education id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $education = $this->Education->get($id);
        $this->Authorization->skipAuthorization();
        if ($this->Education->delete($education)) {
            $this->Flash->success(__('The education has been deleted.'));
        } else {
            $this->Flash->error(__('The education could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
