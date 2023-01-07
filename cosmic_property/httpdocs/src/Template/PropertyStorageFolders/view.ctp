<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFolder $propertyStorageFolder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Property Storage Folder'), ['action' => 'edit', $propertyStorageFolder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Property Storage Folder'), ['action' => 'delete', $propertyStorageFolder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyStorageFolder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Property Storage Folders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property Storage Folder'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Properties'), ['controller' => 'Properties', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Property'), ['controller' => 'Properties', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="propertyStorageFolders view large-9 medium-8 columns content">
    <h3><?= h($propertyStorageFolder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Folder Name') ?></th>
            <td><?= h($propertyStorageFolder->folder_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Property') ?></th>
            <td><?= $propertyStorageFolder->has('property') ? $this->Html->link($propertyStorageFolder->property->property_name, ['controller' => 'Properties', 'action' => 'view', $propertyStorageFolder->property->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($propertyStorageFolder->id) ?></td>
        </tr>
    </table>
</div>
