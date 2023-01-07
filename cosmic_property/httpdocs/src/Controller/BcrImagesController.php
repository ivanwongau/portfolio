<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * BcrImage Controller
 *
 * @property \App\Model\Table\BcrImagesTable $BcrImages
 *
 * @method \App\Model\Entity\BcrImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BcrImagesController extends AppController
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
        $bcrImage = $this->paginate($this->BcrImages);

        $this->set(compact('bcrImage'));
    }

    /**
     * View method
     *
     * @param string|null $id Bcr Image id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('item_edit');

        $this->loadModel('BcrImages');
        $query = $this->BcrImages->find()
            ->where([
                'item_id' => $id,
            ]);

        $this->set('query', $query);

        $this->set('property_name', '');
        $this->set('access_level', '');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $bcrImage = $this->BcrImages->newEntity();
        // Set layout for the add image page
        $this->viewBuilder()->setLayout('item_edit');
        $this->loadModel('BcrImages');

        if ($this->request->is('post')) {
            $images = $this->request->getData('image_files');
            $result = $this->image_validation($images);
            if ($result) {
                foreach ($images as $image) {
                    $bcrImage = $this->BcrImages->newEntity();
                    $bcrImage = $this->BcrImages->patchEntity($bcrImage, $this->request->getData());
                    $bcrImage->item_id = $id;
                    $imagename = $image['name'];
                    $mytmp = $image['tmp_name'];
                    $myext = substr(strrchr($imagename, "."), 1);
                    $uniqeName = uniqid('img_');
                    $imagename = $uniqeName . "." . $myext;
                    $mypath = "img/" . $imagename;
                    $mypath = "img/" . $uniqeName . "." . $myext;
                    move_uploaded_file($mytmp, WWW_ROOT . $mypath);
                    $bcrImage->image_name = $imagename;
                    $bcrImage->image_path = $mypath;
                    $bcrImage->item_id = $id;
                    $this->BcrImages->save($bcrImage);
                }
                return $this->redirect(['controller' => 'ItemMaintenances', 'action' => 'view', $bcrImage->item_id]);
            } else {
                return $this->redirect(['controller' => 'BcrImages', 'action' => 'add', $id]);
            }
        }
        $itemMaintenance = $this->BcrImages->ItemMaintenances->find('list', ['limit' => 200]);
        $this->set(compact('bcrImage'));

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
     * Edit method
     *
     * @param string|null $id Bcr Image id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bcrImage = $this->BcrImages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bcrImage = $this->BcrImages->patchEntity($bcrImage, $this->request->getData());
            if ($this->BcrImages->save($bcrImage)) {
                $this->Flash->success(__('The bcr image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bcr image could not be saved. Please, try again.'));
        }
        $itemMaintenance = $this->BcrImages->ItemMaintenance->find('list', ['limit' => 200]);
        $this->set(compact('bcrImage', 'itemMaintenance'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bcr Image id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $item_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bcrImage = $this->BcrImages->get($id);
        if ($this->BcrImages->delete($bcrImage)) {
            if (unlink(WWW_ROOT . $bcrImage->image_path)) {
                $this->Flash->success(__('The bcr image has been deleted.'));
            }
        } else {
            $this->Flash->error(__('The bcr image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'BcrImages', 'action' => 'view', $item_id]);
    }
}
