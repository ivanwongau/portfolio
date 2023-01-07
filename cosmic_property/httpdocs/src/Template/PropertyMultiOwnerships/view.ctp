<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyMultiOwnership $propertyMultiOwnership
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Property Multi Ownership'), ['action' => 'edit', $propertyMultiOwnership->property_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Property Multi Ownership'), ['action' => 'delete', $propertyMultiOwnership->property_id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyMultiOwnership->property_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Property Multi Ownership'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property Multi Ownership'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="propertyMultiOwnership view large-9 medium-8 columns content">
    <h3><?= h($propertyMultiOwnership->property_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ownership Id') ?></th>
            <td><?= $this->Number->format($propertyMultiOwnership->ownership_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Owner Corp Num') ?></th>
            <td><?= $this->Number->format($propertyMultiOwnership->owner_corp_num) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Of Lot') ?></th>
            <td><?= $this->Number->format($propertyMultiOwnership->Num_of_lot) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Of Lot Liabilities') ?></th>
            <td><?= $this->Number->format($propertyMultiOwnership->Num_of_lot_liabilities) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Property Id') ?></th>
            <td><?= $this->Number->format($propertyMultiOwnership->property_id) ?></td>
        </tr>
    </table>
</div>
