<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemComments Controller
 *
 * @property \App\Model\Table\ItemCommentsTable $ItemComments
 *
 * @method \App\Model\Entity\ItemComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemCommentsController extends AppController
{

    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['index', 'add', 'edit', 'delete', 'view'])) {
            return true;
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ItemMaintenances'],
        ];
        $itemComments = $this->paginate($this->ItemComments);

        $this->set(compact('itemComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Comment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemComment = $this->ItemComments->get($id, [
            'contain' => ['ItemMaintenances'],
        ]);

        $this->set('itemComment', $itemComment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($itemMaintenance_id,$user_id)
    {
        $itemComment = $this->ItemComments->newEntity();
        if ($this->request->is('post')) {
            $itemComment = $this->ItemComments->patchEntity($itemComment, $this->request->getData());
            if ($this->ItemComments->save($itemComment)) {
                $this->Flash->success(__('The item comment has been saved.'));
                /*$itemMaintenance_id = $this->ItemComments->get('item_maintenance_id');*/
                return $this->redirect(['controller'=>'ItemMaintenances','action' => 'view',$itemMaintenance_id]);
            }
            $this->Flash->error(__('The item comment could not be saved. Please, try again.'));
        }
        $itemMaintenances = $this->ItemComments->ItemMaintenances->find('list',['limit'=>200])->select()->where(['id'=>$itemMaintenance_id]);
        $users = $this->ItemComments->Users->find('list',['limit'=>200])->select()->where(['id'=>$user_id]);
        $this->set(compact('itemComment', 'itemMaintenances','users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null,$itemMaintenance_id)
    {
        $this->viewBuilder()->setLayout('item_index');

        $this->loadModel('Properties');
       // $property = $this->Properties->find()->select()->where(['id' => $property_id])->first();
        $this->set('currentprop_name','--');

        $userId = $this->Auth->user('id');
        $this->loadModel('Users');
        $user = $this->Users->find()->select()->where(['id' => $userId])->first();

        $this->set('access_level', '--');

        $itemComment = $this->ItemComments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemComment = $this->ItemComments->patchEntity($itemComment, $this->request->getData());
            if ($this->ItemComments->save($itemComment)) {
                $this->Flash->success(__('The item comment has been saved.'));

                return $this->redirect(['controller'=>'itemMaintenances', 'action' => 'view',$itemMaintenance_id]);
            }
            $this->Flash->error(__('The item comment could not be saved. Please, try again.'));
        }
        $itemMaintenances = $this->ItemComments->ItemMaintenances->find('list', ['limit' => 200]);
        $this->set(compact('itemComment', 'itemMaintenances'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$itemMaintenance_id)
    {

        $itemComment = $this->ItemComments->get($id);
        if ($this->ItemComments->delete($itemComment)) {
            $this->Flash->success(__('The item comment has been deleted.'));
        } else {
            $this->Flash->error(__('The item comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'itemMaintenances','action'=>'view',$itemMaintenance_id]);
    }
}
