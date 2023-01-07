<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 * @var \App\Model\Entity\ItemImage $itemImage
 */
?>
<style>
.carousel-item {
    height: 32rem;
    background: black;
    background-position: center;
    background-size: cover;
    position: relative;

}

.carousel-item img {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    background-position: center;
    background-size: cover;
    opacity: 0.7;

}
</style>
<p id="access-level" style="display:none;"><?= $access_level ?></p>


<div class="item_index content">
    <div class="container-fluid item_index">

        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <?php echo  $this->Html->link(
                    '<button class="btn btn-secondary" style="margin-bottom:10px;margin-top:10px;"><span>Back</span></button>',
                    ['action' => 'index', $folder_id, $property_id, $folder_name, $currentprop_name],
                    ['escape' => false]
                ); ?>


                <h3>Item Details</h3>
                <table class="table table-striped table-responsive-md btn-table ">
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Name</td>
                        <td><?= h($item->item_name) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Quantity/Measurement</td>
                        <td><?= h($item->item_quantity) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Rate</td>
                        <td><?php $display_item_total = number_format(h($item->item_rate), 2);
                            echo "$$display_item_total"; ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Unit Of Measurement</td>
                        <td><?= h($item->item_unit_of_mes) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Total</td>
                        <td><?php $display_item_total = number_format(h($item->item_total), 2);
                            echo "$$display_item_total"; ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Condition</td>
                        <td><?= h($item->item_condition) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Allowance</td>
                        <td><?= h($item->item_allowance) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Expected Life</td>
                        <td><?= h($item->expected_life) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Year Due</td>
                        <td><?= h($item->year_due) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Expected Year Due</td>
                        <td><?= h($item->expected_year_due) ?></td>
                    </tr>

                </table>
                <!-- add item photo area -->
                <hr class="solid" id="divider_view_property">
                <div>
                    <h4>Item Photos</h4>

                    <!-- Slideshow container -->

                    <?php echo $this->Html->link(__('Add Item Photo'), ['controller' => 'ItemImages', 'action' => 'add', $item->id, $item->folder_id, $property_id, $item->item_name, $currentprop_name], ['class' => 'btn btn-primary item-image-add']) ?>
                    <?php echo $this->Html->link(__('View Images'), ['controller' => 'ItemImages', 'action' => 'view', $item->id], ['class' => 'btn btn-primary item-image-view']) ?>
                    <br>
                    <br>

                    <!-- Slideshow container -->
                    <div class="slideshow-container">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php $i = 0; ?>
                                <?php foreach ($item->item_images as $itemImage) : ?>

                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;
                                                                                                $i++; ?>"></li>
                                <?php endforeach; ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php $j = 0; ?>
                                <?php foreach ($item->item_images as $itemImage) : ?>

                                <div class="carousel-item <?php if ($j == 0) {
                                                                    echo "active";
                                                                    $j++;
                                                                } ?>">
                                    <?= $this->Html->image($itemImage->image_name, ["class" => "d-block w-100 h-100"]) ?>

                                </div>

                                <?php endforeach; ?>


                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <br>

                </div>

            </div>
            <div class="col-lg-2"> </div>
        </div>
    </div>
</div>