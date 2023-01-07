<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFile[]|\Cake\Collection\CollectionInterface $propertyStorageFiles
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Property Storage File'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Property Storage Folders'), ['controller' => 'PropertyStorageFolders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Property Storage Folder'), ['controller' => 'PropertyStorageFolders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="propertyStorageFiles index large-9 medium-8 columns content">
    <h3><?= __('Property Storage Files') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uploaded_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uploaded_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_details') ?></th>
                <th scope="col"><?= $this->Paginator->sort('folder_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_path') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propertyStorageFiles as $propertyStorageFile): ?>
            <tr>
                <td><?= $this->Number->format($propertyStorageFile->id) ?></td>
                <td><?= h($propertyStorageFile->file_name) ?></td>
                <td><?= $this->Number->format($propertyStorageFile->uploaded_by) ?></td>
                <td><?= h($propertyStorageFile->uploaded_date) ?></td>
                <td><?= h($propertyStorageFile->file_details) ?></td>
                <td><?= $propertyStorageFile->has('property_storage_folder') ? $this->Html->link($propertyStorageFile->property_storage_folder->id, ['controller' => 'PropertyStorageFolders', 'action' => 'view', $propertyStorageFile->property_storage_folder->id]) : '' ?></td>
                <td><?= h($propertyStorageFile->file_path) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $propertyStorageFile->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $propertyStorageFile->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $propertyStorageFile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyStorageFile->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
