<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Users</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'index']) ?>">Users</a></li>
                            <li class="breadcrumb-item">Users Edit</li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <h2 class="mt-5">Edit Users</h2>
        <hr>
        <?php echo $this->Form->create($userEdit, array('class' => 'needs-validation')) ?>
        <div class="row">

            <div class="col-md-6 mb-3">
                <?php echo $this->Form->control("Email", array('type' => 'email', 'class' => 'form-control', 'placeholder' => 'email', 'required' => false)) ?>

            </div>

            <div class="col-md-6 mb-3">
                <?php echo $this->Form->control("password", array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'password', 'required' => false)) ?>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <?php echo $this->Form->control("first_name", array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'First Name', 'required' => false)) ?>
            </div>
            <div class="col-md-6 mb-3">
                <?php echo $this->Form->control("last_name", array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Last Name', 'required' => false)) ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo $this->Form->control("phone", array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Phone Number', 'required' => false)) ?>
            </div>
            <div class="form-group col-md-6">
                <?php echo $this->Form->control('company_name', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Company Name', 'required' => false)) ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->control('company_street', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Company Street', 'required' => false)) ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->control('company_city', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Company City', 'required' => false)) ?>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo $this->Form->control('company_state', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Company State', 'required' => false)) ?>
            </div>
            <div class="form-group col-md-4">
                <?php echo $this->Form->control('company_postcode', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Company Postcode', 'required' => false)) ?>
            </div>
            <div class="form-group col-md-2">
                <?php echo $this->Form->control('company_country', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Company Country', 'required' => false)) ?>
            </div>
        </div>
        <div class="d-flex">
            <div class="p-2">
                <?php echo $this->Html->link(__('Back'), ['action' => 'index'], array('type' => 'button', 'class' => 'btn  btn-secondary')) ?>
            </div>
            <div class="ml-auto p-2">
                <?php echo $this->Form->button(__('Submit'), array('type' => 'submit', 'class' => 'btn  btn-primary')) ?>
            </div>
        </div>



    </div>
</div>
