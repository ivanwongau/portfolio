<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientCondition[]|\Cake\Collection\CollectionInterface $clientConditions
 */

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

?>

<?php
if($this->Identity->get('role') === '1') {
    ?>
<div class="clients index content">
    <h3><?= __('All Client Conditions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('client') ?></th>
                <th><?= $this->Paginator->sort('insulin_level') ?></th>
                <th><?= $this->Paginator->sort('weight') ?></th>
                <th><?= $this->Paginator->sort('BMI') ?></th>
                <th><?= $this->Paginator->sort('logged_time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clientConditions as $clientCondition): ?>

                <?php
                $itemQuery = TableRegistry::getTableLocator()->get('ClientConditions');
                $clientId = $itemQuery->find()->select(['client_id'])->where(['id' => $clientCondition->id])->firstOrFail()->client_id;

                $clientQuery = TableRegistry::getTableLocator()->get('Clients');
                $userId = $clientQuery->find()->select(['user_id'])->where(['id' => $clientId])->firstOrFail()->user_id;

                $userQuery = TableRegistry::getTableLocator()->get('Users');
                $userFirstName = $userQuery->find()->select(['first_name'])->where(['id' => $userId])->firstOrFail()->first_name;
                $userSurname = $userQuery->find()->select(['surname'])->where(['id' => $userId])->firstOrFail()->surname;
                ?>

                <tr>
                    <td><?= $clientCondition->has('client') ? $this->Html->link((
                            $userFirstName.' '.$userSurname),
                            ['controller' => 'Clients', 'action' => 'view', $clientCondition->client->id]) : '' ?></td>
                    <td><?= h($clientCondition->insulin_level) ?></td>
                    <td><?= $this->Number->format($clientCondition->weight) ?></td>
                    <td><?= $this->Number->format($clientCondition->BMI) ?></td>
                    <td><?= h($clientCondition->logged_time) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $clientCondition->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clientCondition->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientCondition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientCondition->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
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
</div>


<?php } ?>
