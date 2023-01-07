<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LotOwner[]|\Cake\Collection\CollectionInterface $lotOwners
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Lot Owner'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Property Multi Ownerships'), ['controller' => 'PropertyMultiOwnerships', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Property Multi Ownership'), ['controller' => 'PropertyMultiOwnerships', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lotOwners index large-9 medium-8 columns content">
    <h3><?= __('Lot Owners') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lots_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('no_liabilities') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ownership_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lotOwners as $lotOwner): ?>
            <tr>
                <td><?= $this->Number->format($lotOwner->id) ?></td>
                <td><?= h($lotOwner->lots_no) ?></td>
                <td><?= h($lotOwner->no_liabilities) ?></td>
                <td><?= $lotOwner->has('property_multi_ownership') ? $this->Html->link($lotOwner->property_multi_ownership->id, ['controller' => 'PropertyMultiOwnerships', 'action' => 'view', $lotOwner->property_multi_ownership->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $lotOwner->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lotOwner->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lotOwner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lotOwner->id)]) ?>
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
