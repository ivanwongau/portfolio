<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LotOwner $lotOwner
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lot Owner'), ['action' => 'edit', $lotOwner->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lot Owner'), ['action' => 'delete', $lotOwner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lotOwner->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lot Owners'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lot Owner'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Property Multi Ownerships'), ['controller' => 'PropertyMultiOwnerships', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property Multi Ownership'), ['controller' => 'PropertyMultiOwnerships', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lotOwners view large-9 medium-8 columns content">
    <h3><?= h($lotOwner->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Lots No') ?></th>
            <td><?= h($lotOwner->lots_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('No Liabilities') ?></th>
            <td><?= h($lotOwner->no_liabilities) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Property Multi Ownership') ?></th>
            <td><?= $lotOwner->has('property_multi_ownership') ? $this->Html->link($lotOwner->property_multi_ownership->id, ['controller' => 'PropertyMultiOwnerships', 'action' => 'view', $lotOwner->property_multi_ownership->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lotOwner->id) ?></td>
        </tr>
    </table>
</div>
