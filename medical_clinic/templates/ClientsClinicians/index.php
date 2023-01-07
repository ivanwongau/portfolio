<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsClinician[]|\Cake\Collection\CollectionInterface $clientsClinicians
 */

use Cake\ORM\TableRegistry;
echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');
?>

<?php
if($this->Identity->get('role') === '1') {
?>
<div class="clientsClinicians index content">
    <?= $this->Html->link(__('Add New Pairing'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><strong>Client and Clinician Pairings</strong></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th><?= $this->Paginator->sort('clinician_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientsClinicians as $clientsClinician):
                    $userQuery = TableRegistry::getTableLocator()->get('Users');

                    $clientQuery = TableRegistry::getTableLocator()->get('Clients');
                    // gets the user information of each loop for clients
                    $clientUserId = $clientQuery->find()->select([])->where(['id' => $clientsClinician->client_id])->first()->user_id;
                    $clientUserDetails = $userQuery->find()->select([])->where(['id' => $clientUserId])->first();

                    $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
                    // gets the user id of each loop
                    $clinicianUserId = $clinicianQuery->find()->select([])->where(['id' => $clientsClinician->clinician_id])->first()->user_id;
                    $clinicianUserDetails = $userQuery->find()->select([])->where(['id' => $clinicianUserId])->first();
                    ?>
                <tr>
                    <td><?= $clientsClinician->has('client') ? $this->Html->link($clientUserDetails->first_name.' '.$clientUserDetails->surname, ['controller' => 'Clients', 'action' => 'view', $clientsClinician->client->id]) : '' ?></td>
                    <td><?= $clientsClinician->has('clinician') ? $this->Html->link($clinicianUserDetails->first_name.' '.$clinicianUserDetails->surname, ['controller' => 'Clinicians', 'action' => 'view', $clientsClinician->clinician->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientsClinician->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsClinician->id)]) ?>
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

<?php
}
?>

