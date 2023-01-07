<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invited $invited
 */
?>
<div class="invited form large-9 medium-8 columns content">
    <?= $this->Form->create($invited) ?>
    <fieldset>
        <legend><?= __('Add Invited') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('property_id', ['options' => $properties]);
            echo $this->Form->control('access_level');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
