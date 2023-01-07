<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><h4><b>Add</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>>
                <h4>List</h4></a>
        </li>
    </ul>


    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                echo $this->Form->control('email');
                echo $password = $this->Form->control('password');
                echo $this->Form->control('retype_password', ['type' => 'password']);
                echo $this->Form->control('first_name');
                echo $this->Form->control('surname');
                echo $this->Form->control('mobile_no');
                echo $this->Form->control('home_address');
                $options = ['1' => 'Managerial Clinician', '2' => 'Clinician', '3' => 'Client'];
                ?>
                <br>

                <h3><b>Role</b></h3>
                <?php
                echo $this->Form->select('role', $options);
                ?>
                <br><br><br><br>
            </fieldset>
            <a class="float-right"><?= $this->Form->button(__('Submit')) ?> </a>
            <?= $this->Form->end() ?>
            <br><br><br><br>
        </div>
    </div>
</div>
