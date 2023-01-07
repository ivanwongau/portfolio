<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invited $invited
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invited'), ['action' => 'edit', $invited->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invited'), ['action' => 'delete', $invited->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invited->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invited'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invited'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Properties'), ['controller' => 'Properties', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property'), ['controller' => 'Properties', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invited view large-9 medium-8 columns content">
    <h3><?= h($invited->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($invited->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Property') ?></th>
            <td><?= $invited->has('property') ? $this->Html->link($invited->property->id, ['controller' => 'Properties', 'action' => 'view', $invited->property->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invited->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Access Level') ?></th>
            <td><?= $this->Number->format($invited->access_level) ?></td>
        </tr>
    </table>
</div>
