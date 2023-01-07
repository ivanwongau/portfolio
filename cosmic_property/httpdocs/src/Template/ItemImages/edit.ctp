<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemImage $itemImage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemImage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemImage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Item Image'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item'), ['controller' => 'Item', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Item', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemImage form large-9 medium-8 columns content">
    <?= $this->Form->create($itemImage) ?>
    <fieldset>
        <legend><?= __('Edit Item Image') ?></legend>
        <?php
            echo $this->Form->control('image_name');
            echo $this->Form->control('image_path');
            echo $this->Form->control('item_id', ['options' => $item]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
