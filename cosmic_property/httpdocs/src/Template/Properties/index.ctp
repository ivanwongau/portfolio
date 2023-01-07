<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building[]|\Cake\Collection\CollectionInterface $buildings
 */
?>

<div class="wrapper">
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Building'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Multi Ownerships'), ['controller' => 'MultiOwnerships', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Multi Ownership'), ['controller' => 'MultiOwnerships', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="buildings index large-9 medium-8 columns content">
    <h3><?= __('Buildings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('street') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('states') ?></th>
                <th scope="col"><?= $this->Paginator->sort('post_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ownership_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('age') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plan_subdivision_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sinking_fund_balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assumed_interest_rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assumed_inflation_rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gst_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gst_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contingency_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($buildings as $building): ?>
            <tr>
                <td><?= $this->Number->format($building->id) ?></td>
                <td><?= h($building->name) ?></td>
                <td><?= h($building->street) ?></td>
                <td><?= h($building->city) ?></td>
                <td><?= h($building->states) ?></td>
                <td><?= $this->Number->format($building->post_code) ?></td>
                <td><?= h($building->country) ?></td>
                <td><?= h($building->type) ?></td>
                <td><?= h($building->ownership_type) ?></td>
                <td><?= h($building->status) ?></td>
                <td><?= $this->Number->format($building->age) ?></td>
                <td><?= h($building->plan_subdivision_number) ?></td>
                <td><?= $this->Number->format($building->sinking_fund_balance) ?></td>
                <td><?= $this->Number->format($building->assumed_interest_rate) ?></td>
                <td><?= $this->Number->format($building->assumed_inflation_rate) ?></td>
                <td><?= h($building->gst_status) ?></td>
                <td><?= $this->Number->format($building->gst_percentage) ?></td>
                <td><?= $this->Number->format($building->contingency_percentage) ?></td>
                <td><?= $building->has('user') ? $this->Html->link($building->user->id, ['controller' => 'Users', 'action' => 'view', $building->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $building->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $building->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $building->id], ['confirm' => __('Are you sure you want to delete # {0}?', $building->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <button class="pagebutton">   <?= $this->Paginator->prev('< ' . __('previous')) ?> </button>
            <?= $this->Paginator->numbers() ?>
            <button class="pagebutton">  <?= $this->Paginator->next(__('next') . ' >') ?></button>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
</div>
