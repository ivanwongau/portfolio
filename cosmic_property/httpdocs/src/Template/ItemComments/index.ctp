<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemComment[]|\Cake\Collection\CollectionInterface $itemComments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Maintenances'), ['controller' => 'ItemMaintenances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Maintenance'), ['controller' => 'ItemMaintenances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemComments index large-9 medium-8 columns content">
    <h3><?= __('Item Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Create_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('content') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_maintenance_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemComments as $itemComment): ?>
            <tr>
                <td><?= $this->Number->format($itemComment->id) ?></td>
                <td><?= h($itemComment->Create_date) ?></td>
                <td><?= h($itemComment->content) ?></td>
                <td><?= $itemComment->has('item_maintenance') ? $this->Html->link($itemComment->item_maintenance->id, ['controller' => 'ItemMaintenances', 'action' => 'view', $itemComment->item_maintenance->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemComment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemComment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemComment->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
