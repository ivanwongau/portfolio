<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFile $propertyStorageFile
 */
?>
<div class="item-table-card">
    <div class="table-container">

        <button class="btn btn-secondary" style="margin-bottom:10px;" onclick="window.history.back()">Back</button>

        <?= $this->Form->create($propertyStorageFile) ?>
        <fieldset>
            <h2>Edit <?= $propertyStorageFile->file_name ?></h2>
            <label class="textfield-label" for="file_name">File Name</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="file_name"
                   name="file_name" required="" maxlength="30" value="<?= $propertyStorageFile->file_name ?>">

            <br>

            <label class="textfield-label" for="file_details">File Details</label>
            <textarea class="form-control" type="text" pattern="[A-Za-z0-9. -]{1,250}"
                      title="Please only enter alphabetical characters, 1-250 characters" id="file_details"
                      name="file_details"><?= $propertyStorageFile->file_details ?></textarea>
        </fieldset>

        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
        <?= $this->Form->end() ?>
    </div>
</div>
