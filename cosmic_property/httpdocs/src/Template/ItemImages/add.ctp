<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemImage $itemImage
 */
?>
<style>
.col-lg-4 a {
    text-decoration: none;
    color: #fff;
}
</style>

<div class="property_image_add_content">
    <div class="container-fluid item_image_add">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"> </div>
            <div class="col-lg-4"></div>

        </div>

        <div class="row" style="margin-top:100px;">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <button
                    class="btn btn-secondary"><?= $this->Html->link(__('Back'), $this->request->referer()) ?></button>

                <legend><?= __('Add Item Image', "  ", $item_name) ?></legend>
                <?= $this->Form->create($itemImage, ['type' => 'file']) ?>
                <form method="post" action="/imageImage/add" type='file'>
                    <fieldset>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <label class="mdl-textfield__label" for="">Item name</label>
                            <input class="form-control" type="Text" id="" name="" required=""
                                value="<?= h($item_name) ?>" readonly disabled>
                        </div>


                        <br>
                        <?php
                        echo $this->Form->control('image_files[]', ['type' => 'file', 'multiple' => 'multiple']);

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