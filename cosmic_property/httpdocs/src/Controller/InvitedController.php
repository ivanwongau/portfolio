<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Utility\Security;

/**
 * Invited Controller
 *
 * @property \App\Model\Table\InvitedTable $Invited
 *
 * @method \App\Model\Entity\Invited[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvitedController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function isAuthorized($user)
    {
        // building list is the new index
        if (in_array($this->request->getParam('action'), ['add','edit','view','logout','delete',
            'index','deleteRelatedUser'])) {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->getParam('action'), ['index'])) {
            $user=$this->Auth->user();
            if ($user['role'] === 'admin' ) {
                return true;
            }
        }
        return parent::isAuthorized($user); // TODO: Change the autogenerated stub
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Properties'],
        ];
        $invited = $this->paginate($this->Invited);

        $this->set(compact('invited'));
    }

    /**
     * View method
     *
     * @param string|null $id Invited id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invited = $this->Invited->get($id, [
            'contain' => ['Properties'],
        ]);

        $this->set('invited', $invited);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invited = $this->Invited->newEntity();
        if ($this->request->is('post')) {
            $invited = $this->Invited->patchEntity($invited, $this->request->getData());
            $this->loadModel('Users');
            $this->loadModel('PropertiesUsers');
            $invitedEmail=$this->request->getData('email');
            $propID=$this->request->getData('property_id');
            //get the data for checking
            $existingUser=$this->Users->find()->where(['email'=>$invitedEmail])->toArray();
            $addedAlready=$this->Invited->find()->where(['email'=>$invitedEmail,'property_id'=>$propID])->toArray();
            //check if the user has an account or not
            if(!empty($existingUser)){
                $this->Flash->error('That user already has an account');
                return $this->redirect(['controller'=>'properties','action'=>'buildinglist']);
            }
            //check if the user has already been invited to this property or not
            elseif (!empty($addedAlready)){
                $this->Flash->error('You have invited that user to this building');
                return $this->redirect(['controller'=>'properties','action'=>'buildinglist']);
            }
            if ($this->Invited->save($invited)) {
                $this->Flash->success(__('The invited has been saved.'));
                //getting email data for customer
//                $customerEmail = 'purnomomaximillian@gmail.com';
                $customerEmail=$this->request->getData('email');
                $link="http://cosmicproperty.com.au/invited/invitedregister/".$this->request->getData('email');
//                $link="http://testing-server.u20s2108.monash-ie.me/invited/invitedregister/".$this->request->getData('email');

                //send email verification to customer
                $emailToCustomer = new Email('mailgun');
                $emailToCustomer
                    ->setTo($customerEmail)
                    ->setSubject('Cosmic Property Added to a Property')
                    ->setFrom(['auto_reply@cosmicproperty.com.au'=>'Cosmic Property'])
                    ->setEmailFormat('html')
                    ->viewBuilder()->setTemplate('invitedtoprop')
                    ->setVars(['name'=>$this->request->getData()['email'],'token'=>$link]);
                $emailToCustomer->setAttachments(['logo.png' =>
                    ['file' =>Configure::read('App.imageBaseUrl') . 'logo.png', 'contentId' => '123456']]);

                if($emailToCustomer->send())
                {
                    $this->Flash->success(__('The person has been invited by email.'));
                    return $this->redirect(['controller'=>'properties','action' => 'buildinglist']);
                }
                $this->Flash->error(__('Problem during sending email.'));

                return $this->redirect(['controller'=>'properties','action' => 'buildinglist']);
            }
            $this->Flash->error(__('The invited could not be saved. Please, try again.'));
        }
        $properties = $this->Invited->Properties->find('list', ['limit' => 200]);
        $this->set(compact('invited', 'properties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invited id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null,$propID=null,$access_level=null)
    {
        $invited = $this->Invited->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invited = $this->Invited->patchEntity($invited, $this->request->getData());
            if ($this->Invited->save($invited)) {
                $this->Flash->success(__('The invited has been saved.'));
                return $this->redirect(['controller'=>'propertiesUsers','action' => 'relateduser',$propID]);
            }
            $this->Flash->error(__('The invited could not be saved. Please, try again.'));
        }
        $properties = $this->Invited->Properties->find('list', ['limit' => 200])->where(['property_id'=>$propID]);
        $this->set(compact('invited', 'properties','access_level'));

    }
    /**
     * Delete method
     *
     * @param string|null $id Invited id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invited = $this->Invited->get($id);
        $propID=$this->Invited->find()->where(['id'=>$id])->first()['property_id'];
        if ($this->Invited->delete($invited)) {
            $this->Flash->success(__('The invited has been deleted.'));
        } else {
            $this->Flash->error(__('The invited could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'propertiesUsers','action' => 'relateduser',$propID]);
    }

    public function invitedregister($newemail=null){
        $this->viewBuilder()->setLayout('invitedregister');
        $this->loadModel('Users');
        $user = $this->Users->newEntity();


        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $mytoken=Security::hash(Security::randomBytes(32));
            $user->token=$mytoken;
            $user->verified=1;
            $result=$this->Users->save($user);

            if ($result) {
                $this->Flash->success2(__('The user has been saved.'));

                //add the data from the invitation table
                $newUserID=$result->id;
                $this->loadModel('PropertiesUsers');
                $query=$this->Invited->find()->where(['email'=>$newemail])->toArray();
                if($query){
                    $data=[];
                    foreach ($query as $item){
                        $data['property_id']=$item->property_id;
                        $data['access_level']=$item->access_level;
                        $data['user_id']=$newUserID;
                        $buildingsUser = $this->PropertiesUsers->newEntity();
                        $buildingsUser = $this->PropertiesUsers->patchEntity($buildingsUser, $data);

                        if ($this->PropertiesUsers->save($buildingsUser)) {
                            $this->Flash->success2(__('The buildings user has been saved.'));
                            $this->request->allowMethod(['post', 'delete']);
                            $invited = $this->Invited->get($item->id);
                            if ($this->Invited->delete($invited)) {
                                $this->Flash->success2(__('The invited has been deleted.'));
                            } else {
                                $this->Flash->error2(__('The invited could not be deleted. Please, try again.'));
                            }
                        }
                        else{
                            $this->Flash->error(__('The buildings user could not be saved. Please, try again.'));
                        }
                    }
                    return $this->redirect(['controller'=>'users','action' => 'login']);
                }

            }
            $this->Flash->error2(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('email',$newemail);
    }
}