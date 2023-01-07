<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinician[]|\Cake\Collection\CollectionInterface $clinicians
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
if ($this->Identity->get('role') === '1') {
    ?>

    <!--    Table for clinicians already registered in the system-->

    <div class="clinicians index content">
        <h3><strong><?= __('Registered Clinicians') ?></strong></h3>
        <p class="subtext">All clinicians who have completed registration and are equipped to work in the system.</p>

        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>User Id</th>
                    <th><?= $this->Paginator->sort('user') ?></th>
                    <th><?= $this->Paginator->sort('medical_specialty') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clinicians as $clinician):

                    $qualificationsQuery = TableRegistry::getTableLocator()->get('ClinicianQualifications');
                    $qualifications = $qualificationsQuery->find()->select([])->where(['clinician_id' => $clinician->id])->all();


                    $clinicianQualifications = [];
                    $closestExpiryDate = null;
                    if ($qualifications != null) {
                        foreach ($qualifications as $qualification):
                            array_push($clinicianQualifications, $qualification->date_expire);
                        endforeach;
                        if ($clinicianQualifications != []) {
                            $closestExpiryDate = min($clinicianQualifications);
                        }
                    }

                    if ($closestExpiryDate != null) {
                        $currentDate = new DateTime("now");
                        $interval = date_diff($closestExpiryDate, $currentDate);

                        // checks to see if certificate is expired
                        $isBeforeCurrent = false;
                        if ($interval->format('%R') == "+") {
                            $isBeforeCurrent = true;
                        }
                        // calculates the days of difference
                        $daysDifference = $interval->format('%a');

                        if ($isBeforeCurrent) {
                            ?>
                            <tr style="background-color: lightpink" title="<?= ($clinician->user->first_name) . ' ' . ($clinician->user->surname) . ' has qualifications that need to be renewed.' ?>">
                            <?php
                        } else { ?>
                            <tr>
                            <?php
                        }
                    }
                    ?>
                    <td><?= $this->Number->format($clinician->user_id) ?></td>
                    <td><?= $clinician->has('user') ? $this->Html->link(($clinician->user->first_name) . ' ' . ($clinician->user->surname), ['action' => 'view', $clinician->id]) : '' ?></td>
                    <td><?= h($clinician->medical_specialty) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clinician->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clinician->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clinician->id)]) ?>
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
            <h3>Qualification Expiry:</h3>
            <p>The table rows are calculated based off whether the referred clininician has <b>any expired qualifications</b>.</p>

            <div style="padding-top: 2%; text-align: center">
                <table style="width: fit-content; display: inline-block; ">
                    <tr>
                        <th colspan="3">
                            <center>Legend</center>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="1" style="background-color: lightpink; color: lightpink">text</th>
                        <td colspan="2">Has at least one expired qualification <p style="color: white; display: inline">......</p></td>
                    </tr>
                    <tr>
                        <th colspan="1" style="background-color: white; color: white">text</th>
                        <td colspan="2">No expired qualifications <p style="color: white; display: inline">......</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <br>
    <br>
    <br>
    <br>

    <!--    Table for clinicians who don't have their profile information filled out yet.-->
    <div class="users index content">
        <?= $this->Html->link(__('Register Clinician'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <div id="headingDiv">
            <h3><strong><?= __('Pending Clinicians') ?></strong></h3>
            <p class="subtext">Clinicians who have yet to complete registration of their accounts.</p>
        </div>
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
                <?php

                // Get users who are of clinician role AND do not have an existing client profile.
                $usersQuery = TableRegistry::getTableLocator()->get('Users');
                $cliniciansQuery = TableRegistry::getTableLocator()->get('Clinicians');

                $users = $usersQuery->find()->select([])->all();

                $unregisteredClinicians = [];
                foreach ($users as $user) {
                    // If user was assigned a role of '1' or '2' aka managerial clinician or clinician on creation.
                    if ($user->role == '1' || $user->role == '2' ) {
                        // If user does not have an existing profile.
                        $clientRoleUser = $cliniciansQuery->find()->select([])->where(['user_id' => $user->id])->first();
                        if ($clientRoleUser == null) {
                            array_push($unregisteredClinicians, $user);
                        }
                    }
                }



                foreach ($unregisteredClinicians as $user) {
                        ?>
                        <tr>
                            <td><?=h($user->id)?></td>
                            <td><?= h($user->first_name) . ' ' . h($user->surname) ?></td>
                            <td><?= h($user->created_date) ?></td>
                            <td><?= h($user->modified_date) ?></td>
                            <td><?= h($user->last_login) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $user->id]) ?>
                            </td>
                        </tr>
                        <?php
                    } ?>
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
}
?>


<!-- No access for clinicians or clients if they manually try to visit this page-->
<?php
if ($this->Identity->get('role') === '3' || $this->Identity->get('role') === '3') {
    ?>

    <?php
}
?>



