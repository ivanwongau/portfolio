<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyMultiOwnership[]|\Cake\Collection\CollectionInterface $propertyMultiOwnership
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Property Multi Ownership'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="propertyMultiOwnership index large-9 medium-8 columns content">
    <h3><?= __('Property Multi Ownership') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ownership_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('owner_corp_num') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Num_of_lot') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Num_of_lot_liabilities') ?></th>
                <th scope="col"><?= $this->Paginator->sort('property_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propertyMultiOwnership as $propertyMultiOwnership): ?>
            <tr>
                <td><?= $this->Number->format($propertyMultiOwnership->ownership_id) ?></td>
                <td><?= $this->Number->format($propertyMultiOwnership->owner_corp_num) ?></td>
                <td><?= $this->Number->format($propertyMultiOwnership->Num_of_lot) ?></td>
                <td><?= $this->Number->format($propertyMultiOwnership->Num_of_lot_liabilities) ?></td>
                <td><?= $this->Number->format($propertyMultiOwnership->property_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $propertyMultiOwnership->property_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $propertyMultiOwnership->property_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $propertyMultiOwnership->property_id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyMultiOwnership->property_id)]) ?>
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
