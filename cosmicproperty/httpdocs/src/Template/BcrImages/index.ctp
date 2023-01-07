<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BcrImage[]|\Cake\Collection\CollectionInterface $bcrImage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bcr Image'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Maintenance'), ['controller' => 'ItemMaintenance', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Maintenance'), ['controller' => 'ItemMaintenance', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bcrImage index large-9 medium-8 columns content">
    <h3><?= __('Bcr Image') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image_path') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bcrImage as $bcrImage): ?>
            <tr>
                <td><?= $this->Number->format($bcrImage->id) ?></td>
                <td><?= h($bcrImage->image_path) ?></td>
                <td><?= h($bcrImage->image_name) ?></td>
                <td><?= $bcrImage->has('item_maintenance') ? $this->Html->link($bcrImage->item_maintenance->item_maintenance_id, ['controller' => 'ItemMaintenance', 'action' => 'view', $bcrImage->item_maintenance->item_maintenance_id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bcrImage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bcrImage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bcrImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bcrImage->id)]) ?>
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
