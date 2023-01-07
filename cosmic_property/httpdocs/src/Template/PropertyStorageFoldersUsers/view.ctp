<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFoldersUser $propertyStorageFoldersUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Property Storage Folders User'), ['action' => 'edit', $propertyStorageFoldersUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Property Storage Folders User'), ['action' => 'delete', $propertyStorageFoldersUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyStorageFoldersUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Property Storage Folders Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property Storage Folders User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Property Storage Folders'), ['controller' => 'PropertyStorageFolders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property Storage Folder'), ['controller' => 'PropertyStorageFolders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="propertyStorageFoldersUsers view large-9 medium-8 columns content">
    <h3><?= h($propertyStorageFoldersUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $propertyStorageFoldersUser->has('user') ? $this->Html->link($propertyStorageFoldersUser->user->email, ['controller' => 'Users', 'action' => 'view', $propertyStorageFoldersUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($propertyStorageFoldersUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Property Storage Folder Id') ?></th>
            <td><?= $this->Number->format($propertyStorageFoldersUser->property_storage_folder_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Folder Access Level') ?></th>
            <td><?= $this->Number->format($propertyStorageFoldersUser->folder_access_level) ?></td>
        </tr>
    </table>
</div>
