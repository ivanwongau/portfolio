<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry $enquiry
 */
?>
    <?= $this->Form->create($enquiry) ?>
    <fieldset>
        <legend><?= __('Edit Enquiry') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('temp_email');
            echo $this->Form->control('topic');
            echo $this->Form->control('message');
            echo $this->Form->control('date');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
