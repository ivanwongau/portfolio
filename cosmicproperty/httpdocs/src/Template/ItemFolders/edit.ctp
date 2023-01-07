<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemFolder $itemFolder
 */
?>

<div class="item_folder_edit content">
    <div class="container-fluid item_folder_edit">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"> </div>
            <div class="col-lg-4"></div>

        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <?= $this->Form->create($itemFolder) ?>
                <?php echo  $this->Html->link(
                    '<button class="btn btn-secondary" style="margin-bottom:10px;margin-top:10px;"><span>  Back</span></button>',
                    ['controller' => 'Items', 'action' => 'index', $itemFolder->property_id],
                    ['escape' => false]
                ); ?>
                <fieldset>
                    <legend><?= __('Edit Item Folder') ?></legend>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="folder_name">Folder Name</label>

                        <input class="form-control" type="text" pattern="[A-Za-z0-9 ]{1,50}"
                            title="Please only enter alphabetical characters, 1-50 characters" id="folder_name"
                            name="folder_name" value='<?= h($itemFolder->folder_name) ?>' required="">
                    </div>


                </fieldset>
                <br>
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</div>