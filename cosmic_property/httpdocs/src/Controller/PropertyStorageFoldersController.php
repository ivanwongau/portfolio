<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\CallbackStream;
use Cake\I18n\Time;

/**
 * PropertyStorageFolders Controller
 *
 * @property \App\Model\Table\PropertyStorageFoldersTable $PropertyStorageFolders
 *
 * @method \App\Model\Entity\PropertyStorageFolder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyStorageFoldersController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['index', 'add', 'edit', 'delete', 'view', 'fileDownload'])) {
            return true;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|nulzl
     */
    public function index($folder_id, $property_id)
    {
        $this->viewBuilder()->setLayout('item_index');

        $this->set('property_id', $property_id);

        $this->loadModel('Properties');
        $property = $this->Properties->find()->select()->where(['id' => $property_id])->first();
        $this->set('currentprop_name', $property->property_name);

        $this->loadModel('PropertyStorageFiles');

        $storageFolder = $this->PropertyStorageFolders->find()
            ->where([
                'id' => $folder_id
            ])
            ->first();
        $this->set('storageFolder', $storageFolder);

        $storageFiles = $this->PropertyStorageFiles->find()
            ->where([
                'folder_id' => $folder_id,
            ]);
        $this->set('storageFiles', $this->paginate($storageFiles));

        $userId = $this->Auth->user('id');
        $this->set('userId', $userId);

        //getting user id
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

        $this->loadModel('PropertyStorageFiles');
        $propertyStorageFile = $this->PropertyStorageFiles->newEntity();


        if ($this->request->is(array('post', 'put')))
        {
            $requestInfo = $this->request->getData();
            $propertyStorageFile = $this->PropertyStorageFiles->patchEntity($propertyStorageFile
                , $requestInfo);

            $propertyStorageFile->uploaded_by = $userId;
            $propertyStorageFile->uploaded_date = date_format(Time::now(), 'Y-m-d');
            $propertyStorageFile->folder_id = $folder_id;

            $file_name = $this->request->getData()['file']['name'];
            $myext = substr(strrchr($file_name, "."), 1);
            $mytmp = $this->request->getData()['file']['tmp_name'];

            $uniqueName = uniqid('file_');
            $mypath = "file/".$uniqueName.".".$myext;

            move_uploaded_file($mytmp, WWW_ROOT.$mypath);

            $this->request->getData()['file']['tmp_name'] = $file_name;

            $propertyStorageFile->file_path = $mypath;

            if ($this->PropertyStorageFiles->save($propertyStorageFile)) {
                return $this->redirect(['action' => 'index', $folder_id, $property_id]);
            }
            else
            {
                $this->Flash->error(__('The file could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('propertyStorageFile'));

        // Folder Access capabilities check
        $userRole = $user->role;
        $this->loadModel('PropertyStorageFoldersUsers');
        $psfu = $this->PropertyStorageFoldersUsers->find()->where(['property_storage_folder_id' => $folder_id, 'user_id' => $userId])->first();

        $psfu_access = 0;
        if($psfu != null) {
            $psfu_access = $psfu->folder_access_level;
        }

        $folderAccessCapabilities = 'none';
        if ($userRole == 'admin' || $access_level == 0 || $access_level == 1 || $psfu_access == 3) {
            $folderAccessCapabilities = 'all';
        }
        else if ($psfu_access == 2)
        {
            $folderAccessCapabilities = 'contributor';
        }
        else if ($psfu_access == 1)
        {
            $folderAccessCapabilities = 'view';
        }

        $this->set('folderAccessCapabilities', $folderAccessCapabilities);
    }

    /**
     * View method
     *
     * @param string|null $id Property Storage Folder id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $propertyStorageFolder = $this->PropertyStorageFolders->get($id, [
            'contain' => ['Properties'],
        ]);

        $this->set('propertyStorageFolder', $propertyStorageFolder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($property_id)
    {
        $this->viewBuilder()->setLayout('item_index');

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


        $propertyStorageFolder = $this->PropertyStorageFolders->newEntity();
        if ($this->request->is('post')) {
            $propertyStorageFolder = $this->PropertyStorageFolders->patchEntity($propertyStorageFolder, $this->request->getData());
            if ($this->PropertyStorageFolders->save($propertyStorageFolder)) {
                // Add user to have managerial access to folder as well.
                $this->loadModel('PropertyStorageFoldersUsers');
                $psfu = $this->PropertyStorageFoldersUsers->newEntity();

                $data = ['user_id' => $this->Auth->user('id'), 'property_storage_folder_id' => $propertyStorageFolder->id, 'folder_access_level' => 3];
                $patchedPSFU = $this->PropertyStorageFoldersUsers->patchEntity($psfu, $data);

                if ($this->PropertyStorageFoldersUsers->save($patchedPSFU))
                {
                    return $this->redirect(['controller' => 'Properties', 'action' => 'dashboard', $property_id]);
                }
                $this->Flash->error(__('Your access rights could not be bound properly.  Please, contact an administrator.'));
            }
            $this->Flash->error(__('The property storage folder could not be saved. Please, try again.'));
        }
        $properties = $this->PropertyStorageFolders->Properties->find('list', ['limit' => 200]);
        $this->set('property_id', $property_id);
        $this->set(compact('propertyStorageFolder', 'properties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Property Storage Folder id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $property_id)
    {
        $this->viewBuilder()->setLayout('item_index');

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

        $propertyStorageFolder = $this->PropertyStorageFolders->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyStorageFolder = $this->PropertyStorageFolders->patchEntity($propertyStorageFolder, $this->request->getData());
            if ($this->PropertyStorageFolders->save($propertyStorageFolder)) {
                $this->Flash->success(__('The property storage folder has been saved.'));

                return $this->redirect(['controller' => 'Properties', 'action' => 'dashboard', $property_id]);
            }
            $this->Flash->error(__('The property storage folder could not be saved. Please, try again.'));
        }
        $properties = $this->PropertyStorageFolders->Properties->find('list', ['limit' => 200]);
        $this->set('property_id', $property_id);
        $this->set(compact('propertyStorageFolder', 'properties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Property Storage Folder id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $property_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertyStorageFolder = $this->PropertyStorageFolders->get($id);

        $this->loadModel('PropertyStorageFiles');
        $folderFiles = $this->PropertyStorageFiles->find()->where(['folder_id' => $id])->all();

        foreach ($folderFiles as $folderFile) {
            $folderFilePath = $folderFile->file_path;

            if(unlink(WWW_ROOT.$folderFilePath)) {
                $this->PropertyStorageFiles->delete($folderFile);
            }
        }

        if ($this->PropertyStorageFolders->delete($propertyStorageFolder)) {
            //$this->Flash->success(__('The property storage folder has been deleted.'));
        }

        return $this->redirect(['controller' => 'Properties', 'action' => 'dashboard', $property_id]);
    }

    /**
     * File Download method
    */
    public function fileDownload($id, $property_id)
    {
        $this->loadModel('PropertyStorageFiles');
        $storageFile = $this->PropertyStorageFiles->get($id);
        $file_path = WWW_ROOT.$storageFile->file_path;

        $fileExt = substr($storageFile->file_path, strpos($storageFile->file_path, "."));

        return $this->response->withFile(
            $file_path,
            ['download' => true, 'name' => $storageFile->file_name.$fileExt]
        );
    }

}
