<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BcrImage $bcrImage
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
            <div class="col-lg-4"> </div>
            <div class="col-lg-4"></div>

        </div>

        <div class="row">
            <div class="col-lg-4"></div>

            <div class="col-lg-4">
                <button class="btn btn-secondary"><?= $this->Html->link(__('Back'), $this->request->referer()) ?></button>
                <legend><?= __('Add Image', "  ") ?></legend>
                <?= $this->Form->create($bcrImage, ['type' => 'file']) ?>
                <form method="post" action="/bcrImage/add" type='file'>
                    <fieldset>


                        <?php
                        echo $this->Form->file('image_files[]', ['type' => 'file', 'multiple' => 'multiple']);
                        ?>
                    </fieldset>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->end() ?>
            </div>
            <div class="col-lg-4"></div>
        </div>


    </div>
</div>
