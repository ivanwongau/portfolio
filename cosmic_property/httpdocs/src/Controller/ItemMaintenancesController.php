<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemMaintenance Controller
 *
 * @property \App\Model\Table\ItemMaintenancesTable $ItemMaintenances
 *
 * @method \App\Model\Entity\ItemMaintenance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemMaintenancesController extends AppController
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
    public function index($property_id)
    {
        $this->viewBuilder()->setLayout('item_index');

        $this->loadModel('ItemMaintenances');
        $this->paginate = [
            'contain' => ['Properties'],
        ];


        // list item
        $this->loadModel('ItemMaintenances');
        $query = $this->ItemMaintenances->find()
            ->where(['property_id' => $property_id]);
        $item_maintenance_paginate = $this->paginate($query, ['limit' => 10]);
        $this->set(compact('item_maintenance_paginate'));
        $this->set('query', $query);
        $this->set('property_id', $property_id);

        $itemMaintenance = $this->ItemMaintenances->newEntity();
        if ($this->request->is('post')) {
            $itemMaintenance = $this->ItemMaintenances->patchEntity($itemMaintenance, $this->request->getData());
            $itemMaintenance->property_id = $property_id;
            if ($this->ItemMaintenances->save($itemMaintenance)) {
                return $this->redirect(['action' => 'index', $property_id]);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        // $ItemFolder = $this->Item->ItemFolder->find('list', ['limit' => 200]);
        $this->set(compact('itemMaintenance'));


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
                ['property_id' => $property_id, 'user_id' => $user->id]
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

        $property = $this->Properties->find()->select()->where(['id' => $property_id])->first();

        $this->set('currentprop_name', $property->property_name);
        $this->set('access_level', $access_level);
    }


    /**
     * View method
     *
     * @param string|null $id Item Maintenance id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('item');

        $this->loadModel('ItemMaintenances');
        $itemMaintenance = $this->ItemMaintenances->get($id, [
            'contain' => [],
        ]);
        $this->loadModel('BcrImages');
        $query = $this->BcrImages->find()
            ->where([
                'item_id' => $id,
            ]);


        $this->set('itemMaintenance', $itemMaintenance);
        $this->set('query', $query);

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
                ['property_id' => $itemMaintenance->property_id, 'user_id' => $user->id]
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

        $this->set('property_name', );
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemMaintenance = $this->ItemMaintenances->newEntity();
        if ($this->request->is('post')) {
            $itemMaintenance = $this->ItemMaintenances->patchEntity($itemMaintenance, $this->request->getData());
            if ($this->ItemMaintenances->save($itemMaintenance)) {
                $this->Flash->success(__('The item maintenance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item maintenance could not be saved. Please, try again.'));
        }
        $property = $this->ItemMaintenances->Property->find('list', ['limit' => 200]);
        $this->set(compact('itemMaintenance', 'property'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Maintenance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('item_index');

        $itemMaintenance = $this->ItemMaintenances->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemMaintenance = $this->ItemMaintenances->patchEntity($itemMaintenance, $this->request->getData());
            if ($this->ItemMaintenances->save($itemMaintenance)) {
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The item maintenance could not be saved. Please, try again.'));
        }
        $property = $this->ItemMaintenances->Properties->find('list', ['limit' => 200]);
        $this->set(compact('itemMaintenance', 'property'));

        $this->loadModel('Properties');
        $property = $this->Properties->find()->select()->where(['id' => $itemMaintenance->property_id])->first();


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
            if ($access_level != null) {
                $access_level = $access_level->access_level;
                $this->set('access_level', $access_level);
            } else {
                $access_level = 'none';
                $this->set('access_level', $access_level);
            }
        };

        $this->loadModel('Properties');
        $property = $this->Properties->find()->select()->where(['id' => $itemMaintenance->property_id])->first();

        $this->set('currentprop_name', $property->property_name);
        $this->set('access_level', $access_level);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Maintenance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemMaintenance = $this->ItemMaintenances->get($id);
        if ($this->ItemMaintenances->delete($itemMaintenance)) {
            $this->Flash->success(__('The item maintenance has been deleted.'));
        } else {
            $this->Flash->error(__('The item maintenance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $itemMaintenance->property_id]);
    }


}
