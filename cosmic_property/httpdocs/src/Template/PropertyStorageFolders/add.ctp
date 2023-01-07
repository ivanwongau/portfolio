<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFolder $propertyStorageFolder
 */
?>
<div class="item-table-card">
    <div class="table-container">
        <?php echo $this->Html->link(
            '<button class="btn btn-secondary" style="margin-bottom:10px;"><span>   Back</span></button>',
            ['controller' => 'Properties', 'action' => 'dashboard', $property_id],
            ['escape' => false]
        ); ?>
        <?= $this->Form->create($propertyStorageFolder) ?>
        <h2><?= __('Add Property Storage Folder') ?></h2>

        <div class="file-name-field textfield">
            <label class="textfield-label" for="folder_name">Folder Name</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="folder_name"
                   name="folder_name" required="" maxlength="30">
        </div>

        <?php
        echo $this->Form->control('property_id', ['default' => $property_id, 'hidden' => 'true', 'label' => '']);
        ?>

        <button type="submit" class="btn btn-primary">Submit</button>
        <?= $this->Form->end() ?>
    </div>
</div>
