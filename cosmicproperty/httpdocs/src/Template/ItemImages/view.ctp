<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemImage $itemImage
 */
?>


<style>
.image_view a {
    text-decoration: none;
    color: #fff;
}
</style>

<div class="image_view content">
    <div class="container-fluid image_view">
        <button class="btn btn-secondary"><?= $this->Html->link(__('Back'), $this->request->referer()) ?></button>

        <div class="row el-element-overlay m-b-20">
            <?php foreach ($query as $itemImage) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="white-box">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            <?= $this->Html->image($itemImage->image_name) ?>
                            <div class="el-overlay">
                                <ul class="el-info">
                                    <li><a class="btn default btn-outline image-popup-vertical-fit"
                                            href='../../webroot/img/<?= $itemImage->image_name ?>'><i
                                                class="fas fa-search"></i></a></li>
                                    <li><a class="btn default btn-outline" data-toggle="modal"
                                            data-target="#something<?= $itemImage->id ?>"><i
                                                class="fas fa-trash"></i></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Delete confirmation Modal -->

            <div id="something<?= $itemImage->id ?>" class="modal">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">

                            <h4 class="modal-title w-100">Are you sure?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to delete the Property. This process cannot be undone.</p>

                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemImage->id, $item_id], ['class' => 'btn btn-danger', 'style' => 'color:white;']) ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal End -->
            <?php endforeach; ?>

        </div>


    </div>
</div>