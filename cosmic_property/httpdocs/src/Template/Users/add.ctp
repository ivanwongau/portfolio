<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
    <?php $this->layout = 'flexstart'?>
    <link href=<?php echo $this->Url->build("/assets/css/register.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/css/montserrat-font.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css")?> rel="stylesheet">




<div class="page-content">
    <div class="form-v10-content">
        <form class="form-detail" action="#" method="post" id="myform">
            <div class="form-left">
                <?= $this->Form->create($user) ?>
                <h2>Personal Infomation</h2>
<!--                --><?php
//                echo $this->Form->control('email');
//                echo $this->Form->control('password');
//                echo $this->Form->control('first_name');
//                echo $this->Form->control('last_name');
//                echo $this->Form->control('phone')
//                ?>
                    <div class="form-row">
                        <?php  echo $this->Form->control('email',Array('class'=>'input-text','type'=>"text")); ?>
<!--                        <input type="text" name="Email" class="input-text" id="Email" placeholder="Email Address" required>-->
                    </div>
                <div class="form-row">
<!--                    <input type="text" name="Password" class="input-text" id="Password" placeholder="Password" required>-->
                    <?php  echo $this->Form->control('password'); ?>
                </div>

                <div class="form-group">
                    <div class="form-row form-row-1">
<!--                        <input type="text" name="first_name" id="first_name" class="input-text" placeholder="First Name" required>-->
                        <?php  echo $this->Form->control('first_name',Array('class'=>'input-text','type'=>"text")); ?>
                    </div>
                    <div class="form-row form-row-2">
<!--                        <input type="text" name="last_name" id="last_name" class="input-text" placeholder="Last Name" required>-->
                        <?php  echo $this->Form->control('last_name',Array('class'=>'input-text','type'=>"text")); ?>
                    </div>
                </div>
                <div class="form-row">
                    <?php  echo $this->Form->control('phone',Array('class'=>'phone','type'=>"text")); ?>
<!--                        <input type="text" name="phone" class="phone" id="phone" placeholder="Phone Number" required>-->

                </div>
            </div>
            <div class="form-right">
                <h2>Company Details</h2>
                <div class="form-row">
                    <h6 style="color: red"><b>NOTE : </b>Please do not provide any personal or private information here</h6>
<!--                    <input type="text" name="company_name" class="company_name" id="company_name" placeholder="Company Name" required>-->
                    <?php  echo $this->Form->control('company_name',Array('class'=>'input-text','type'=>"text")); ?>
                </div>
                <div class="form-row">
<!--                    <input type="text" name="company_street" class="company_street" id="company_street" placeholder="Company Street " required>-->
                    <?php  echo $this->Form->control('company_street',Array('class'=>'input-text','type'=>"text")); ?>
                </div>
                <div class="form-row">
<!--                    <input type="text" name="company_city" class="company_city" id="company_city" placeholder="Company City " required>-->
                    <?php  echo $this->Form->control('company_city',Array('class'=>'input-text','type'=>"text")); ?>
                </div>




                <div class="form-group">
                    <div class="form-row form-row-1">
                        <!--                        <input type="text" name="postcode" class="postcode" id="postcode" placeholder="PostCode" required>-->
                        <?php  echo $this->Form->control('postcode',Array('class'=>'input-text','type'=>"text")); ?>
                    </div>
                    <div class="form-row form-row-2">
                        <?php echo $this->Form->control('state',Array('class'=>'input-text','type'=>"text")); ?>
                        <!--                        <input type="text" name="company_country" class="company_country" id="company_country" placeholder="Company Country" required>-->
                    </div>

                </div>

<!--                </div>-->


                    <div class="form-row ">
                        <?php echo $this->Form->control('company_country',Array('class'=>'input-text','type'=>"text",'default'=>'Australia')); ?>
<!--                        <input type="text" name="company_country" class="company_country" id="company_country" placeholder="Company Country" required>-->
                    </div>





                <?php echo $this->Form->hidden('role', array('value' => 'customer')) ?>
            <div>

<!--            </div>-->
                <div class="form-row-last">
                    <?= $this->Form->button('Sign UP', ['class' => "register"])?>
                    <?= $this->Form->end() ?>
                </div>
<!--            </div>-->
                </div>
        </form>
    </div>
</div>














