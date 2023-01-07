<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * ItemFolder Controller
 *
 * @property \App\Model\Table\ItemFoldersTable $ItemFolders
 *
 * @method \App\Model\Entity\ItemFolder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemFoldersController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['delete','edit'])) {
            return true;
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($currentprop_id, $currentprop_name)
    {
        $this->viewBuilder()->setLayout('property_folder');
        $this->loadModel('ItemFolders');
        $this->paginate = [
            'contain' => ['Properties'],
        ];
        $itemFolder = $this->paginate($this->ItemFolders);

        $this->set(compact('itemFolder'));

        $query = $this->ItemFolders->find()
            ->where([
                'property_id' => $currentprop_id,
            ]);


        // popup window proceed save array
        $this->loadModel('ItemFolder');

        $itemFolder = $this->ItemFolders->newEntity();
        if ($this->request->is('post')) {
            $itemFolder = $this->ItemFolders->patchEntity($itemFolder, $this->request->getData());
            $itemFolder->property_id = $currentprop_id;
            if ($this->ItemFolders->save($itemFolder)) {
                $this->Flash->success(__('The item folder has been saved.'));

                return $this->redirect(['action' => 'index', $currentprop_id, $currentprop_name]);
            }
            $this->Flash->error(__('The item folder could not be saved. Please, try again.'));
        }
        $property = $this->ItemFolders->Property->find('list', ['limit' => 200]);
        $this->set(compact('itemFolder', 'property'));
        $this->set('currentprop_id', $currentprop_id);
        $this->set('currentprop_name', $currentprop_name);
        $this->set('query', $query);
    }

    /**
     * View method
     *
     * @param string|null $id Item Folder id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('ItemFolder');
        $itemFolder = $this->ItemFolders->get($id, [
            'contain' => ['Property'],
        ]);

        $this->set('itemFolder', $itemFolder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($currentprop_id)
    {
        $this->loadModel('ItemFolder');

        $itemFolder = $this->ItemFolders->newEntity();
        if ($this->request->is('post')) {
            $itemFolder = $this->ItemFolders->patchEntity($itemFolder, $this->request->getData());
            if ($this->ItemFolders->save($itemFolder)) {
                $this->Flash->success(__('The item folder has been saved.'));

                return $this->redirect(['action' => 'index', $currentprop_id]);
            }
            $this->Flash->error(__('The item folder could not be saved. Please, try again.'));
        }
        $property = $this->ItemFolders->Property->find('list', ['limit' => 200]);
        $this->set(compact('itemFolder', 'property'));
        $this->set('currentprop_id', $currentprop_id);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Folder id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $currentprop_id, $currentprop_name)
    {
        $this->viewBuilder()->setLayout('item_edit');

        $itemFolder = $this->ItemFolders->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemFolder = $this->ItemFolders->patchEntity($itemFolder, $this->request->getData());
            if ($this->ItemFolders->save($itemFolder)) {
                $this->Flash->success(__('The item folder has been saved.'));

                return $this->redirect(['controller'=>'Properties','action' => 'dashboard', $currentprop_id]);
            }
            $this->Flash->error(__('The item folder could not be saved. Please, try again.'));
        }
        $property = $this->ItemFolders->Properties->find('list', ['limit' => 200]);
        $this->set(compact('itemFolder', 'property'));

        $userId = $this->Auth->user('id');
        $this->loadModel('Users');
        $user = $this->Users->find()->select()->where(['id' => $userId])->first();

        $this->loadModel('PropertiesUsers');
        $access_level = $this->PropertiesUsers->find()
            ->select(['access_level'])
            ->where(
                ['property_id' => $id, 'user_id' => $userId]
            )->first();
        if ($user->role == 'admin') {
            $access_level = 0;
            $this->set('access_level', '0');
        } else {
            if ($access_level != null)
            {
                $access_level = $access_level->access_level;
                $this->set('access_level', $access_level);
            }
            else
            {
                $access_level = 'none';
                $this->set('access_level', $access_level);
            }
        };

        $this->set('property_name', $currentprop_name);
        $this->set('access_level', $access_level);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Folder id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($currentprop_id, $currentfolderid, $currentprop_name)
    {
        $this->loadModel('ItemFolder');
        $this->request->allowMethod(['post', 'delete']);
        $itemFolder = $this->ItemFolders->get($currentfolderid);
        if ($this->ItemFolders->delete($itemFolder)) {
            $this->Flash->success(__('The item folder has been deleted.'));
        } else {
            $this->Flash->error(__('The item folder could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Properties','action' => 'dashboard', $currentprop_id]);
    }
    public function folderIndexToAdd($id = null)
    {
        $currentprop_id =  $id;
        return $this->redirect(array('controller' => 'ItemFolders', 'action' => 'add', $currentprop_id));
    }



    public function addingFolderDirectly($currentprop_id)
    {
        $this->loadModel('ItemFolder');

        $itemFolder = $this->ItemFolders->newEntity();
        if ($this->request->is('post')) {
            $itemFolder = $this->ItemFolders->patchEntity($itemFolder, $this->request->getData());
            $this->ItemFolders->save($itemFolder);
            return $this->redirect(array('controller' => 'ItemFolder', 'action' => 'add', $currentprop_id));
        }
        $property = $this->ItemFolders->Property->find('list', ['limit' => 200]);
        $this->set(compact('itemFolder', 'property'));
        $this->set('currentprop_id', $currentprop_id);
    }
    public function folderToItemIndex($id = null)
    {
        $currentfolder_id =  $id;
        return $this->redirect(array('controller' => 'Item', 'action' => 'index', $currentfolder_id));
    }
}
