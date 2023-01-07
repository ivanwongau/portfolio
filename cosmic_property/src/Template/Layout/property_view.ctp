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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran&family=Open+Sans:wght@600&display=swap"
        rel="stylesheet">


    <!-- boost trap  CSS-->
    <?= $this->Html->css('bootstrap.min.css'); ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <!-- <link rel="stylesheet" href="mdb.min.css"> -->


    <?= $this->Html->css('nav_bar'); ?>
    <!-- Remove the tooltips -->
    <?= $this->Html->css('property_view'); ?>
    <!-- already remove mdb.min -->

    <!-- Calendar -->
    <?= $this->Html->css('vanillaCalendar.css'); ?>


    <!-- Navigation bar Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

</head>

<body onload="dashboardAccessControl()">
    <input type="checkbox" id="check" checked>
    <!--header area start-->
    <header>
        <label for="check">
            <i class="fas fa-bars" id="sidebar_btn" onClick={this.removeItems}></i>
        </label>
        <div class="left_area">
            <h3>Cosmic <span>Property</span></h3>
        </div>
    </header>


    <!--mobile navigation bar start-->
    <div class="mobile_nav">
        <div class="nav_bar">
            <i class="fa fa-bars nav_btn"></i>
        </div>
        <div class="mobile_nav_items">
            <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>
            <?php echo  $this->Html->link('··· <span>More Action</span>', ['controller' => 'properties', 'action' => 'action', $currentprop_id], ['escape' => false]); ?>
        </div>
    </div>
    <!--mobile navigation bar end-->

    <!--sidebar start-->
    <div class="sidebar">
        <!-- side bar url -->
        <!-- <a href="./property/index.ctp"><i class="fas fa-desktop"></i><span>Dashboard</span></a> -->
        <!-- <a href=" <?= $this->Url->build(['action' => 'action', $building->id]) ?>"> -->

        <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>
        <?php echo  $this->Html->link('··· <span>More Action</span>', ['controller' => 'properties', 'action' => 'action', $currentprop_id], ['escape' => false]); ?>



    </div>
    <!--sidebar end-->




    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <?= $this->Html->script('vanillaCalendar.js'); ?>
    <?= $this->Html->script('access_control.js'); ?>
    <?= $this->Html->script('jquery-3.5.1.min'); ?>
    <?= $this->Html->script('input_validation'); ?>
    <?= $this->Html->script('dashboard.js'); ?>



    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>







    <script>
    $('tbody').sortable();
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.nav_btn').click(function() {
            $('.mobile_nav_items').toggleClass('active');
        });
    });
    </script>
</body>

</html>