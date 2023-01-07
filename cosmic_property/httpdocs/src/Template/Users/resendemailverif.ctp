<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>


<?php $this->layout = 'flexstart'?>


<div class="register_form">
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <?php echo $this->Html->image('/assets/img/login.jpg',array('class'=>'login-card-img'));?>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <p class="login-card-description">Re-send Email Verification</p >
                        <?= $this->Form->create('',['url' => '/users/resendemailverif']);?>
                        <?= $this->Form->control('email',array('class'=>'form-control'));?>
                        <?= $this->Form->button('Send Email Verification',array('type'=>'password','class'=>'btn btn-block login-btn mb-4'));?>
                        <?= $this->Form->end();?>
                        <?php echo  $this->Html->link('Continue Login?',
                            ['controller'=>'users','action' => 'login'], ['class' => 'forgot-password-link']);?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
