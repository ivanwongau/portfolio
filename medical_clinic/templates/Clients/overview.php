<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client[]|\Cake\Collection\CollectionInterface $clients
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

use Cake\ORM\TableRegistry;
echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');

?>

<head>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<?php
if ($this->Identity->get('role') === '1') {
    ?>
    <div class="clients index content">
        <h3><strong><?= __('Registered Clients') ?></strong></h3>
        <p class="subtext">All clients who have completed registration and are equipped to work in the system.</p>
        <div class="table-responsive">
            <table>
                <tr>
                    <th>User Id</th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('diabetes_type') ?></th>
                    <th><?= $this->Paginator->sort('past_births') ?></th>
                    <th><?= $this->Paginator->sort('medicare_no') ?></th>
                    <th><?= $this->Paginator->sort('medicare_ref') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <tbody>
                <?php foreach ($clients as $client):

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

                        $userInactive = ($isBeforeCurrent && ($daysDifference > 0));

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
                    <td><?= $this->Number->format($client->id) ?></td>
                    <td><?= $client->has('user') ? $this->Html->link(($client->user->first_name) . ' ' . ($client->user->surname), ['action' => 'view', $client->id]) : '' ?></td>
                    <td><?= h($client->diabetes_type) ?></td>
                    <td><?= $this->Number->format($client->past_births) ?></td>
                    <td><?= h($client->medicare_no) ?></td>
                    <td><?= $this->Number->format($client->medicare_ref) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $client->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id)]) ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
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


    <br><br><br><br>

    <div class="users index content">
        <?= $this->Html->link(__('Register Client'), ['action' => 'add'], ['class' => 'button float-right']) ?>

        <h3><strong><?= __('Pending Clients') ?></strong></h3>
        <p class="subtext">Clients who have yet to complete registration of their accounts.</p>

        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>User Id</th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th><?= $this->Paginator->sort('last_login') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user):

                    // if user id is not part of the clinician ids
                    $clientQuery = TableRegistry::getTableLocator()->get('Clients');
                    // gets the user id of each loop
                    $currentUserId = $clientQuery->find()->select(['user_id'])->where(['user_id' => $user->id])->first();

                    if ($currentUserId === null) {
                        ?>
                        <tr>
                            <td><?= h($user->id) ?></td>
                            <td><?= h($user->first_name) . ' ' . h($user->surname) ?></td>
                            <td><?= h($user->created_date) ?></td>
                            <td><?= h($user->modified_date) ?></td>
                            <td><?= h($user->last_login) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $user->id]) ?>
                            </td>
                        </tr>
                    <?php } endforeach; ?>
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


    <?php
} else {
    ?>

    <div style="padding-top: 10%;">
        <center>
            <h1>403</h1>
            <h2>Unauthorized Access</h2>
        </center>
    </div>


<?php } ?>
