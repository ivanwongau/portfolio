
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
                        <p class="login-card-description">Sign into your account</p>
                        <?= $this->Form->create();?>
                        <?= $this->Form->control('email',array('class'=>'form-control'));?>
                        <?= $this->Form->control('password',array('type'=>'password','class'=>'form-control'));?>
                        <?= $this->Form->submit('Login',array('class'=>'btn btn-block login-btn mb-4'));?>
                        <?= $this->Form->end();?>


                        <?php echo  $this->Html->link('Forgot password?',
                            ['controller'=>'users','action' => 'forgotpassword'], ['class' => 'forgot-password-link']);?>
                        <br>
                        <?php echo  $this->Html->link('Re-send email verification?',
                            ['controller'=>'users','action' => 'resendemailverif'], ['class' => 'forgot-password-link']);?>
                        <p class="login-card-footer-text">Don't have an account?
                            <a href="add" class="text-reset" >Register here</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

