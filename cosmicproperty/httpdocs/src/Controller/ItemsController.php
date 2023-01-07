<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;


/**
 * Item Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 * @property \App\Model\Table\ItemFoldersTable $ItemFolders
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['index', 'add', 'edit', 'delete', 'view', 'saveItems'])) {
            return true;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($folder_id, $currentprop_id, $folder_name, $currentprop_name)
    {
        $this->viewBuilder()->setLayout('item_index');
        $this->loadModel('Items');
        $this->loadModel('Properties');


        // $this->set(compact('item'));
        $test = $folder_id;

        $query = $this->Items->find()
            ->select([
                'id',
                'item_name',
                'item_quantity',
                'item_unit_of_mes',
                'item_rate',
                'item_total',
                'item_allowance',
                'item_condition',
                'year_due',
                'expected_life',
                'expected_year_due',
            ])
            ->where(['folder_id' => $test]);


        $item_paginate = $this->paginate($query);
        $this->set(compact('item_paginate'));

        $propertyspec = $this->Properties->find()
            ->select([
                "id", "property_date", "finalized"
            ])
            ->where(['id' => $currentprop_id]);

        $this->set('query', $query);
        $this->set('folder_id', $folder_id);
        $this->set('property_id', $currentprop_id);
        $this->set('folder_name', $folder_name);
        $this->set('currentprop_name', $currentprop_name);
        $this->set('propertyspec', $propertyspec);

        // They save it in index.
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            $item->folder_id = $folder_id;

            if ($this->Items->save($item)) {
                return $this->redirect(['action' => 'index', $folder_id, $currentprop_id, $folder_name, $currentprop_name]);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        //$ItemFolder = $this->Items->ItemFolder->find('list', ['limit' => 200]);
        $this->set(compact('item'));


        //getting user id
        $userId = $this->Auth->user('id');

        //to get the user access Level
        $user = $this->Properties->Users->get($userId, [
            'contain' => [],
        ]);

        $this->set('user', $user);

        $this->loadModel('PropertiesUsers');
        $access_level = $this->PropertiesUsers->find()
            ->select(['access_level'])
            ->where(
                ['property_id' => $currentprop_id, 'user_id' => $user->id]
            )->first();
        if ($user->role == 'admin') {
            $this->set('access_level', '0');
        } else {
            if ($access_level != null) {
                $access_level = $access_level->access_level;
                $this->set('access_level', $access_level);
            } else {
                $access_level = 'none';
                $this->set('access_level', $access_level);
            }
        };
    }

    /**
     * SaveItems method
     *
     * No params.  Retrieves data from AJAX POST request.
     * Returns nothing.
     * Exception is thrown on the client-side via AJAX.
     */
    public function saveItems()
    {
        if (isset($_POST['itemsData'])) {
            if ($this->request->is('post')) {
                $itemsJson = json_decode($_POST['itemsData'], true);

                $items = $this->Items->newEntities([]);
                $items = $this->Items->patchEntities($items, $itemsJson);

                echo var_dump($items);

                if ($this->Items->saveMany($items)) {
                    $this->Flash->success(__('The items have been successfully submitted.'));
                } else {
                    $this->Flash->error(__('The items failed to save. Please, try again.'));
                }
            }
        }

        exit();
    }

    /**
     * View method
     *
     * @param string|null $id item_id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $folder_id, $property_id, $folder_name, $currentprop_name)
    {
        $this->viewBuilder()->setLayout('item');

        $this->loadModel('Item');
        $item = $this->Items->get($id, [
            'contain' => ['ItemImages'],
        ]);

        $this->set('item', $item);
        $this->set('property_id', $property_id);
        $this->set('folder_id', $folder_id);
        $this->set('folder_name', $folder_name);
        $this->set('currentprop_name', $currentprop_name);
        $this->set('property_name', $currentprop_name);

        //getting user id
        $userId = $this->Auth->user('id');

        $this->loadModel('Properties');
        //to get the user access Level
        $user = $this->Properties->Users->get($userId, [
            'contain' => [],
        ]);

        $this->set('user', $user);

        $this->loadModel('PropertiesUsers');
        $access_level = $this->PropertiesUsers->find()
            ->select(['access_level'])
            ->where(
                ['property_id' => $property_id, 'user_id' => $userId]
            )->first();
        if ($user->role == 'admin') {
            $access_level = 0;
            $this->set('access_level', '0');
        } else {
            if ($access_level != null) {
                $access_level = $access_level->access_level;
                $this->set('access_level', $access_level);
            } else {
                $access_level = 'none';
                $this->set('access_level', $access_level);
            }
        };
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */


    public function add($folder_id, $property_id, $folder_name)
    {
        $this->loadModel('Item');
        $item = $this->Items->newEntity();
        $this->set('currentfolder_id', $folder_id);
        $this->set('currentproperty_id', $property_id);
        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(array('controller' => 'ItemFolders', 'action' => 'index', $property_id));
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $property = $this->Items->ItemFolders->find('list', ['limit' => 200]);
        $this->set(compact('item'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($item_id, $folder_id, $property_id, $folder_name, $item_name, $currentprop_name)
    {
        $this->viewBuilder()->setLayout('item_index');

        $item = $this->Items->get($item_id, [
            'contain' => [],
        ]);
        $this->loadModel('Properties');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index', $folder_id, $property_id, $folder_name, $currentprop_name]);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $ItemFolder = $this->Items->ItemFolders->find('list', ['limit' => 200]);

        $propertyspec = $this->Properties->find()
            ->select([
                "id", "property_date"
            ])
            ->where(['id' => $property_id]);

        $this->set('propertyspec', $propertyspec);

        $this->set(compact('item'));
        $this->set('property_id', $property_id);
        $this->set('currentprop_name', $currentprop_name);
        $this->set('folder_name', $folder_name);
        $this->set('folder_id', $folder_id);

        $this->loadModel('Properties');
        $property = $this->Properties->find()->select()->where(['id' => $property_id])->first();
        $this->set('currentprop_name', $property->property_name);

        $userId = $this->Auth->user('id');
        $this->loadModel('Users');
        $user = $this->Users->find()->select()->where(['id' => $userId])->first();

        $this->loadModel('PropertiesUsers');
        $access_level = $this->PropertiesUsers->find()
            ->select(['access_level'])
            ->where(
                ['property_id' => $property_id, 'user_id' => $user->id]
            )->first();
        if ($user->role == 'admin') {
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
        $finalized = $this->Properties->find()
            ->select(['finalized'])
            ->where(
                ['id' => $property_id]
            )->toArray();
        $this->set('finalized', $finalized[0]['finalized']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($item_id, $folder_id, $property_id, $folder_name, $currentprop_name)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($item_id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $folder_id, $property_id, $folder_name, $currentprop_name]);
    }

    public function itemIndextoAdd($id = null)
    {
        $currentfolder_id = $id;
        return $this->redirect(array('action' => 'add', $currentfolder_id));
    }

    public function itemToItemImage($id = null, $folder_id, $property_id, $item_name)
    {
        $currentitem_id = $id;
        return $this->redirect(array('controller' => 'ItemImage', 'action' => 'add', $currentitem_id, $folder_id, $property_id, $item_name));
    }
}
