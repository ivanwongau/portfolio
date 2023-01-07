<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

use Cake\ORM\TableRegistry;

?>
<div class="row">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link add active" aria-current="page" href="">
                <h4><b>Edit</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="
                <?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                <h4>Return to List</h4></a>
        </li>
    </ul>


    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php

                date_default_timezone_set('Australia/Melbourne');
                $date = date('m/d/Y h:i:s a', time());

                echo $this->Form->control('email');
                echo $this->Form->control('password');
                echo $this->Form->control('first_name');
                echo $this->Form->control('surname');
                echo $this->Form->control('mobile_no');
                echo $this->Form->control('home_address');
                echo $this->Form->control('modified_date', ['value' => $date, 'label' => '', 'hidden' => 'true']);
                echo $this->Form->control('role', ['label' => '', 'hidden' => 'true']);
                ?>
            </fieldset>

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
