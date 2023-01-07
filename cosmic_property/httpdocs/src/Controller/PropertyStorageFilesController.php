<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PropertyStorageFiles Controller
 *
 * @property \App\Model\Table\PropertyStorageFilesTable $PropertyStorageFiles
 *
 * @method \App\Model\Entity\PropertyStorageFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyStorageFilesController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['index', 'add', 'edit', 'delete', 'view', 'file_download'])) {
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
            'contain' => ['PropertyStorageFolders'],
        ];
        $propertyStorageFiles = $this->paginate($this->PropertyStorageFiles);

        $this->set(compact('propertyStorageFiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Property Storage File id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $propertyStorageFile = $this->PropertyStorageFiles->get($id, [
            'contain' => ['PropertyStorageFolders'],
        ]);

        $this->set('propertyStorageFile', $propertyStorageFile);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('item_index');

        $propertyStorageFile = $this->PropertyStorageFiles->newEntity();
        if ($this->request->is('post')) {
            $propertyStorageFile = $this->PropertyStorageFiles->patchEntity($propertyStorageFile, $this->request->getData());
            if ($this->PropertyStorageFiles->save($propertyStorageFile)) {
                $this->Flash->success(__('The property storage file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property storage file could not be saved. Please, try again.'));
        }
        $propertyStorageFolders = $this->PropertyStorageFiles->PropertyStorageFolders->find('list', ['limit' => 200]);
        $this->set('property_id', $property_id);
        $this->set(compact('propertyStorageFile', 'propertyStorageFolders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Property Storage File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $folder_id, $property_id)
    {
        $this->viewBuilder()->setLayout('item_index');

        $propertyStorageFile = $this->PropertyStorageFiles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyStorageFile = $this->PropertyStorageFiles->patchEntity($propertyStorageFile, $this->request->getData());
            if ($this->PropertyStorageFiles->save($propertyStorageFile)) {
                $this->Flash->success(__('The property storage file has been saved.'));

                return $this->redirect(['controller' => 'PropertyStorageFolders', 'action' => 'index', $folder_id, $property_id]);
            }
            $this->Flash->error(__('The property storage file could not be saved. Please, try again.'));
        }
        $propertyStorageFolders = $this->PropertyStorageFiles->PropertyStorageFolders->find('list', ['limit' => 200]);
        $this->set('property_id', $property_id);
        $this->set(compact('propertyStorageFile', 'propertyStorageFolders'));

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

    /**
     * Delete method
     *
     * @param string|null $id Property Storage File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $property_id, $folder_id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $propertyStorageFile = $this->PropertyStorageFiles->get($id);
        if ($this->PropertyStorageFiles->delete($propertyStorageFile)) {
            if(unlink(WWW_ROOT.$propertyStorageFile->file_path)) {
                $this->PropertyStorageFiles->delete($propertyStorageFile);
                return $this->redirect(['controller' => 'PropertyStorageFolders', 'action' => 'index', $folder_id, $property_id]);
            }
            $this->Flash->success(__('The property storage file has been deleted.'));
        } else {
            $this->Flash->error(__('The property storage file could not be deleted. Please, try again.'));
        }

        $this->set('property_id', $property_id);
        return $this->redirect(['controller' => 'PropertyStorageFolders', 'action' => 'index', $folder_id, $property_id]);
    }

}
