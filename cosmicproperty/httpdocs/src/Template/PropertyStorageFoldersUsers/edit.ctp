<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFoldersUser $propertyStorageFoldersUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $propertyStorageFoldersUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $propertyStorageFoldersUser->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Property Storage Folders Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Property Storage Folders'), ['controller' => 'PropertyStorageFolders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Property Storage Folder'), ['controller' => 'PropertyStorageFolders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="propertyStorageFoldersUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($propertyStorageFoldersUser) ?>
    <fieldset>
        <legend><?= __('Edit Property Storage Folders User') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('property_storage_folder_id');
            echo $this->Form->control('folder_access_level');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
