<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyImage $propertyImage
 * @var \App\Model\Entity\Property $property
 */
?>
<style>
.col-lg-4 a {
    text-decoration: none;
    color: #fff;
}
</style>
<div class="property_image_add content">
    <div class="container-fluid property_image_add">

        <div class="row">
            <div class="col-lg-4"></div>

            <div class="col-lg-4">
                <?php echo  $this->Html->link(
                    '<button class="btn btn-secondary" style="margin-top:10px;"><span> Back</span></button>',
                    ['controller' => 'Properties', 'action' => 'dashboard', $currentprop_id],
                    ['escape' => false]
                ); ?>

                <legend><?= __('Add Property Image', "  ", $currentprop_name) ?></legend>
                <?= $this->Form->create($propertyImage, ['type' => 'file']) ?>
                <fieldset>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="">Property name</label>
                        <input class="form-control" type="Text" id="" name="" required=""
                            value="<?= h($currentprop_name) ?>" readonly disabled>
                    </div>
                    <br>
                    <?php
                    echo $this->Form->file('image_files[]', ['type' => 'file', 'multiple' => 'multiple']);
                    ?>
                </fieldset>
                <br>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
            <div class="col-lg-4"></div>
        </div>


    </div>
</div>
