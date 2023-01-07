<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\Mailer\Email;

/**
 * Enquiries Controller
 *
 * @property \App\Model\Table\EnquiriesTable $Enquiries
 *
 * @method \App\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnquiriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['add','logout'])) {
            $this->loadComponent('Recaptcha.Recaptcha');
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->getParam('action'), ['index','edit','view','delete','close','open'])) {
            $user=$this->Auth->user();
            if ($user['role'] === 'admin' ) {
                return true;
            }
        }
        return parent::isAuthorized($user); // TODO: Change the autogenerated stub
    }


    public function index()
    {

        $key=$this->request->getQuery('key');
        if ($key){
            $query=$this->Enquiries->find('all')->where(['OR'=>['name like'=>'%'.$this->request->getQuery('key').'%',
                'temp_email like'=>'%'.$this->request->getQuery('key').'%',
                'topic like'=>'%'.$this->request->getQuery('key').'%',
                'date like'=>'%'.$this->request->getQuery('key').'%',
                'status like'=>'%'.$this->request->getQuery('key').'%',
            ]]);
        }else{
            $query=$this->Enquiries;
        }
        $enquiries = $this->paginate($query);

        $this->set(compact('enquiries'));

        //getting user id
        $userid=$this->Auth->user('id');

        //to get the user data
        $user = $this->Enquiries->Users->get($userid, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * View method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enquiry = $this->Enquiries->get($id, [
            'contain' => [],
        ]);

        $this->set('enquiry', $enquiry);


        //getting user id
        $userid=$this->Auth->user('id');

        //to get the user data
        $user = $this->Enquiries->Users->get($userid, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }
    public function contactus(){
        $this->viewBuilder()->setLayout('contactus');
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    //contact us enquiry form
    public function add()
    {
        $enquiry = $this->Enquiries->newEntity();
        if ($this->request->is('post')) {
            if ($this->Recaptcha->verify()) {
                $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData());
                date_default_timezone_set('Australia/Melbourne');
                $enquiry->date=Time::now();
                // If the user is logged in, we assign the user id foreign key to the enquiry.
                if ($this->Auth->user()) {
                    // Associate enquiry with this user's ID
                    $enquiry->user_id = $this->Auth->user('id');
                }


                if ($this->Enquiries->save($enquiry)) {
                    $this->Flash->success2(__('The enquiry has been saved.'));

                    //getting email data for customer
                    $name = $this->request->getData('name');
//                $customerEmail = 'purnomomaximillian@gmail.com';
                    $emailFrom = $this->request->getData('temp_email');
                    $topic = $this->request->getData('topic');
                    $message = $this->request->getData('message');
                $mailTo = 'Damian@cosmicproperty.com.au';
//                    $mailTo = 'purnomomaximillian@gmail.com';
                    $themessage="Hi there is an email from " . $name . ".\nHis/her email is " . $emailFrom . " .\nThe topic is about " .
                        $topic . ".\nThe message is :\n" . $message;


                    //send email confirmation to customer
                    $emailToCustomer = new Email('mailgun');
                    $emailToCustomer
                        ->setTo($emailFrom)
                        ->setFrom(['auto_reply@cosmicproperty.com.au'=>'Cosmic Property'])
                        ->setSubject('Enquiry Auto Reply')
                        ->setEmailFormat('html')
                        ->viewBuilder()->setTemplate('enquiry')
                        ->setVars(['name'=>$name]);
                    $emailToCustomer->setAttachments(['logo.png' =>
                        ['file' =>Configure::read('App.imageBaseUrl') . 'logo.png', 'contentId' => '123456']]);

                    //email notification to admin that there is a new enquiry
                    $emailToAdmin = new Email('mailgun');
                    $emailToAdmin
                        ->setTo($mailTo)
                        ->setFrom(['auto_reply@cosmicproperty.com.au'=>'Cosmic Property'])
                        ->setSubject('Cosmic Property Enquiries');
//                    ->send($themessage);
                    $emailToAdmin->setAttachments(['logo.png' =>
                        ['file' =>Configure::read('App.imageBaseUrl') . 'logo.png', 'contentId' => '123456']]);

                    //check email success or not
                    if($emailToCustomer->send() && $emailToAdmin->send($themessage))
                    {
                        $this->Flash->success2(__('Mail sent.'));
                        return $this->redirect(array('controller'=>'websites','action'=>'contactus'));
                    }
                    $this->Flash->error2(__('Problem during sending email.'));
                    return $this->redirect(['controller'=>'websites','action' => 'contactus']);
                }
                $this->Flash->error2(__('The enquiry could not be saved. Please, try again.'));
            }
            $this->redirect(['action'=>'contactus']);
            $this->Flash->error2('Please do the recaptcha');
        }
        $this->set(compact('enquiry'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enquiry = $this->Enquiries->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData());
            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success(__('The enquiry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
        }
        $this->set(compact('enquiry'));


        //getting user id
        $userid=$this->Auth->user('id');

        //to get the user data
        $user = $this->Enquiries->Users->get($userid, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Delete method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquiry = $this->Enquiries->get($id);
        if ($this->Enquiries->delete($enquiry)) {
            $this->Flash->success(__('The enquiry has been deleted.'));
        } else {
            $this->Flash->error(__('The enquiry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function close($id = null)
    {
        $enquiry = $this->Enquiries->get($id);

        $enquiry->status = 'close';

        // Note how with the delete(...) action, the redirect happens regardless of whether it was successful or not,
        // the only difference is whether it does Flash->success() or Flash->error().
        // By only redirecting on success, the user will have to force a browser refresh for a POST request.
        if ($this->Enquiries->save($enquiry)) {
            $this->Flash->success(__('This enquiry has been closed.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to close this enquiry.'));
    }

    public function open($id = null)
    {
        $enquiry = $this->Enquiries->get($id);
        $enquiry->status = 'open';

        // See comment in close() action.
        if ($this->Enquiries->save($enquiry)) {
            $this->Flash->success(__('The enquiry has been re-opened.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to re-open the enquiry.'));
    }


}