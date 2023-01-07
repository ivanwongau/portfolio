<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client[]|\Cake\Collection\CollectionInterface $clients
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

use Cake\ORM\TableRegistry;

echo $this->Html->css('primaryTable.css');

?>

<head>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<?php
if ($this->Identity->get('role') === '2' || $this->Identity->get('role') === '1') {

    $clinQuery = TableRegistry::getTableLocator()->get('Clinicians');
    $userClinician = $clinQuery->find()->select([])
        ->where(['user_id' => $this->Identity->get('id')])
        ->first();

    if ($userClinician != null) {

        ?>

        <div class="clients index content">
            <h3><?= __('My Clients') ?></h3>
            <p class="subtext">These are the clients under your care.</p>
            <div class="table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th><?= $this->Paginator->sort('user') ?></th>
                        <th><?= $this->Paginator->sort('diabetes_type') ?></th>
                        <th><?= $this->Paginator->sort('past_births') ?></th>
                        <th><?= $this->Paginator->sort('medicare_no') ?></th>
                        <th><?= $this->Paginator->sort('medicare_ref') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($clients as $client):
                        // Searches for the clients under the clinician's care
                        // Finds the identity of the logged in clinician
                        $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
                        $userClinician = $clinicianQuery->find()->select([])
                            ->where(['user_id' => $this->Identity->get('id')])
                            ->first();
                        // Find the clinician in the client clinicians pairing list
                        $clientsCliniciansQuery = TableRegistry::getTableLocator()->get('ClientsClinicians');
                        // Finds all of the clients assigned under them
                        $allClinicianClients = $clientsCliniciansQuery->find()->select([])->where(['clinician_id' => $userClinician->id])->all();
                        // Builds an array and only takes in the ids of the clients assigned under the logged in clinician
                        $clinicianClientIds = [];
                        foreach ($allClinicianClients as $clinicianClient):
                            array_push($clinicianClientIds, $clinicianClient->client_id);
                        endforeach;

                        // Checks if the sorted client from the parent loop is one of the clinician's
                        if (in_array($client->id, $clinicianClientIds, false)) {
                            // Find whether the client has logged anything, sorts by the last record
                            $conditionsQuery = TableRegistry::getTableLocator()->get('ClientConditions');
                            $clientConditions = $conditionsQuery->find()->select([])
                                ->where(['client_id' => $client->id])
                                ->last();

                            $foodIntakesQuery = TableRegistry::getTableLocator()->get('FoodIntakes');
                            $clientFood = $foodIntakesQuery->find()->select([])
                                ->where(['client_id' => $client->id])
                                ->last();


                            // Defaults to user not having logged anything
                            $userHasLoggedAnything = false;

                            // If either of the fetched results is not null, starts check process for the last time
                            // a user has logged any of their records
                            if ($clientFood != null || $clientConditions != null) {
                                $userHasLoggedAnything = true;

                                // checks to see the last logged time
                                if ($clientConditions != null) {
                                    $clientConditionLastLogged = $clientConditions->logged_time;
                                }
                                if ($clientFood != null) {
                                    $clientFoodLastLogged = $clientFood->logged_time;
                                }

                                // checks to see which date is the latest
                                $dateClientLastLoggedAnything = null;
                                if ($clientConditions == null) {
                                    $dateClientLastLoggedAnything = $clientFoodLastLogged;
                                } else if ($clientFood == null) {
                                    $dateClientLastLoggedAnything = $clientConditionLastLogged;
                                } else {
                                    if ($clientConditionLastLogged < $clientFoodLastLogged) {
                                        $dateClientLastLoggedAnything = $clientFoodLastLogged;
                                    } else {
                                        $dateClientLastLoggedAnything = $clientConditionLastLogged;
                                    }
                                }

                                // sets the current date and gets the difference between the last time clients have logged
                                // anything and the current date
                                $currentDate = new DateTime("now");
                                $interval = date_diff($dateClientLastLoggedAnything, $currentDate);

                                // validates on whether the client's last activity is before the current time
                                $isBeforeCurrent = false;
                                if ($interval->format('%R') == "+") {
                                    $isBeforeCurrent = true;
                                }
                                // calculates the days of difference
                                $daysDifference = $interval->format('%a');

                                // if the date is before the current time and if there's more than zero days of difference
                                if ($userHasLoggedAnything == true) {
                                    // Checks if the last logged date has been more than a day.
                                    if ($isBeforeCurrent && ($daysDifference > 0)) {
                                        ?>
                                        <tr style="background-color: lightpink" title="<?= ($client->user->first_name) . ' ' . ($client->user->surname) ?> has not logged any activity in <?= $daysDifference ?> days.">
                                    <?php } else { ?>
                                        <tr title="<?= ($client->user->first_name) . ' ' . ($client->user->surname) ?> has been logging their activities recently.">
                                        <?php
                                    }
                                }
                            }
                            // Checks whether the user has not logged anything into the system at all.
                            if ($userHasLoggedAnything == false) {
                                ?>
                                <tr style="background-color: lightgray" title="<?= ($client->user->first_name) . ' ' . ($client->user->surname) ?> has not logged any activity.">
                                <?php
                            } ?>
                            <td><?= $this->Number->format($client->user_id) ?></td>
                            <td><?= $client->has('user') ? $this->Html->link(($client->user->first_name) . ' ' . ($client->user->surname), ['action' => 'view', $client->id]) : '' ?></td>
                            <td><?= h($client->diabetes_type) ?></td>
                            <td><?= $this->Number->format($client->past_births) ?></td>
                            <td><?= h($client->medicare_no) ?></td>
                            <td><?= $this->Number->format($client->medicare_ref) ?></td>
                            </tr>
                            <?php
                        }
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
            </div>
        </div>

        <button data-toggle="collapse" data-target="#collapseSection" style="float: right">Show Colour Legend</button>
        <div class="border" style="padding: 2%">

            <div id="collapseSection" class="collapse">
                <h3>Last time a client has logged any activity:</h3>
                <p>The table rows are calculated based off the last time a client has logged <b>any</b> activity (condition or food) onto the system.</p>

                <div style="padding-top: 2%; text-align: center">
                    <table style="width: fit-content; display: inline-block; ">
                        <tr>
                            <th colspan="3">
                                <center>Legend</center>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="1" style="background-color: lightpink; color: lightpink">text</th>
                            <td colspan="2">Over a day ago <p style="color: white; display: inline">......</p></td>
                        </tr>
                        <tr>
                            <th colspan="1" style="background-color: lightgrey; color: lightgray">text</th>
                            <td colspan="2" style="padding: 10px">Never <p style="color: white;  display: inline">......</p>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="1" style="background-color: white; color: white">text</th>
                            <td colspan="2">Recently <p style="color: white; display: inline">......</p></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <br><br><br>
        <?php
    } else {
        ?>

        <div style="padding-top: 10%;">
            <center>
                <h1>Unable to Access</h1>
                <h2>Your clinician account has not fully completed registration.</h2>
                <h2>To complete registration, please update
                    your clinician details in your profile or request a managerial clinicial to fill them out on your
                    behalf.</h2>
            </center>
        </div>
        </div>

        <?php
    }
} else { ?>

    <div style="padding-top: 10%;">
        <center>
            <h1>403</h1>
            <h2>Unauthorized Access</h2>
        </center>
    </div>
    </div>


    <?php
}
?>
