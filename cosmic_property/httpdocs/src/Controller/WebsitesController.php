<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Form\ContactForm;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;

/**
 * Enquiries Controller
 *
 * @property \App\Model\Table\EnquiriesTable $Enquiries
 *
 * @method \App\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WebsitesController extends AppController
{
//   controller to home page
    public function home()
    {
        $this->viewBuilder()->setLayout('home');
    }
//    controller to about us page
    public function aboutus(){
        $this->viewBuilder()->setLayout('aboutus');
    }
//    controller to contact us page
    public function contactus(){
        $this->redirect(['controller'=>'enquiries','action'=>'contactus']);
    }
//    controller to commercial construction page
    public function commercons(){
        $this->viewBuilder()->setLayout('commercons');
    }
//    controller to industrial construction page
    public function induscons(){
        $this->viewBuilder()->setLayout('induscons');
    }
//    controller to small construction page
    public function smallcommcons(){
        $this->viewBuilder()->setLayout('smallcommcons');
    }
    //    controller to office fit out page
    public function ofitout(){
        $this->viewBuilder()->setLayout('ofitout');
    }
    //    controller to office de fit page
    public function defit(){
        $this->viewBuilder()->setLayout('defit');
    }
    //    controller to warehouse conversion page
    public function wareconver(){
        $this->viewBuilder()->setLayout('wareconver');
    }
    //    controller to apartment refurbishment and domestic upgrade page
    public function aptrefur(){
        $this->viewBuilder()->setLayout('aptrefur');
    }
//    controller to project mangement page
    public function projmana(){
        $this->viewBuilder()->setLayout('projmana');
    }
    //    controller to inspection page
    public function inspection(){
        $this->viewBuilder()->setLayout('inspection');
    }
    //    controller to LTMP page
    public function ltmp(){
        $this->viewBuilder()->setLayout('ltmp');
    }
    //    controller to BCR page
    public function bcr(){
        $this->viewBuilder()->setLayout('bcr');
    }
    public function testlayout(){
        $this->viewBuilder()->setLayout('flexstart');
    }


}
