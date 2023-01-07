<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Goal $goal
 */

use Cake\ORM\TableRegistry;


?>
<div class="row">

    <div class="topTabBar">
        <br>
        <h1>Log your goals </h1>
        <br><br>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><h4><b>Add</b></h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=
                    <?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?>>
                    <h4>List</h4></a>
            </li>
        </ul>
    </div>



    <?php if ($this->Identity->get('role') === '3') {

        $userId = $this->Identity->get('id');

        $clientQuery = TableRegistry::getTableLocator()->get('Clients');
        $clientId = $clientQuery->find()->select([])->where(['user_id' => $userId])->firstOrFail()->id;
        $clientIdArray = [$clientId]
        ?>


        <div class="column-responsive column-80">
            <div class="goals form content">


                <?= $this->Form->create($goal) ?>
                <fieldset>
                    <legend><?= __('Add Goal') ?></legend>
                    <?php

                    echo $this->Form->control('client_id', ['default' => $clientId, 'hidden' => 'true', 'label' => '']);
                    echo $this->Form->control('goals_set');
                    echo $this->Form->control('completion_date');
                    ?>

                </fieldset>
                <a style="float: right;">
                    <?= $this->Form->button(__('Submit')) ?>
                </a>
                <?= $this->Form->end() ?>
                <br><br>
            </div>
        </div>
    <?php } ?>
</div>
<?php

if ($this->Identity->get('role') === '2' || $this->Identity->get('role') === '1') {

    $userId = $this->Identity->get('id');

    $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
    $clinician = $clinicianQuery->find()->select([])->where(['user_id' => $userId])->firstOrFail();

    // Verifies that the user has a clinician profile.
    if ($clinician != null) {
        $clientClinicianQuery = TableRegistry::getTableLocator()->get('ClientsClinicians');
        $clinicianClients = $clientClinicianQuery->find()->select([])->where(['clinician_id' => $clinician->id])->all();

        $clientsQuery = TableRegistry::getTableLocator()->get('Clients');
        $usersQuery = TableRegistry::getTableLocator()->get('Users');


        // Makes a key-value pair array of the clients' name and their id.
        $clientsOfClinician = [];
        foreach ($clinicianClients as $clinicianClient):
            $clientId = $clinicianClient->client_id;
            $clientUserId = $clientsQuery->find()->select([])->where(['id' => $clientId])->firstOrFail()->user_id;
            $userFirstName = $usersQuery->find()->select([])->where(['id' => $clientUserId])->firstOrFail()->first_name;
            $userSurame = $usersQuery->find()->select([])->where(['id' => $clientUserId])->firstOrFail()->surname;

            $clientsOfClinician[$clientId] = $userFirstName.' '.$userSurame;
        endforeach;

        ?>



        <div class="column-responsive column-80">
            <div class="goals form content">

                <?= $this->Form->create($goal) ?>
                <fieldset>

                    <label for="Add Goal ">Add Goal</label>

                    <?php
                    echo $this->Form->select('client_id', ['' => $clientsOfClinician]);
                    echo $this->Form->control('goals_set');
                    echo $this->Form->control('completion_date');
                    ?>


                </fieldset>
                <a style="float: right;">
                    <?= $this->Form->button(__('Submit')) ?>
                </a>
                <?= $this->Form->end() ?>
                <br><br>
            </div>
        </div>

        <?php
    } else {
        ?>
        <h1>Clinician has not finished registration.</h1>
        <?php
    }
    ?>


<?php } ?>
</div>


}

<br><br><br>
