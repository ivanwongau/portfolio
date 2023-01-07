<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BcrImage $bcrImage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bcrImage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bcrImage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bcr Image'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item Maintenance'), ['controller' => 'ItemMaintenance', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Maintenance'), ['controller' => 'ItemMaintenance', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bcrImage form large-9 medium-8 columns content">
    <?= $this->Form->create($bcrImage) ?>
    <fieldset>
        <legend><?= __('Edit Bcr Image') ?></legend>
        <?php
            echo $this->Form->control('image_path');
            echo $this->Form->control('image_name');
            echo $this->Form->control('item_id', ['options' => $itemMaintenance]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
