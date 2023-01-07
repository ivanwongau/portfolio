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


    <!-- boost trap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!-- boost trap  JS-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>



    <!-- boost trap  CSS-->
    <?= $this->Html->css('bootstrap.min.css'); ?>




    <?= $this->Html->css('nav_bar'); ?>
    <?= $this->Html->css('text_field') ?>
    <?= $this->Html->css('report_download') ?>

    <?= $this->fetch('script') ?>
    <?= $this->Html->script('scripts.js'); ?>







    <?= $this->fetch('script') ?>
</head>

<body>
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
        </div>
    </header>


    <!--mobile navigation bar start-->
    <div class="mobile_nav">
        <div class="nav_bar">
            <i class="fa fa-bars nav_btn"></i>
        </div>
        <div class="mobile_nav_items">
            <?php echo  $this->Html->link(
                '<i class="fas fa-desktop"></i><span>Dashboard</span>',
                ['controller' => 'properties', 'action' => 'index'],
                ['escape' => false]
            ); ?>

            <?php echo  $this->Html->link('<i class="fas fa-cogs"></i><span>Add New Property</span>', ['controller' => 'properties', 'action' => 'add'], ['escape' => false]); ?>
            <a href="#"><i class="fas fa-table"></i><span>Your Reports</span></a>
            <a href="#"><i class="fas fa-th"></i><span>Place Holder</span></a>
            <a href="https://cosmicproperty.com.au/"><i class="fas fa-info-circle"></i><span>About</span></a>
            <a href="#"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
        </div>
    </div>
    <!--mobile navigation bar end-->

    <!--sidebar start-->
    <div class="sidebar">
        <!-- side bar url -->
        <!-- <a href="./property/index.ctp"><i class="fas fa-desktop"></i><span>Dashboard</span></a> -->
        <?php echo  $this->Html->link('<i class="fas fa-desktop"></i><span>List All Properties</span>', ['controller' => 'properties', 'action' => 'index'], ['escape' => false]); ?>
        <?php echo  $this->Html->link('<i class="fas fa-cogs"></i><span>Add New Property</span>', ['controller' => 'properties', 'action' => 'add'], ['escape' => false]); ?>
        <a href="#"><i class="fas fa-table"></i><span>Your Reports</span></a>
        <a href="#"><i class="fas fa-th"></i><span>Place Holder</span></a>
        <a href="https://cosmicproperty.com.au/"><i class="fas fa-info-circle"></i><span>About</span></a>
        <a href="#"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->



    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>





</body>

</html>
