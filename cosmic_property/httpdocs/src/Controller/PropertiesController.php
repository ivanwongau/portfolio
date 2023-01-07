<?php

namespace App\Controller;

use App\Controller\AppController;
use phpDocumentor\Reflection\Types\Array_;

/**
 * Properties Controller
 *
 * @property \App\Model\Table\PropertiesTable $Properties
 * @property \App\Model\Table\SubscriptionTable $Subscriptions
 *
 * @property \App\Model\Table\PropertiesUsersTable $PropertiesUsers
 *
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertiesController extends AppController

{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public $paginate = [
        'limit' => 100,
        'order' => [

        ]
    ];
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['add', 'dashboard', 'buildinglist', 'edit', 'view', 'logout', 'delete', 'subscribe', 'propertyToPropertyImage', 'propertyToFolder', 'reportDownload', 'dataFinalization', 'action'])) {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->getParam('action'), ['index'])) {
            $user = $this->Auth->user();
            if ($user['role'] === 'admin') {
                return true;
            }
        }
        return parent::isAuthorized($user); // TODO: Change the autogenerated stub
    }



    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        // $buildings = $this->paginate($this->Properties);

        $buildings = $this->paginate($query);



        $this->set(compact('buildings'));
    }

    /**
     * View method
     *
     * @param string|null $id Building id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $access_level = null)
    {
        //getting user id
        $userid = $this->Auth->user('id');

        //to get the user data
        $user = $this->Properties->Users->get($userid, [
            'contain' => [],
        ]);

        $this->set('user', $user);

        //getting building data
        $building = $this->Properties->get($id, [
            'contain' => ['Users', 'PropertyMultiOwnerships'],
        ]);

        $this->set('building', $building);

        $this->set('access_level', $access_level);
    }

    // link to dashboard

    public function dashboard($id = null)
    {
        $this->loadModel('Property');
        // Set the layout for the view page
        $this->viewBuilder()->setLayout('property_view');

        $property = $this->Properties->get($id, [
            'contain' => ['PropertyImages', 'ItemFolders', 'ItemMaintenances']
        ]);

        $this->set('property', $property);


        // add folder & List Folder
        $this->loadModel('ItemFolders');
        $query = $this->ItemFolders->find()
            ->where([
                'property_id' => $id,
            ]);
        $item_folder_paginate = $this->paginate($query);
        $this->set(compact('item_folder_paginate'));

        $itemFolder = $this->ItemFolders->newEntity();
        if ($this->request->is('post')) {
            $itemFolder = $this->ItemFolders->patchEntity($itemFolder, $this->request->getData());
            $itemFolder->property_id = $id;
            if ($this->ItemFolders->save($itemFolder)) {
                $this->Flash->success(__('The item folder has been saved.'));

                return $this->redirect(['action' => 'dashboard', $id]);
            }
            $this->Flash->error(__('The item folder could not be saved. Please, try again.'));
        }
        $this->set('currentprop_id', $id);
        $this->set('query', $query);
        $this->set(compact('itemFolder', 'property'));

        // List Maintenance Item
        $this->loadModel('ItemMaintenances');
        $maintenance = $this->ItemMaintenances->find()
            ->where([
                'property_id' => $id,
            ]);
        $item_maintenance_paginate = $this->paginate($maintenance, ['limit' => 10]);
        $this->set('maintenance', $item_maintenance_paginate);


        // Items
        $this->loadModel('Items');

        $folder_ids = $this->ItemFolders->find()
            ->select(['id'])
            ->where(
                ['property_id' => $id]
            )->toArray();

        $item_data = [];

        for ($i = 0; $i < count($folder_ids); $i++) {
            //will return all items inside 1 folder as an array

            $items = $this->Items->find()
                ->where(
                    ['folder_id' => $folder_ids[$i]['id']]
                );
            //iterate through that array and store it into the item_data

            foreach ($items as $item) {
                array_push($item_data, $item);
            }
        }
        $this->set('item_data', $item_data);

        /* Multi Ownership */
        $this->loadModel('PropertyMultiOwnerships');
        $propertyMultiOwnership = $this->PropertyMultiOwnerships->find()->where(['property_id' => $id]);


        $is_multi = $property->ownership_type;
        if ($is_multi == 'Single') {
            $is_multi = 'Single Ownership Type';
        } elseif ($propertyMultiOwnership->isEmpty()) {
            $is_multi = 'Add More';
        } else {
            $is_multi = 'Multi';
        }
        $this->set('is_multi', $is_multi);

        $this->set('propertyMultiOwnership', $propertyMultiOwnership);

        if ($property->status == "active") {
            $this->loadModel("Subscriptions");
            $Subscriptions = $this->Subscriptions->find()->where(['property_id' => $id])->toArray();
            $this->set('subscriptions', $Subscriptions[count($Subscriptions) - 1]);
        };



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
                ['property_id' => $id, 'user_id' => $user->id]
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


        // File Storage User Access
        $this->loadModel('PropertyStorageFoldersUsers');
        $this->loadModel('PropertyStorageFolders');

        // EXEMPT: Admins, access level 0-1
        $accessibleFolderIds = [];

        if ($user->role == 'admin' || $access_level === 0 || $access_level === 1)
        {
            $storageFolders = $this->PropertyStorageFolders->find()
                ->where([
                    'property_id' => $id
                ]);

            foreach ($storageFolders as $storageFolder) {
                array_push($accessibleFolderIds, $storageFolder->id);
            }

            $this->set('storageFolders', $storageFolders);
        }
        else
        {
            $psfusers = $this->PropertyStorageFoldersUsers->find()->where([
                'user_id' => $userId
            ])->all();

            foreach ($psfusers as $psfuser)
            {
                if ($psfuser != null) {
                    if ($psfuser->folder_access_level != 0) {
                        array_push($accessibleFolderIds, $psfuser->property_storage_folder_id);
                    }
                }
            }

            // File Storage
            if ($accessibleFolderIds != null)
            {
                $storageFolders = $this->PropertyStorageFolders->find()
                    ->where([
                        'property_id' => $id
                        ,'id IN' => $accessibleFolderIds
                    ]);
            }
            // If they have no access to any folders.
            else
            {
                $storageFolders = $this->PropertyStorageFolders;
            }

            $this->set('storageFolders', $storageFolders);
        }

        // File storage calculations
        $totalFileStorageSize = 0;

        $allPropertyFolderIds = [];

        $allStorageFolders = $this->PropertyStorageFolders->find()
            ->where([
                'property_id' => $id
            ]);

        foreach ($allStorageFolders as $storageFolder) {
            array_push($allPropertyFolderIds, $storageFolder->id);
        }

        $this->loadModel('PropertyStorageFiles');
        if ($accessibleFolderIds != [] || $accessibleFolderIds != null)
        {
            $propertyStorageFiles = $this->PropertyStorageFiles->find()->where(['folder_id IN' => $allPropertyFolderIds])->all();
            foreach ($propertyStorageFiles as $propertyStorageFile)
            {
                $totalFileStorageSize += filesize(WWW_ROOT.$propertyStorageFile->file_path);
            }

            if($propertyStorageFiles != null)
            {
                $totalFileStorageSize = round(($totalFileStorageSize / 1024 / 1024 / 1024), 5);
            }

            $totalFileStorageSize = $totalFileStorageSize;
        }

        $this->set('totalFileStorageSize', $totalFileStorageSize);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //getting user id
        $id = $this->Auth->user('id');

        //to get the user data
        $user = $this->Properties->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);

        //        setting the country
        $this->loadModel('Countries');
        $countries = $this->Countries->find()->select(['name'])->toArray();
        $editedCountries = [];
        foreach ($countries as $country) {
            array_push($editedCountries, $country->name);
        }
        $this->set(compact('editedCountries'));

        //start adding
        $building = $this->Properties->newEntity();
        if ($this->request->is('post')) {
            $building = $this->Properties->patchEntity($building, $this->request->getData());
            $currentYear = date("Y");
            if (!empty($this->request->getData('age')) || !empty($this->request->getData('year_built'))) {
                $building->age = $currentYear - ($building->year_built);
            }
            //change the country for the value in the array
            $building->country = $editedCountries[$building->country];
            if ($building->GST >= 1) {
                $GST = $building->GST * 0.01;
            } elseif ($building->GST < 1) {
                $GST = $building->GST;
            }
            $building->GST = $GST;


            if ($building->contribution_safety_net != null) {
                $contribution_safety_net = $building->contribution_safety_net * 0.01;
            } else {
                $contribution_safety_net = $building->contribution_safety_net;
            }
            $building->contribution_safety_net = $contribution_safety_net;

            if ($building->interest_rate != null) {
                $interest_rate = $building->interest_rate * 0.01;
            } else {
                $interest_rate = $building->interest_rate;
            }
            $building->interest_rate = $interest_rate;

            if ($building->inflation_rate != null) {
                $inflation_rate = $building->inflation_rate * 0.01;
            } else {
                $inflation_rate = $building->inflation_rate;
            }
            $building->inflation_rate = $inflation_rate;

            if ($building->base_contribution_percentage >= 1) {
                $base_contribution_percentage = $building->base_contribution_percentage * 0.01;
            } elseif ($building->base_contribution_percentage < 1) {
                $base_contribution_percentage = $building->base_contribution_percentage;
            }
            $building->base_contribution_percentage = $base_contribution_percentage;

            if ($building->tax_rate >= 1) {
                $tax_rate = $building->tax_rate * 0.01;
            } elseif ($building->tax_rate < 1) {
                $tax_rate = $building->tax_rate;
            }
            $building->tax_rate = $tax_rate;
            //            debug($building);
            //            exit();

            var_dump($building);

            $res = $this->Properties->save($building);

            //  var_dump($building);
            if ($res) {
                $this->Flash->success(__('The building has been saved.'));

                //adding to the association table
                if ($this->request->is('post')) {
                    $buiID = $res->id;
                    $userID = $this->request->getData('user_id');
                    $accessLevel = $this->request->getData('access_level');
                    $result = ['user_id' => $userID, 'building_id' => $buiID, 'access_level' => $accessLevel];
                    return $this->redirect(['controller' => 'PropertiesUsers', 'action' => 'add', $buiID]);
                }
                $users = $this->PropertiesUsers->Users->find('list', ['limit' => 200]);
                $buildings = $this->PropertiesUsers->Properties->find('list', ['limit' => 200]);
                $this->set(compact('buildingsUser', 'users', 'buildings'));




                return $this->redirect(['action' => 'buildinglist']);
            }
            $this->Flash->error(__('The building could not be saved. Please, try again.'));
        }
        $users = $this->Properties->Users->find('list', ['limit' => 200])->where(['id' => $id]);
        $this->set(compact('users'));
        $this->set('property', $building);
    }

    /**
     * Edit method
     *
     * @param string|null $id Building id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //getting user id
        $userid = $this->Auth->user('id');

        //to get the user data
        $user = $this->Properties->Users->get($userid, [
            'contain' => [],
        ]);

        $this->set('user', $user);

        //        setting the country
        $this->loadModel('Countries');
        $countries = $this->Countries->find()->select(['name'])->toArray();
        $editedCountries = [];
        foreach ($countries as $country) {
            array_push($editedCountries, $country->name);
        }
        $this->set(compact('editedCountries'));

        //start edit
        $building = $this->Properties->get($id, [
            'contain' => [],
        ]);
        $building2 = $building;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $building = $this->Properties->patchEntity($building, $this->request->getData());
            $currentYear=date("Y");
            if ( $this->request->getData('year_built')!=0) {
                $building->age = $currentYear - ($building->year_built);
            }
            //            debug($building->country);
            //            exit();
            if (!empty($building->country) && is_numeric($building->country)) {
                $building->country = $editedCountries[$building->country];
            } elseif (!empty($building->country) && !is_numeric($building->country)) {

                $building->country = $building->country;
            } else {
                $building->country = $building2->country;
            }
            if ($building->GST >= 1) {
                $GST = $building->GST * 0.01;
            } elseif ($building->GST < 1) {
                $GST = $building->GST;
            }
            $building->GST = $GST;

            if ($building->contribution_safety_net != null) {
                $contribution_safety_net = $building->contribution_safety_net * 0.01;
            } else {
                $contribution_safety_net = $building->contribution_safety_net;
            }
            $building->contribution_safety_net = $contribution_safety_net;

            if ($building->interest_rate != null) {
                $interest_rate = $building->interest_rate * 0.01;
            } else {
                $interest_rate = $building->interest_rate;
            }
            $building->interest_rate = $interest_rate;

            if ($building->inflation_rate != null) {
                $inflation_rate = $building->inflation_rate * 0.01;
            } else {
                $inflation_rate = $building->inflation_rate;
            }
            $building->inflation_rate = $inflation_rate;

            if ($building->base_contribution_percentage >= 1) {
                $base_contribution_percentage = $building->base_contribution_percentage * 0.01;
            } elseif ($building->base_contribution_percentage < 1) {
                $base_contribution_percentage = $building->base_contribution_percentage;
            }
            $building->base_contribution_percentage = $base_contribution_percentage;

            if ($building->tax_rate >= 1) {
                $tax_rate = $building->tax_rate * 0.01;
            } elseif ($building->tax_rate < 1) {
                $tax_rate = $building->tax_rate;
            }
            $building->tax_rate = $tax_rate;
            //            debug($building);
            //            exit();
            $res = $this->Properties->save($building);

            if ($res) {
                $this->Flash->success(__('The building has been saved.'));

                return $this->redirect(['controller' => 'properties', 'action' => 'view', $id]);
            }
            $this->Flash->error(__('The building could not be saved. Please, try again.'));
        }
        $users = $this->Properties->Users->find('list', ['limit' => 200])->where(['id' => $userid]);
        $this->set(compact('building', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Building id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $building = $this->Properties->get($id);

        // Get all the property storage folders
        $this->loadModel('PropertyStorageFolders');
        $allPropertyFolderIds = [];
        $allStorageFolders = $this->PropertyStorageFolders->find()
            ->where([
                'property_id' => $id
            ]);

        foreach ($allStorageFolders as $storageFolder) {
            array_push($allPropertyFolderIds, $storageFolder->id);
        }

        $this->loadModel('PropertyStorageFiles');
        foreach ($allPropertyFolderIds as $propertyFolderId)
        {
            $folderFiles = $this->PropertyStorageFiles->find()->where(['folder_id' => $propertyFolderId])->all();

            foreach ($folderFiles as $folderFile) {
                $folderFilePath = $folderFile->file_path;

                if(unlink(WWW_ROOT.$folderFilePath)) {
                    $this->PropertyStorageFiles->delete($folderFile);
                }
            }

            $propertyStorageFolder = $this->PropertyStorageFolders->get($propertyFolderId);
            $this->PropertyStorageFolders->delete($propertyStorageFolder);
        }

        if ($this->Properties->delete($building)) {
            $this->Flash->success(__('The building has been deleted.'));
        } else {
            $this->Flash->error(__('The building could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'buildinglist']);
    }

    //list all buildings
    public function buildinglist($building_id = null)
    {
        $loggedUser = $this->Auth->user();
        //getting user id
        $id = $this->Auth->user('id');


        $key=$this->request->getQuery('key');
        if ($key){
            if ($loggedUser['role'] == 'customer') {
                //getting only the buildings where it has the user's id on it;
                $query = $this->Properties->find()
                    ->matching('PropertiesUsers', function ($q) {
                        $id = $this->Auth->user('id');
                        return $q->where(['OR'=>['property_name like'=>'%'.$this->request->getQuery('key').'%',
                            'street_name like'=>'%'.$this->request->getQuery('key').'%',
                            'city like'=>'%'.$this->request->getQuery('key').'%',
                            'state like'=>'%'.$this->request->getQuery('key').'%',
                            'country like'=>'%'.$this->request->getQuery('key').'%',
                            'building_type like'=>'%'.$this->request->getQuery('key').'%',
                            'ownership_type like'=>'%'.$this->request->getQuery('key').'%',
                            'status like'=>'%'.$this->request->getQuery('key').'%',
                            'PropertiesUsers.access_level like'=>$this->request->getQuery('key')],
                            'PropertiesUsers.user_id' => $id],['PropertiesUsers.access_level'=>'string']);
                    })
                    ->contain(['PropertiesUsers', 'Users']);
            } else if ($loggedUser['role'] == 'admin') {
                //getting all buildings
                $query = $this->Properties->find('all')
                    ->where(['OR'=>['property_name like'=>'%'.$this->request->getQuery('key').'%',
                    'street_name like'=>'%'.$this->request->getQuery('key').'%',
                    'city like'=>'%'.$this->request->getQuery('key').'%',
                    'state like'=>'%'.$this->request->getQuery('key').'%',
                    'country like'=>'%'.$this->request->getQuery('key').'%',
                    'building_type like'=>'%'.$this->request->getQuery('key').'%',
                    'ownership_type like'=>'%'.$this->request->getQuery('key').'%',
                    'status like'=>'%'.$this->request->getQuery('key').'%']]);
            }
        } else{
            if ($loggedUser['role'] == 'customer') {
                //getting only the buildings where it has the user's id on it;
                $query = $this->Properties->find()
                    ->matching('PropertiesUsers', function ($q) {
                        $id = $this->Auth->user('id');
                        return $q->where(['PropertiesUsers.user_id' => $id]);
                    })
                    ->contain(['PropertiesUsers', 'Users']);
            } else if ($loggedUser['role'] == 'admin') {
                //getting all buildings
                $query = $this->Properties;
            }
        }





        $this->paginate = [
            'contain' => ['Users'],
        ];
        $buildings = $this->paginate($query);

        $this->set(compact('buildings'));

        //to get the user data
        $user = $this->Properties->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    public function subscribe($id = null)
    {
        //getting user id
        $userid = $this->Auth->user('id');

        //to get the user data
        $user = $this->Buildings->Users->get($userid, [
            'contain' => [],
        ]);

        $this->set('user', $user);

        //getting building data
        $building = $this->Buildings->get($id, [
            'contain' => ['Users', 'MultiOwnerships'],
        ]);

        $buildings = $this->Buildings->find('list', ['limit' => 200])->where(['id' => $id]);
        $this->set(compact('buildings'));
        $this->set('building', $building);
    }


    public function propertyToPropertyImage($id = null, $currentprop_name = null)
    {
        $currentprop_id =  $id;
        return $this->redirect(array('controller' => 'PropertyImages', 'action' => 'add', $currentprop_id, $currentprop_name));
    }
    public function propertyToFolder($id = null, $currentprop_name = null)
    {
        $currentprop_id =  $id;
        return $this->redirect(array('controller' => 'ItemFolders', 'action' => 'index', $currentprop_id, $currentprop_name));
    }


    // report download
    public function reportDownload($id = null)
    {
        $this->loadModel('Subscriptions');

        $query = $this->Subscriptions->find()
            ->where([
                'property_id' => $id,
            ]);

        $this->set('forecast_period', $query->first()->forecast_in_advance);
        $this->set('forecast_period_display', $query->first()->forecast_period_display);


        $property = $this->Properties->get($id);
        $property_date = $property->property_date->i18nFormat('dd-MMM-yy');
        $starting_balance = $property->starting_balance;
        $this->set('property_date', $property_date);
        $this->set('starting_balance', $starting_balance);

        $this->viewBuilder()->setLayout('report_download');
        $this->loadModel('Items');
        $this->loadModel('ItemFolders');


        $folder_ids = $this->ItemFolders->find()
            ->select(['id'])
            ->where(
                ['property_id' => $id]
            )->toArray();

        $item_data = [];

        for ($i = 0; $i < count($folder_ids); $i++) {
            //will return all items inside 1 folder as an array

            $items = $this->Items->find()
                ->where(
                    ['folder_id' => $folder_ids[$i]['id']]
                );
            //iterate through that array and store it into the item_dat

            foreach ($items as $item) {
                array_push($item_data, $item);
            }
        }
        $this->set('item_data', $item_data);

        $this->set('inflation_rate', $property->inflation_rate);
        $this->set('property', $property);




        $total = 0;


        $this->loadModel("PropertyMultiOwnerships");
        $ownership = $this->PropertyMultiOwnerships->find()
            ->select(['id', 'Num_of_lot', 'Num_of_lot_liabilities'])
            ->where(
                ['property_id' => $id]
            );
        $lotOwnerData = [];
        $ownership_id = $ownership->first();

        if ($ownership_id != null) {
            $this->loadModel('LotOwners');
            $lotOwnerData = $this->LotOwners->find()
                ->where(
                    ['ownership_id' => $ownership_id->id]
                )->toArray();

            $this->set('lotOwnerData', $lotOwnerData);
            $this->set('ownership', $ownership->toArray());
        } else {
            $this->set('lotOwnerData', null);
            $this->set('ownership', null);
        }


        // how not to be optimized
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportDownload = $this->Properties->patchEntity($property, $this->request->getData());
            $inflation_rate = $this->request->getData("inflation_rate");
            if ($inflation_rate >= 1) {
                $inflation_rate = $inflation_rate * 0.01;
            } elseif ($inflation_rate < 1) {
                $inflation_rate = $inflation_rate * 0.01;
            }
            $reportDownload->inflation_rate = $inflation_rate;
            $contribution_safety_net = $this->request->getData("contribution_safety_net");
            if ($contribution_safety_net >= 1) {
                $contribution_safety_net = $contribution_safety_net * 0.01;
            } elseif ($contribution_safety_net < 1) {
                $contribution_safety_net = $contribution_safety_net * 0.01;
            }
            $reportDownload->contribution_safety_net = $contribution_safety_net;
            $interest_rate = $this->request->getData("interest_rate");
            if ($interest_rate >= 1) {
                $interest_rate = $interest_rate * 0.01;
            } elseif ($interest_rate < 1) {
                $interest_rate = $interest_rate * 0.01;
            }
            $reportDownload->interest_rate = $interest_rate;
            $GST = $this->request->getData("GST");
            if ($GST >= 1) {
                $GST = $GST * 0.01;
            } elseif ($GST < 1) {
                $GST = $GST * 0.01;
            }
            $reportDownload->GST = $GST;

            $tax_rate = $this->request->getData("tax_rate");
            if ($tax_rate >= 1) {
                $tax_rate = $tax_rate * 0.01;
            } elseif ($tax_rate < 1) {
                $tax_rate = $tax_rate * 0.01;
            }
            $reportDownload->tax_rate = $tax_rate;

            $base_contribution_percentage = $this->request->getData("base_contribution_percentage");
            if ($base_contribution_percentage >= 1) {
                $base_contribution_percentage = $base_contribution_percentage * 0.01;
            } elseif ($base_contribution_percentage < 1) {
                $base_contribution_percentage = $base_contribution_percentage * 0.01;
            }
            $reportDownload->base_contribution_percentage = $base_contribution_percentage;
            $this->Properties->save($reportDownload);
            return $this->redirect(['controller' => 'properties', 'action' => 'reportDownload', $property->id]);
        };
    }

    // data finalization
    /**
     * Edit method
     *
     * @param string|null $id Building id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function dataFinalization($id = null)
    {
        //getting user id
        $userid = $this->Auth->user('id');

        //to get the user data
        $user = $this->Properties->Users->get($userid, [
            'contain' => [],
        ]);

        $this->set('user', $user);




        //start edit
        $building = $this->Properties->get($id, [
            'contain' => [],
        ]);

        // check if finalized
        $building_status = '0';

        if ($building->finalized == 'false') {
            $building_status = 'The building is not finalized yet';
        } else {
            $building_status = 'The building is finalized';
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $building->finalized = 'true';
            if ($this->Properties->save($building)) {
                $this->Flash->success(__('The building has been saved.'));

                return $this->redirect(['controller' => 'properties', 'action' => 'view', $id]);
            }
            $this->Flash->error(__('The building could not be saved. Please, try again.'));
        }
        $users = $this->Properties->Users->find('list', ['limit' => 200])->where(['id' => $userid]);
        $this->set(compact('building', 'users'));
        $this->set('building_status', $building_status);
    }


    public function action($propID = null)
    {
        $loggedUser = $this->Auth->user();
        if ($loggedUser['role'] == 'customer') {
            //getting only the buildings where it has the user's id on it;

            $query = $this->Properties->PropertiesUsers->find()
                ->where(['user_id' => $loggedUser['id'], 'property_id' => $propID])->first();
            $this->set('access_level', $query['access_level']);
        } else if ($loggedUser['role'] == 'admin') {
            //getting all buildings
            $query = $this->Properties;
            $this->set('access_level', 1);
        }
        //        debug($query['access_level']);
        //        exit();

        $this->set('buiID', $propID);
        //        $buiData=$this->Properties->find()->where(['id'=>$propID])->first();
        //        $this->set($buiData,'$buiData');
        $building = $this->Properties->get($propID, [
            'contain' => ['Users', 'PropertyMultiOwnerships'],
        ]);

        $this->set('buiData', $building);
        //        debug($building);
        //        exit();
    }

    // public function deletebuilding($id = null)
    // {


        // $this->request->allowMethod(['post', 'delete']);
        // $building = $this->Properties->get($id);
        // if ($this->Properties->delete($building)) {
        //     $this->Flash->success(__('The building has been deleted.'));
        // } else {
        //     $this->Flash->error(__('The building could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'buildinglist']);


    // }
}