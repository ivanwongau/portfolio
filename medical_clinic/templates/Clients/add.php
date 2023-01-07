<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */

use Cake\ORM\TableRegistry;

echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');

?>
<div class="row">

    <?php if ($this->Identity->get('role') === '3') {
        ?>
        <div class="column-responsive column-80">
            <div class="clients form content">
                <?= $this->Form->create($client) ?>
                <fieldset>
                    <legend><?= __('Add Client') ?></legend>
                    <?php
                    echo $this->Form->control('diabetes_type');
                    echo $this->Form->control('past_births');
                    echo $this->Form->control('medicare_no');
                    echo $this->Form->control('medicare_ref');
                    echo $this->Form->control('medical_history');
                    echo $this->Form->control('user_id', ['default' => $this->Identity->get('id'), 'label' => '', 'hidden' => 'true']);
                    echo $this->Form->control('clinicians._ids', ['options' => $clinicians, 'label' => '', 'hidden' => 'true']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    <?php } ?>

    <?php if ($this->Identity->get('role') === '1') {
        ?>
        
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link add active" aria-current="page" href=
                    <?= $this->Url->build(['controller' => 'Clients', 'action' => 'add']); ?>>
                    <h4><b>Add</b></h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=
                    <?= $this->Url->build(['controller' => 'Clients', 'action' => 'overview']); ?>>
                    <h4>Return to List</h4></a>
            </li>
        </ul>


        <?php

        // Get users who are of client role AND do not have an existing client profile.
        $usersQuery = TableRegistry::getTableLocator()->get('Users');
        $clientsQuery = TableRegistry::getTableLocator()->get('Clients');

        $users = $usersQuery->find()->select([])->all();

        $unregisteredClients = [];
        foreach ($users as $user) {
            // If user was assigned a role of '3' aka client on creation.
            if ($user->role == '3') {
                // If user does not have an existing profile.
                $clientRoleUser = $clientsQuery->find()->select([])->where(['user_id' => $user->id])->first();
                if ($clientRoleUser == null) {
                    $unregisteredClients[$user->id] = $user->first_name . ' ' . $user->surname;
                }
            }
        }

        ?>
        <div class="column-responsive column-80">
            <div class="clients form content">
                <?= $this->Form->create($client) ?>
                <fieldset>
                    <legend><?= __('Add Client') ?></legend>
                    <?php
                    echo $this->Form->control('diabetes_type');
                    echo $this->Form->control('past_births');
                    echo $this->Form->control('medicare_no');
                    echo $this->Form->control('medicare_ref');
                    echo $this->Form->control('medical_history');
                    echo $this->Form->control('user_id', ['options' => $unregisteredClients]);
                    echo $this->Form->control('clinicians._ids', ['options' => $clinicians, 'label' => '', 'hidden' => 'true']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    <?php } ?>

</div>
