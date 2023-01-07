<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\PropertyStorageFoldersUser;

/**
 * PropertyStorageFoldersUsers Controller
 *
 * @property \App\Model\Table\PropertyStorageFoldersUsersTable $PropertyStorageFoldersUsers
 *
 * @method \App\Model\Entity\PropertyStorageFoldersUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyStorageFoldersUsersController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['index', 'add', 'edit', 'delete', 'view', 'setdefaultaccess'])) {
            return true;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($folder_id, $property_id)
    {
        $this->viewBuilder()->setLayout('item_index');

        $this->paginate = [
            'contain' => ['Users', 'PropertyStorageFolders'],
        ];

        $this->loadModel('PropertiesUsers');

        // Those with access level 0s and 1s in the property already have contributor access by default.
        $accessLevelArrays = [0, 1];
        $propertyUsers = $this->PropertiesUsers->find()
            ->where([
                'property_id' => $property_id,
                'access_level NOT IN' => $accessLevelArrays
            ]);

        $this->set('propertyUsers', $propertyUsers->all());

        if ($propertyUsers->first() == null) {
            $this->set('hasUsers', false);
        } else {
            $this->set('hasUsers', true);
        }


        $this->loadModel('PropertyStorageFoldersUsers');

        $propertyStorageFoldersUser = $this->PropertyStorageFoldersUsers->newEntity();

        if ($this->request->is(array('post', 'put'))) {
            $existingPropertyStorageFolderUsers = $this->PropertyStorageFoldersUsers->find()->where(['property_storage_folder_id' => $folder_id])->all();
            $propertyStorageFolderUsersPost = $this->PropertyStorageFoldersUsers->patchEntities($existingPropertyStorageFolderUsers, $this->request->getData());

            if ($this->PropertyStorageFoldersUsers->saveMany($propertyStorageFolderUsersPost)) {
                return $this->redirect(['action' => 'index', $folder_id, $property_id]);
            } else {
                $this->Flash->error("The save has failed.  Please, try again at a later time or contact your administrator.");
            }
        }

        $this->set('folder_id', $folder_id);
        $this->set('property_id', $property_id);

        $this->set(compact('propertyStorageFoldersUser'));

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
            if ($access_level != null) {
                $access_level = $access_level->access_level;
                $this->set('access_level', $access_level);
            } else {
                $access_level = 'none';
                $this->set('access_level', $access_level);
            }
        };

        $this->loadModel('Properties');
        $property = $this->Properties->find()->select()->where(['id' => $property_id])->first();
        $this->set('currentprop_name', $property->property_name);


        // File Storage User Access
        $this->loadModel('PropertyStorageFoldersUsers');
        $this->loadModel('PropertyStorageFolders');

        // EXEMPT: Admins, access level 0-1
        if ($user->role == 'admin' || $access_level === 0 || $access_level === 1) {
            $storageFolders = $this->PropertyStorageFolders->find()
                ->where([
                    'property_id' => $property_id
                ]);
            $this->set('storageFolders', $storageFolders);
        } else {
            $psfusers = $this->PropertyStorageFoldersUsers->find()->where([
                'user_id' => $userId
            ])->all();

            $accessibleFolderIds = [];
            foreach ($psfusers as $psfuser) {
                if ($psfuser != null) {
                    // If user has managerial level access in the iterated folder.
                    if ($psfuser->folder_access_level == 3) {
                        array_push($accessibleFolderIds, $psfuser->property_storage_folder_id);
                    }
                }
            }

            // File Storage
            if ($accessibleFolderIds != null) {
                $storageFolders = $this->PropertyStorageFolders->find()
                    ->where([
                        'property_id' => $property_id
                        , 'id IN' => $accessibleFolderIds
                    ]);
            } // If they have no access to any folders.
            else {
                $storageFolders = $this->PropertyStorageFolders;
            }

            $this->set('storageFolders', $storageFolders);
        }

    }

    /**
     * View method
     *
     * @param string|null $id Property Storage Folders User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $propertyStorageFoldersUser = $this->PropertyStorageFoldersUsers->get($id, [
            'contain' => ['Users', 'PropertyStorageFolders'],
        ]);

        $this->set('propertyStorageFoldersUser', $propertyStorageFoldersUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $propertyStorageFoldersUser = $this->PropertyStorageFoldersUsers->newEntity();
        if ($this->request->is('post')) {
            $propertyStorageFoldersUser = $this->PropertyStorageFoldersUsers->patchEntity($propertyStorageFoldersUser, $this->request->getData());
            if ($this->PropertyStorageFoldersUsers->save($propertyStorageFoldersUser)) {
                $this->Flash->success(__('The property storage folders user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property storage folders user could not be saved. Please, try again.'));
        }
        $users = $this->PropertyStorageFoldersUsers->Users->find('list', ['limit' => 200]);
        $propertyStorageFolders = $this->PropertyStorageFoldersUsers->PropertyStorageFolders->find('list', ['limit' => 200]);
        $this->set(compact('propertyStorageFoldersUser', 'users', 'propertyStorageFolders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Property Storage Folders User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $propertyStorageFoldersUser = $this->PropertyStorageFoldersUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyStorageFoldersUser = $this->PropertyStorageFoldersUsers->patchEntity($propertyStorageFoldersUser, $this->request->getData());
            if ($this->PropertyStorageFoldersUsers->save($propertyStorageFoldersUser)) {
                $this->Flash->success(__('The property storage folders user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property storage folders user could not be saved. Please, try again.'));
        }
        $users = $this->PropertyStorageFoldersUsers->Users->find('list', ['limit' => 200]);
        $propertyStorageFolders = $this->PropertyStorageFoldersUsers->PropertyStorageFolders->find('list', ['limit' => 200]);
        $this->set(compact('propertyStorageFoldersUser', 'users', 'propertyStorageFolders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Property Storage Folders User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertyStorageFoldersUser = $this->PropertyStorageFoldersUsers->get($id);
        if ($this->PropertyStorageFoldersUsers->delete($propertyStorageFoldersUser)) {
            $this->Flash->success(__('The property storage folders user has been deleted.'));
        } else {
            $this->Flash->error(__('The property storage folders user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function setdefaultaccess($folder_id, $property_id, $access_rights, $user_group)
    {

        // Get users
        $this->loadModel('PropertiesUsers');
        if ($user_group == 'all') {
            $users = $this->PropertiesUsers->find()->where(['property_id' => $property_id])->all();
        }
        else if ($user_group == 'AL2')
        {
            $users = $this->PropertiesUsers->find()->where(['property_id' => $property_id, 'access_level' => 2])->all();
        }
        else if ($user_group == 'AL3')
        {
            $users = $this->PropertiesUsers->find()->where(['property_id' => $property_id, 'access_level' => 3])->all();
        }
        else if ($user_group == 'AL4')
        {
            $users = $this->PropertiesUsers->find()->where(['property_id' => $property_id, 'access_level' => 4])->all();
        }
        else if ($user_group == 'AL5')
        {
            $users = $this->PropertiesUsers->find()->where(['property_id' => $property_id, 'access_level' => 5])->all();
        }
        else
        {
            $users = $this->PropertiesUsers->find()->where(['property_id' => $property_id, 'access_level' => 100])->all();
        }

        // Apply access rights
        $propertyUsers = [];
        foreach ($users as $user)
        {
            $existingUser = $this->PropertyStorageFoldersUsers->find()->where(['property_storage_folder_id' => $folder_id, 'user_id' => $user->user_id])->first();

            if ($existingUser != null)
            {
                $property_user = [
                    'id' => $existingUser->id,
                    'user_id' => $user->user_id,
                    'property_storage_folder_id' => $folder_id,
                    'folder_access_level' => $access_rights
                ];
            }
            else
            {
                $property_user = [
                    'user_id' => $user->user_id,
                    'property_storage_folder_id' => $folder_id,
                    'folder_access_level' => $access_rights
                ];
            }

            array_push($propertyUsers, $property_user);
        }

        $existingPropertyStorageFolderUsers = $this->PropertyStorageFoldersUsers->find()->where(['property_storage_folder_id' => $folder_id])->all();
        $propertyStorageFolderUsersPost = $this->PropertyStorageFoldersUsers->patchEntities($existingPropertyStorageFolderUsers, $propertyUsers);

        $this->PropertyStorageFoldersUsers->saveMany($propertyStorageFolderUsersPost);

        return $this->redirect(['action' => 'index', $folder_id, $property_id]);
    }
}
