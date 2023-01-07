<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemMaintenance $itemMaintenance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Item Maintenances'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Properties'), ['controller' => 'Properties', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Property'), ['controller' => 'Properties', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemMaintenances form large-9 medium-8 columns content">
    <?= $this->Form->create($itemMaintenance) ?>
    <fieldset>
        <legend><?= __('Add Item Maintenance') ?></legend>
        <?php
            echo $this->Form->control('item_name');
            echo $this->Form->control('property_id', ['options' => $properties]);
            echo $this->Form->control('item_status');
            echo $this->Form->control('item_location');
            echo $this->Form->control('item_finding');
            echo $this->Form->control('item_recommendation');
            echo $this->Form->control('cost_estimate');
            echo $this->Form->control('potential_hazard');
            echo $this->Form->control('item_priority');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
