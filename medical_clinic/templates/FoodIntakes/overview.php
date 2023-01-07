<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FoodIntake[]|\Cake\Collection\CollectionInterface $foodIntakes
 */

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

?>

<?php if ($this->Identity->get('role') === '1') {
    ?>
    <div class="foodIntakes index content">
        <h3><?= __('All Client Food Intakes') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
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
                    ?>

                    <tr>
                        <td><?= $this->Number->format($foodIntake->id) ?></td>
                        <td><?= $foodIntake->has('client') ? $this->Html->link(
                                ($userFirstName) . ' ' . ($userSurname)
                                , ['controller' => 'Clients', 'action' => 'view', $foodIntake->client->id]) : '' ?></td>
                        <td><?= h($foodIntake->food_eaten) ?></td>
                        <td><?= h($foodIntake->logged_time) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $foodIntake->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $foodIntake->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $foodIntake->id], ['confirm' => __('Are you sure you want to delete # {0}?', $foodIntake->id)]) ?>
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
} else {
    ?>

    <div style="padding-top: 10%;">
        <center>
            <h1>403</h1>
            <h2>Unauthorized Access</h2>
        </center>
    </div>


<?php } ?>
