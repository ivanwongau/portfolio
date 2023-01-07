<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Goal[]|\Cake\Collection\CollectionInterface $goals
 */

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

echo $this->Html->css('primaryTable.css');

?>

<?php if ($this->Identity->get('role') === '3') {
    ?>

    <div class="goals index content">

        <?php
        $clientQuery = TableRegistry::getTableLocator()->get('Clients');
        $clientExists = $clientQuery->find()->select([])->where(['user_id' => $this->Identity->get('id')])->first();

        if($clientExists != null){
            ?>

            <?= $this->Html->link(__('New Goal'), ['action' => 'add'], ['class' => 'button float-right']) ?>

            <?php
        } else {
            ?>
            <div style="background-color: red; color: white">
                <big>
                    <center>
                        <b>
                            You cannot access this feature yet as your profile has not been completed yet.
                            To complete your profile, please go to 'My Profile' and add your client information.
                        </b>
                    </center>
                </big>
            </div>
            <br>
            <?php
        }
        ?>


        <h3><?= __('Goals') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>

                    <th><?= $this->Paginator->sort('goal_set') ?></th>
                    <th><?= $this->Paginator->sort('completion_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($goals as $goal): ?>
                    <?php
                    $itemQuery = TableRegistry::getTableLocator()->get('Goals');
                    $clientId = $itemQuery->find()->select(['client_id'])->where(['id' => $goal->id])->firstOrFail()->client_id;

                    $clientQuery = TableRegistry::getTableLocator()->get('Clients');
                    $userId = $clientQuery->find()->select(['user_id'])->where(['id' => $clientId])->firstOrFail()->user_id;

                    $userQuery = TableRegistry::getTableLocator()->get('Users');
                    $userFirstName = $userQuery->find()->select(['first_name'])->where(['id' => $userId])->firstOrFail()->first_name;
                    $userSurname = $userQuery->find()->select(['surname'])->where(['id' => $userId])->firstOrFail()->surname;

                    if ($this->Identity->get('id') === $userId) {
                        ?>
                        <tr>

                            <td><?= h($goal->goals_set) ?></td>
                            <td><?= h($goal->completion_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $goal->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $goal->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $goal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goal->id)]) ?>
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
<?php } ?>


<?php if ($this->Identity->get('role') === '2' || $this->Identity->get('role') === '1') {

    $clinQuery = TableRegistry::getTableLocator()->get('Clinicians');
    $userClinician = $clinQuery->find()->select([])
        ->where(['user_id' => $this->Identity->get('id')])
        ->first();

    if ($userClinician != null) {
        ?>

        <div class="goals index content">
            <?= $this->Html->link(__('New Goal'), ['action' => 'add'], ['class' => 'button float-right']) ?>

            <h3><?= __("My Clients' Goals") ?></h3>
            <div class="table-responsive">
                <table>
                    <thead>

                    <tr>

                        <th><?= $this->Paginator->sort('client_id') ?></th>
                        <th><?= $this->Paginator->sort('goal_set') ?></th>
                        <th><?= $this->Paginator->sort('completion_date') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($goals as $goal): ?>

                        <?php
                        $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
                        $userClinician = $clinicianQuery->find()->select([])
                            ->where(['user_id' => $this->Identity->get('id')])
                            ->first();

                        // Find the clinician in the client clinicians pairing list
                        $clientsCliniciansQuery = TableRegistry::getTableLocator()->get('ClientsClinicians');
                        $clientsClinicians = $clientsCliniciansQuery->find()->select([])->where(['clinician_id' => $userClinician->id])->first();

                        // Finds all of the clients assigned under them
                        $allClinicianClients = $clientsCliniciansQuery->find()->select([])->where(['clinician_id' => $clientsClinicians->clinician_id])->all();

                        // Builds an array and only takes in the ids of the clients assigned under the logged in clinician
                        $clinicianClientIds = [];
                        foreach ($allClinicianClients as $clinicianClient):
                            array_push($clinicianClientIds, $clinicianClient->client_id);
                        endforeach;


                        // Checks if the sorted client from the parent loop is one of the clinician's
                        if (in_array($goal->client_id, $clinicianClientIds, false)) {
                            $clientQuery = TableRegistry::getTableLocator()->get('Clients');
                            $userId = $clientQuery->find()->select([])->where(['id' => $goal->client_id])->firstOrFail()->user_id;

                            $userQuery = TableRegistry::getTableLocator()->get('Users');
                            $userFirstName = $userQuery->find()->select(['first_name'])->where(['id' => $userId])->firstOrFail()->first_name;
                            $userSurname = $userQuery->find()->select(['surname'])->where(['id' => $userId])->firstOrFail()->surname;

                            ?>


                            <tr>
                                <td><?= $goal->has('client') ? $this->Html->link(
                                        ($userFirstName) . ' ' . ($userSurname)
                                        , ['controller' => 'Clients', 'action' => 'view', $goal->client->id]) : '' ?></td>
                                <td><?= h($goal->goals_set) ?></td>
                                <td><?= h($goal->completion_date) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $goal->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $goal->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $goal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goal->id)]) ?>
                                </td>
                            </tr>
                        <?php }
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

    <?php } else { ?>

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
} ?>


