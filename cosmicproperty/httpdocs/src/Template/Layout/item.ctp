<?php $cakeDescription = 'Cosmic Property LTD'; ?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>

    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>



    <!-- boost trap  CSS-->
    <?= $this->Html->css('bootstrap.min.css'); ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>







    <!-- webroot/css -->
    <?= $this->Html->css('tooltips'); ?>

    <?= $this->Html->css('nav_bar.css'); ?>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">




</head>

<body>
    <!-- Navigation bar start -->
    <input type="checkbox" id="check" checked>
    <!--header area start-->
    <header>
        <div style="position: relative;">
            <div style="display: relative">
                <label for="check">
                    <i class="fas fa-bars" id="sidebar_btn" onClick={this.removeItems}></i>
                </label>
            </div>
            <div class="left_area" style="display: inline-block;">
                <h3>Cosmic <span>Property</span></h3>
            </div>
            <div class="right_area" style="float: right; display: inline-block;">
                <p style="color: white; font-family: 'Times New Roman', Times, serif" id="contextDetails">
                    BUILDING NAME: <?= $property_name ?> || ACCESS LEVEL: <?= $access_level ?>
                </p>
            </div>
        </div>
    </header>


    <!--mobile navigation bar start-->
    <div class="mobile_nav">
        <div class="nav_bar">
            <i class="fa fa-bars nav_btn"></i>
        </div>
        <div class="mobile_nav_items">
        <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>

        </div>
    </div>
    <!--mobile navigation bar end-->

    <!--sidebar start-->
    <div class="sidebar">
    <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>

    </div>
    <!--sidebar end-->
    <!-- Navigation bar end -->


    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <?= $this->Html->script('scripts.js'); ?>
    <?= $this->Html->script('jquery-3.5.1.min'); ?>

    <!-- Drag and drop table row -->


    <script type="text/javascript">
    $(document).ready(function() {
        $('.nav_btn').click(function() {
            $('.mobile_nav_items').toggleClass('active');
        });
    });
    </script>

</body>

</html>
