<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemComment $itemComment
 */
?>


<div class="pc-container">
    <div class="pcoded-content">
        <div class="itemComments form large-9 medium-8 columns content">
            <?= $this->Form->create($itemComment) ?>

            <fieldset>
                <legend>Add Item Comment</legend>
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('content',['class'=>'form-control','rows'=>'10','type'=>'textarea','maxlength'=>'5000', 'placeholder'=>'Enter Your comment here...']); ?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('item_maintenance_id', ['label' => "Item Name"]); ?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('user_id',['label'=>'User']); ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
