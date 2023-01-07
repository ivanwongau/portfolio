<?php
namespace App\Controller;

use App\Controller\AppController;

class MonashHealthController extends AppController
{
    public function index(){
        $this->Authorization->skipAuthorization();

        $this->viewBuilder()->setLayout('home');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index']);
    }

    public function view(){
        $this->Authorization->skipAuthorization();
    }

}
