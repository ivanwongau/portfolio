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
                        <p class="login-card-description">Reset your password</p >
                        <?= $this->Form->create();?>


                        <?php
                        echo $this->Form->control('password',array('class'=>'form-control','label'=>'New Password'));
                        ?>

                        <?=$this->Form->button('Reset password',array('type'=>'password','class'=>'btn btn-block login-btn mb-4'))?>
                        <?= $this->Form->end() ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

