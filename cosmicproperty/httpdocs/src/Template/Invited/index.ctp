<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invited[]|\Cake\Collection\CollectionInterface $invited
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Invited'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Properties'), ['controller' => 'Properties', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Property'), ['controller' => 'Properties', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invited index large-9 medium-8 columns content">
    <h3><?= __('Invited') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('property_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('access_level') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invited as $invited): ?>
            <tr>
                <td><?= $this->Number->format($invited->id) ?></td>
                <td><?= h($invited->email) ?></td>
                <td><?= $invited->has('property') ? $this->Html->link($invited->property->id, ['controller' => 'Properties', 'action' => 'view', $invited->property->id]) : '' ?></td>
                <td><?= $this->Number->format($invited->access_level) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invited->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invited->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invited->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invited->id)]) ?>
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
