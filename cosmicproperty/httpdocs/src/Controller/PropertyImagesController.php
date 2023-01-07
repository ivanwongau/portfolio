<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;


/**
 * PropertyImage Controller
 *
 * @property \App\Model\Table\PropertyImagesTable $PropertyImages
 *
 * @method \App\Model\Entity\PropertyImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyImagesController extends AppController
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
        $this->loadModel('PropertyImages');


        //constrain to property
        $this->paginate = [
            'contain' => []
        ];



        $propertyImage = $this->paginate($this->PropertyImages);

        $this->set(compact('propertyImage'));
    }

    /**
     * View method
     *
     * @param string|null $id Property Image id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($property_id)
    {
        $this->viewBuilder()->setLayout('item_edit');

        $this->loadModel('PropertyImages');
        $query = $this->PropertyImages->find()
            ->where([
                'property_id' => $property_id,
            ]);
        $this->set('property_id', $property_id);
        $this->set('query', $query);

        $this->set('property_name', '');
        $this->set('access_level', '');
    }



    public function image_validation($image_array)
    {
        $result = true;
        foreach ($image_array as $image) {

            if (($image['type'] == 'image/jpeg' || $image['type'] == 'image/png' || $image['type'] == 'image/heic' || $image['type'] == 'image/jpg') && $image['size'] <= 10 * 1024 * 1024) {
            } else {
                $result = false;
            }
        }

        return $result;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($currentprop_id, $currentprop_name)
    {
        $propertyImage = $this->PropertyImages->newEntity();
        // Set layout for the add image page
        $this->viewBuilder()->setLayout('item_index');

        $this->loadModel('PropertyImage');
        $this->set('currentprop_id', $currentprop_id);
        $this->set('currentprop_name', $currentprop_name);

        $userId = $this->Auth->user('id');
        $this->loadModel('Users');
        $user = $this->Users->find()->select()->where(['id' => $userId])->first();

        $this->loadModel('PropertiesUsers');
        $access_level = $this->PropertiesUsers->find()
            ->select(['access_level'])
            ->where(
                ['property_id' => $currentprop_id, 'user_id' => $user->id]
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

        if ($this->request->is('post')) {
            $images = $this->request->getData('image_files');
            $result = $this->image_validation($images);

            if ($result) {
                foreach ($images as $image) {
                    $propertyImage = $this->PropertyImages->newEntity();
                    $propertyImage = $this->PropertyImages->patchEntity($propertyImage, $this->request->getData());
                    $propertyImage->property_id = $currentprop_id;
                    $image_name = $image['name'];
                    $mytmp = $image['tmp_name'];
                    $myext = substr(strrchr($image_name, "."), 1);
                    $unique_name = uniqid('img_');
                    $image_name = $unique_name . "." . $myext;
                    $my_path = "img/" . $image_name;
                    $my_path = "img/" . $unique_name . "." . $myext;
                    move_uploaded_file($mytmp, WWW_ROOT . $my_path);
                    $propertyImage->image_name = $image_name;
                    $propertyImage->image_path = $my_path;
                    $propertyImage->property_id = $currentprop_id;
                    $this->PropertyImages->save($propertyImage);
                }
                return $this->redirect(['controller'=>'properties', 'action' => 'dashboard', $currentprop_id]);
            } else {
                $this->Flash->set('The user has been saved.', [
                    'element' => 'success'
                ]);
            }
        }


        $property = $this->PropertyImages->Properties->find('list', ['limit' => 200]);
        $this->set(compact('propertyImage', 'property'));
    }






    /**
     * Edit method
     *
     * @param string|null $id Property Image id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $propertyImage = $this->PropertyImages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyImage = $this->PropertyImages->patchEntity($propertyImage, $this->request->getData());
            if ($this->PropertyImages->save($propertyImage)) {
                $this->Flash->success(__('The property image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property image could not be saved. Please, try again.'));
        }
        $images = $this->PropertyImages->Images->find('list', ['limit' => 200]);
        $property = $this->PropertyImages->Property->find('list', ['limit' => 200]);
        $this->set(compact('propertyImage', 'images', 'property'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Property Image id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $property_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertyImage = $this->PropertyImages->get($id);

        if ($this->PropertyImages->delete($propertyImage)) {
            if (unlink(WWW_ROOT . $propertyImage->image_path)) {
                $this->Flash->success(__('The property image has been deleted.'));
            }
        } else {
            $this->Flash->error(__('The property image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'PropertyImages', 'action' => 'view', $property_id]);
    }
}
