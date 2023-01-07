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


    <!-- Material Design Lite -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <!-- boost trap  CSS-->
    <?= $this->Html->css('bootstrap.min.css'); ?>

    <!-- boost trap  JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>



    <?= $this->Html->css('mdb.min'); ?>
    <?= $this->Html->css('nav_bar'); ?>
    <?= $this->Html->css('text_field'); ?>

    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">


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
            <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>

        </div>
    </div>
    <!--mobile navigation bar end-->

    <!--sidebar start-->
    <div class="sidebar">
        <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>

    </div>
    <!--sidebar end-->


    <script type="text/javascript">
        $(document).ready(function() {
            $('.nav_btn').click(function() {
                $('.mobile_nav_items').toggleClass('active');
            });
        });
    </script>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</body>

</html>

