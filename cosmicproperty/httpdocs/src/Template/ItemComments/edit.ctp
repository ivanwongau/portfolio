<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemComment $itemComment
 */
?>




<div class="item-table-card">
    <div class="table-container">
        <?= $this->Form->create($itemComment) ?>
        <fieldset>
            <legend><?= __('Edit Item Comment') ?></legend>
            <?php
            echo $this->Form->control('content',['class'=>'form-control','rows'=>'10','type'=>'textarea','maxlength'=>'5000','style'=>'margin-bottom:15px']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit') )?>
        <?= $this->Form->end() ?>
    </div>
</div>
