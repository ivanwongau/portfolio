<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFile $propertyStorageFile
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Property Storage File'), ['action' => 'edit', $propertyStorageFile->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Property Storage File'), ['action' => 'delete', $propertyStorageFile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyStorageFile->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Property Storage Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property Storage File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Property Storage Folders'), ['controller' => 'PropertyStorageFolders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property Storage Folder'), ['controller' => 'PropertyStorageFolders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="propertyStorageFiles view large-9 medium-8 columns content">
    <h3><?= h($propertyStorageFile->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('File Name') ?></th>
            <td><?= h($propertyStorageFile->file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Details') ?></th>
            <td><?= h($propertyStorageFile->file_details) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Property Storage Folder') ?></th>
            <td><?= $propertyStorageFile->has('property_storage_folder') ? $this->Html->link($propertyStorageFile->property_storage_folder->id, ['controller' => 'PropertyStorageFolders', 'action' => 'view', $propertyStorageFile->property_storage_folder->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Path') ?></th>
            <td><?= h($propertyStorageFile->file_path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($propertyStorageFile->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uploaded By') ?></th>
            <td><?= $this->Number->format($propertyStorageFile->uploaded_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uploaded Date') ?></th>
            <td><?= h($propertyStorageFile->uploaded_date) ?></td>
        </tr>
    </table>
</div>
