<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFolder $propertyStorageFolder
 */
?>
<div class="item-table-card">
    <div class="table-container">
        <button class="btn btn-secondary" style="margin-bottom:10px;" onclick="window.history.back()">Back</button>

        <?= $this->Form->create($propertyStorageFolder) ?>
            <h2><?= __('Rename Storage Folder') ?></h2>

            <div class="file-name-field textfield">
                <label class="textfield-label" for="folder_name">Folder Name</label>
                <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                       title="Please only enter alphabetical characters, 1-50 characters" id="folder_name"
                       name="folder_name" required="" maxlength="30" value="<?= $propertyStorageFolder->folder_name ?>">
            </div>

        <br>

        <button type="submit" class="btn btn-primary">Submit</button>

        <?= $this->Form->end() ?>
    </div>
</div>
