<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemMaintenances $itemMaintenances
 */

use Cake\ORM\TableRegistry;

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


    /*
    .comment {
        border: 1px solid rgb(65, 162, 162);
        background-color: rgb(97, 145, 205);
        float: left;

        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px
    }

    .comment h6,
    .comment span,
    .darker h6,
    .darker span {
        display: inline
    }


    .comment span,
    .darker span, {
        color: rgb(184, 183, 183)
    }

    h1,
    .comment p {
        color: white;
        font-weight: bold
    }

    label {
        color: rgb(212, 208, 208)
    }

    body{
        margin: 0;
        padding: 0;
    }*/

    body {
        margin-top: 20px;
    }

    .content-item {
        padding: 30px 0;
        background-color: #FFFFFF;
    }

    .content-item.grey {
        background-color: #F0F0F0;
        padding: 50px 0;
        height: 100%;
    }

    .content-item h2 {
        font-weight: 700;
        font-size: 35px;
        line-height: 45px;
        text-transform: uppercase;
        margin: 20px 0;
    }

    .content-item h3 {
        font-weight: 400;
        font-size: 20px;
        color: #555555;
        margin: 10px 0 15px;
        padding: 0;
    }


    .content-headline h2 {
        background-color: #FFFFFF;
        display: inline-block;
        margin: -20px auto 0;
        padding: 0 20px;
    }

    .grey .content-headline h2 {
        background-color: #F0F0F0;
    }

    .content-headline h3 {
        font-size: 14px;
        color: #AAAAAA;
        display: block;
    }


    #comments {
        box-shadow: 0 -1px 6px 1px rgba(0, 0, 0, 0.1);
        background-color: #FFFFFF;
    }

    #comments form {
        margin-bottom: 30px;
    }


    #comments form fieldset {
        clear: both;
    }


    #comments .media {
        border-top: 1px dashed #DDDDDD;
        padding: 20px 0;
        margin: 0;
    }

    #comments .media > .pull-left {
        margin-right: 20px;
    }

    #comments .media img {
        max-width: 40px;
        max-height: 40px;
    }

    #comments .media h4 {
        margin: 0 0 10px;
    }

    #comments .media h4 span {
        font-size: 14px;
        float: right;
        color: #999999;
    }
    #comments .media p {
        inline-size: 1250px;
        overflow-wrap: break-word;
        margin-bottom: 15px;
        text-align: justify;


    }

    #comments .media-detail {
        margin: 0;
    }

    #comments .media-detail li {
        color: #AAAAAA;
        font-size: 12px;
        padding-right: 10px;
        font-weight: 600;

    }

    #comments .media-detail a:hover {
        text-decoration: underline;
    }

    #comments .media-detail li:last-child {
        padding-right: 0;

    }

    #comments .media-detail li i {
        color: #666666;
        font-size: 15px;
        margin-right: 10px;

    }

</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


<p id="access-level" style="display:none;"><?= $access_level ?></p>

<body style="background-color: #F0F2F8">
<div class="item_index content">
    <div class="container-fluid item_index">


        <div class="row" style="margin-top:10px;">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <?php echo $this->Html->link(
                    '<button class="btn btn-secondary" style="margin-bottom:10px;"><span>  Back</span></button>',
                    ['action' => 'index', $itemMaintenance->property_id],
                    ['escape' => false]
                ); ?>


                <h3>Item Details</h3>
                <div>
                    <button style="float: right; margin-left: 15px; margin-bottom: 15px" type="button"
                            class="btn btn-primary" onclick="textForCopy()">Copy Item Text
                    </button>
                </div>
                <table class="table table-striped table-responsive-md btn-table ">
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Name</td>
                        <td><?= h($itemMaintenance->item_name) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Status</td>
                        <td><?= h($itemMaintenance->item_status) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Location</td>
                        <td><?= h($itemMaintenance->item_location) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Findings</td>
                        <td><?= h($itemMaintenance->item_finding) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Recommendation</td>
                        <td><?= h($itemMaintenance->item_recommendation) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Cost Estimate</td>
                        <td><?= h($itemMaintenance->cost_estimate) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Potential Hazard</td>
                        <td><?= h($itemMaintenance->potential_hazard) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Item Priority</td>
                        <td><?= h($itemMaintenance->item_priority) ?></td>
                    </tr>
                </table>


                <br>


                <p id="copyable" style="display: none">Item Name: <?= h($itemMaintenance->item_name) ?>, Item
                    Status: <?= h($itemMaintenance->item_status) ?>, Item
                    Location: <?= h($itemMaintenance->item_location) ?>, Item
                    Findings: <?= h($itemMaintenance->item_finding) ?>, Item
                    Recommendation: <?= h($itemMaintenance->item_recommendation) ?>, Cost
                    Estimate: <?= h($itemMaintenance->cost_estimate) ?>, Potential
                    Hazard: <?= h($itemMaintenance->potential_hazard) ?></p>

                <!-- add item photo area -->
                <hr class="solid" id="divider_view_property">
                <div>
                    <h4><b>Item Photos</b></h4>

                    <!-- Slideshow container -->

                    <?php echo $this->Html->link(__('Add Item Photo'), ['controller' => 'BcrImages', 'action' => 'add', $itemMaintenance->id,], ['class' => 'btn btn-primary item-image-add']) ?>
                    <?php echo $this->Html->link(__('View Images'), ['controller' => 'BcrImages', 'action' => 'view', $itemMaintenance->id], ['class' => 'btn btn-primary item-image-view']) ?>
                    <br>
                    <br>

                    <!-- Slideshow container -->
                    <div class="slideshow-container">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php $i = 0; ?>
                                <?php foreach ($query as $bcrImage) : ?>

                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;
                                    $i++; ?>"></li>
                                <?php endforeach; ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php $j = 0; ?>
                                <?php foreach ($query as $bcrImage) : ?>

                                    <div class="carousel-item <?php if ($j == 0) {
                                        echo "active";
                                        $j++;
                                    } ?>">
                                        <?= $this->Html->image($bcrImage->image_name, ["class" => "d-block w-100 h-100"]) ?>

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
                    <br>
                    <br>
                </div>

                <hr class="solid" id="divider_view_property">


                <section class="content-item" id="comments">
                    <div class="container">
                        <div class="row">
                            <div >
                                <form>

                                    <?php echo $this->Html->link(
                                        'Add New Comment',
                                        ['controller' => 'itemComments', 'action' => 'add', $itemMaintenance->id,$user->id],
                                        ['class' => 'btn btn-primary btn-round']
                                    ); ?>
                                </form>

                                <h3>Comments</h3>
                                <?php
                                $comments = TableRegistry::getTableLocator()->get('ItemComments');
                                $itemComments = $comments->find()->select([])->where(['item_maintenance_id' => $itemMaintenance->get('id')]);



                                foreach ($itemComments as $itemComment):


                                    $usersTable = TableRegistry::getTableLocator()->get('Users');
                                    $commentOwners = $usersTable->find()->select()->where(['id'=>$itemComment->user_id]);
                                    foreach ($commentOwners as $commentOwner):


                                ?>
                                    <!-- COMMENT CONTENT - START -->
                                    <div class="media">
                                        <div class="icon">
                                        <a class="pull-left" href="#"><img
                                                src=<?php echo $this->Url->build("/assets/img/user-profile-icon.jpg") ?> ></a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $commentOwner->first_name.' '.$commentOwner->last_name;?></h4>
                                            <p><?php echo '    ' . nl2br($itemComment->content) ?></p>
                                            <ul class="list-unstyled list-inline media-detail pull-left">
                                                <li>
                                                    <i class="fa fa-calendar"></i><?php echo $itemComment->create_date->timezone('Australia/Melbourne')->format('Y/m/d G:i'); ?>
                                                </li>

                                            </ul>

                                            <?php if($user->id === $itemComment->user_id) { ?>
                                            <a style="float: right; margin-left: 6px; margin-right: 6px"
                                               href="<?= $this->URL->build(['controller' => 'itemComments', 'action' => 'delete', $itemComment->id, $itemMaintenance->id]) ?>"><i
                                                    class="fas fa-trash"></i></a>

                                            <a style="float: right; margin-left: 6px; margin-right: 6px"
                                               href="<?= $this->URL->build(['controller' => 'itemComments', 'action' => 'edit', $itemComment->id, $itemMaintenance->id]) ?>"><i
                                                    class="fas fa-edit"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- COMMENT CONTENT - END -->
                                <?php endforeach; endforeach;?>
                            </div>
                        </div>
                    </div>
                </section>


                <!--<div class="container">
                        <div class="row">
                            <div class="col-sm-5 col-md-6 col-12 pb-4">
                                <?php /*echo $this->Html->link(
                                    'Add New Comment',
                                    ['controller' => 'itemComments', 'action' => 'add', $itemMaintenance->id],
                                    ['class' => 'btn btn-primary btn-round']
                                ); */ ?>
                                <h3>Comments</h3>

                                <?php
                /*                                $comments = TableRegistry::getTableLocator()->get('ItemComments');
                                                $itemComments = $comments->find()->select([])->where(['item_maintenance_id'=>$itemMaintenance->get('id')]);

                                                foreach($itemComments as $itemComment):
                                                */ ?>
                                <div class="comment mt-4 text-justify float-left"> <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40">
                                    <h6><?php /*echo $user->first_name.' '.$user->last_name */ ?></h6> <span><?php /*echo $itemComment->create_date->timezone('Australia/Melbourne')->format('Y/m/d G:i'); */ ?></span> <br>
                                    <p><?php /*echo '    '.$itemComment->content */ ?></p>
                                </div>
                                <?php /*endforeach; */ ?>
                            </div>
                        </div>
                    </div>-->


            </div>

        </div>
    </div>
</div>
</body>

<script>
    function textForCopy() {

        let text = document.getElementById('copyable');
        navigator.clipboard.writeText(text.innerHTML);

        alert("Item information has been copied to the clipboard");


    }

</script>
