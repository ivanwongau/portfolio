<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FoodIntake[]|\Cake\Collection\CollectionInterface $foodIntakes
 */

use Cake\ORM\TableRegistry;
echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');

?>

<?php if ($this->Identity->get('role') === '3') {
    ?>
    <div class="foodIntakes index content">

        <?php
            $clientQuery = TableRegistry::getTableLocator()->get('Clients');
            $clientExists = $clientQuery->find()->select([])->where(['user_id' => $this->Identity->get('id')])->first();

            if($clientExists != null){
            ?>

           <?= $this->Html->link(__('Log Food Intake'), ['action' => 'add'], ['class' => 'button float-right']) ?>

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

        <h3><?= __('Food Intakes') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('food_eaten') ?></th>
                    <th><?= $this->Paginator->sort('logged_time') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($foodIntakes as $foodIntake): ?>
                    <?php
                    $itemQuery = TableRegistry::getTableLocator()->get('FoodIntakes');
                    $clientId = $itemQuery->find()->select(['client_id'])->where(['id' => $foodIntake->id])->firstOrFail()->client_id;

                    $clientQuery = TableRegistry::getTableLocator()->get('Clients');
                    $userId = $clientQuery->find()->select(['user_id'])->where(['id' => $clientId])->firstOrFail()->user_id;

                    $userQuery = TableRegistry::getTableLocator()->get('Users');
                    $userFirstName = $userQuery->find()->select(['first_name'])->where(['id' => $userId])->firstOrFail()->first_name;
                    $userSurname = $userQuery->find()->select(['surname'])->where(['id' => $userId])->firstOrFail()->surname;

                    if ($this->Identity->get('id') === $userId) {
                        ?>
                        <tr>
                            <td><?= h($foodIntake->food_eaten) ?></td>
                            <td><?= h($foodIntake->logged_time) ?></td>
                            <td class="actions">
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $foodIntake->id], ['confirm' => __('Are you sure you want to delete # {0}?', $foodIntake->id)]) ?>
                            </td>
                        </tr>
                    <?php } ?>
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
<?php } ?>



<?php if ($this->Identity->get('role') === '2' || $this->Identity->get('role') === '1') {
    ?>
    <div class="foodIntakes index content">
    <h3><?= __("My Clients' Food Intakes") ?></h3>
    <div class="table-responsive">
    <table>
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('client_id') ?></th>
        <th><?= $this->Paginator->sort('food_eaten') ?></th>
        <th><?= $this->Paginator->sort('logged_time') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($foodIntakes as $foodIntake): ?>

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
        if (in_array($foodIntake->client_id, $clinicianClientIds, false)) {
            $clientQuery = TableRegistry::getTableLocator()->get('Clients');
            $userId = $clientQuery->find()->select([])->where(['id' => $foodIntake->client_id])->firstOrFail()->user_id;

            $userQuery = TableRegistry::getTableLocator()->get('Users');
            $userFirstName = $userQuery->find()->select(['first_name'])->where(['id' => $userId])->firstOrFail()->first_name;
            $userSurname = $userQuery->find()->select(['surname'])->where(['id' => $userId])->firstOrFail()->surname;

            ?>

            <tr>
                <td><?= $foodIntake->has('client') ? $this->Html->link(
                        ($userFirstName) . ' ' . ($userSurname)
                        , ['controller' => 'Clients', 'action' => 'view', $foodIntake->client->id]) : '' ?></td>
                <td><?= h($foodIntake->food_eaten) ?></td>
                <td><?= h($foodIntake->logged_time) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $foodIntake->id], ['confirm' => __('Are you sure you want to delete # {0}?', $foodIntake->id)]) ?>
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

<?php } ?>

