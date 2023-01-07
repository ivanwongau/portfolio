<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsClinician $clientsClinician
 */

use Cake\ORM\TableRegistry;
echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');

?>
<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

?>

<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link add active" aria-current="page" href=
                <?= $this->Url->build(['controller' => 'ClientsClinicians', 'action' => 'add']); ?>>
                <h4><b>Add</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'ClientsClinicians', 'action' => 'index']); ?>>
                <h4>Return to List</h4></a>
        </li>
    </ul>

    <?php

    // This query section checks for clients who do not yet have a clinician assigned to them.
    // Over here, we assume that each client only has one clinician that they are assigned to.
    // Thus, we disable new clinican pairs for clients who already have a clnician.
    $clientsQuery = TableRegistry::getTableLocator()->get('Clients');
    $clients = $clientsQuery->find()->select([])->all();

    $allClients = [];
    foreach ($clients as $client){
        array_push($allClients, $client);
    }

    $usersQuery = TableRegistry::getTableLocator()->get('Users');
    $ccQuery = TableRegistry::getTableLocator()->get('ClientsClinicians');

    $unassignedClients = [];
    foreach ($allClients as $currentClient) {
        $clientWithPair = $ccQuery->find()->select([])->where(['client_id' => $currentClient->id])->first();

        if($clientWithPair == null){
            $clients = $clientsQuery->find()->select([])->all();
            $clientUserInfo = $usersQuery->find()->select([])->where(['id' => $currentClient->user_id])->first();
            $unassignedClients[$currentClient->id] = $clientUserInfo->first_name. ' ' .$clientUserInfo->surname;
        }
    }

    ?>

    <div class="column-responsive column-80">
        <div class="clientsClinicians form content">
            <?= $this->Form->create($clientsClinician) ?>
            <fieldset>
                <legend><?= __('Add Clients Clinician') ?></legend>
                <?php
                    echo $this->Form->control('client_id', ['options' => $unassignedClients]);
                    echo $this->Form->control('clinician_id', ['options' => $clinicians]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

    <?php
}
?>
