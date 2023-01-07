<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login','add']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {

            $user = $this->Users->newEmptyEntity();
            $this->Authorization->authorize($user);

            $target = ['controller' => 'MonashHealth', 'action' => 'view'];
            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id=null)
    {
        $user = $this->Users->get($id, [
        'contain' => ['Clients', 'Clinicians'],
        ]);

        $this->Authorization->authorize($user);

        $this->set(compact('user'));
    }

    public function profile($id=null){
        $user = $this->Users->get($id);

        $this->Authorization->skipAuthorization();

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        $this->Authorization->authorize($user);

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {

                $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->skipAuthorization();
        // $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'accessibleFields' => ['user_id' => false]
            ]);

            if ($this->Users->save($user)) {
                $userQuery = TableRegistry::getTableLocator()->get('Users')->query();
                $userQuery->update()
                    ->set(['modified_date' => date('Y-m-d H:i:s')])
                    ->where(['id' => $user->id])
                    ->execute();

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function modify($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->skipAuthorization();
        // $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'accessibleFields' => ['user_id' => false]
            ]);

            if ($this->Users->save($user)) {
                $userQuery = TableRegistry::getTableLocator()->get('Users')->query();
                $userQuery->update()
                    ->set(['modified_date' => date('Y-m-d H:i:s')])
                    ->where(['id' => $user->id])
                    ->execute();

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'profile', $user->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);

        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /***delete all function method */
    public function deleteAll() {

        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post','delete']);
        $ids = $this->request->getData('ids');

        $idsToDelete = [];
        foreach($ids as $id) {
            if($id != 0){
                array_push($idsToDelete, $id);
            }
        }

        // Loop through array to delete each
        $idsToDeleteSize = count($idsToDelete);
        $count = 1;
        foreach ($idsToDelete as $idToDelete){
            $user = $this->Users->get($idToDelete);
            $this->Users->delete($user);
            $count++;

            if($idsToDeleteSize < $count){
                $this->Flash->success(_('The users have been deleted.'));
                return $this->redirect(['action'=>'index']);
            }
        }

        return $this->redirect(['action'=>'index']);
    }


}
