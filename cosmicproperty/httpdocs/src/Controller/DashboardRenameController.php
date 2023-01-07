<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DashboardRename Controller
 *
 * @property \App\Model\Table\DashboardRenameTable $DashboardRename
 *
 * @method \App\Model\Entity\DashboardRename[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardRenameController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public $paginate = [
        'limit' => 100,
        'order' => [

        ]
    ];

    public function index()
    {
//         $this->loadModel('dashboardRename');
//         $dashboardRename = $this->dashboardRename->find('all')->limit(60);

        $key=$this->request->getQuery('key');
        if ($key){
            $query=$this->DashboardRename->find('all')->where(['OR'=>[
                // 'email like'=>'%'.$this->request->getQuery('key').'%',
                'name like'=>'%'.$this->request->getQuery('key').'%',
                'System_Configured_Name like'=>'%'.$this->request->getQuery('key').'%',
                'location like'=>'%'.$this->request->getQuery('key').'%',
                'Description like'=>'%'.$this->request->getQuery('key').'%',
                ]]);
        }else{
            $query=$this->DashboardRename;
        }

        $dashboardRename = $this->paginate($query);

        $this->set(compact('dashboardRename'));


    }

    /**
     * View method
     *
     * @param string|null $id Dashboard Rename id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {


        $dashboardRename = $this->DashboardRename->get($id, [
            'contain' => [],
        ]);

        $this->set('dashboardRename', $dashboardRename);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dashboardRename = $this->DashboardRename->newEntity();
        if ($this->request->is('post')) {
            $dashboardRename = $this->DashboardRename->patchEntity($dashboardRename, $this->request->getData());
            if ($this->DashboardRename->save($dashboardRename)) {
                $this->Flash->success(__('The dashboard rename has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard rename could not be saved. Please, try again.'));
        }
        $this->set(compact('dashboardRename'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard Rename id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dashboardRename = $this->DashboardRename->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboardRename = $this->DashboardRename->patchEntity($dashboardRename, $this->request->getData());
            if ($this->DashboardRename->save($dashboardRename)) {
                $this->Flash->success(__('The dashboard rename has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard rename could not be saved. Please, try again.'));
        }
        $this->set(compact('dashboardRename'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard Rename id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dashboardRename = $this->DashboardRename->get($id);
        if ($this->DashboardRename->delete($dashboardRename)) {
            $this->Flash->success(__('The dashboard rename has been deleted.'));
        } else {
            $this->Flash->error(__('The dashboard rename could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['notauthorized'])) {
            return true;
        }

        if (in_array($this->request->getParam('action'), ['index', 'add', 'edit', 'delete', 'view'])) {
            $user = $this->Auth->user();
            if ($user['role'] === 'admin') {
                return true;
            } else {
                return $this->redirect(['action' => 'notauthorized']);
            }
        }return parent::isAuthorized($user);
    }
    public function notauthorized()
    {

    }




}
