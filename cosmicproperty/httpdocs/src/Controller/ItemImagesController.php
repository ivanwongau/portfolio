<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemImage Controller
 *
 * @property \App\Model\Table\ItemImagesTable $ItemImages
 *
 * @method \App\Model\Entity\ItemImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemImagesController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['index','add','edit','delete','view'])) {
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
            'contain' => ['Items'],
        ];
        $itemImage = $this->paginate($this->ItemImages);

        $this->set(compact('itemImage'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Image id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('item_edit');

        $this->loadmodel('ItemImages');
        $query = $this->ItemImages->find()
            ->where([
                'item_id' => $id,
            ]);
        $this->set('query', $query);
        $this->set('item_id', $id);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($currentitem_id, $folder_id, $property_id, $item_name, $currentprop_name)
    {
        $this->viewBuilder()->setLayout('item_index');

        $itemImage = $this->ItemImages->newEntity();
        $this->loadModel('ItemImages');
        $this->set('currentitem_id', $currentitem_id);
        $this->set('item_name', $item_name);

        if ($this->request->is('post')) {
            $images = $this->request->getData('image_files');
            $result = $this->image_validation($images);
            if ($result) {
                foreach ($images as $image) {
                    $itemImage = $this->ItemImages->newEntity();
                    $itemImage = $this->ItemImages->patchEntity($itemImage, $this->request->getData());
                    $itemImage->item_id = $currentitem_id;
                    $imagename = $image['name'];
                    $mytmp = $image['tmp_name'];
                    $myext = substr(strrchr($imagename, "."), 1);
                    $uniqeName = uniqid('img_');
                    $imagename = $uniqeName . "." . $myext;
                    $mypath = "img/" . $imagename;
                    $mypath = "img/" . $uniqeName . "." . $myext;
                    move_uploaded_file($mytmp, WWW_ROOT . $mypath);
                    $itemImage->image_name = $imagename;
                    $itemImage->image_path = $mypath;
                    $itemImage->item_id = $currentitem_id;
                    $this->ItemImages->save($itemImage);
                }
                return $this->redirect(['controller' => 'items', 'action' => 'view', $itemImage->item_id, $folder_id, $property_id, $item_name, $currentprop_name]);
            } else {
                $this->redirect(['controller' => 'ItemImages', 'action' => 'add', $currentitem_id, $folder_id, $property_id, $item_name, $currentprop_name]);
            }
        }
        $item = $this->ItemImages->Items->find('list', ['limit' => 200]);
        $this->set(compact('itemImage', 'item'));

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
    }
    public function image_validation($image_array)
    {
        $result = true;
        foreach ($image_array as $image) {

            if (($image['type'] == 'image/jpeg' || $image['type'] == 'image/png'  || $image['type'] == 'image/heic' || $image['type'] == 'image/jpg') && $image['size'] <= 10 * 1024 * 1024) {
            } else {
                $result = false;
            }
        }

        return $result;
    }
    /**
     * Edit method
     *
     * @param string|null $id Item Image id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemImage = $this->ItemImages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemImage = $this->ItemImages->patchEntity($itemImage, $this->request->getData());
            if ($this->ItemImages->save($itemImage)) {
                $this->Flash->success(__('The item image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item image could not be saved. Please, try again.'));
        }
        $item = $this->ItemImages->Item->find('list', ['limit' => 200]);
        $this->set(compact('itemImage', 'item'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Image id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $item_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemImage = $this->ItemImages->get($id);
        if ($this->ItemImages->delete($itemImage)) {
            if (unlink(WWW_ROOT . $itemImage->image_path)) {
                $this->Flash->success(__('The item image has been deleted.'));
            }
        } else {
            $this->Flash->error(__('The item image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $item_id]);
    }
}
