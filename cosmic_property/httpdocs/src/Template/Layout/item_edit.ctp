<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Cosmic Property LTD';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>

    </title>
    <?= $this->Html->meta('icon') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran&family=Open+Sans:wght@600&display=swap"
        rel="stylesheet">

    <!-- boost trap -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>

    <?= $this->Html->css('home'); ?>
    <?= $this->Html->css('bootstrap.min.css'); ?>
    <?= $this->Html->css('nav_bar'); ?>

    <?= $this->Html->css('magnific-popup') ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <!-- new template 1 -->
    <?= $this->Html->css('home'); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('script') ?>
</head>

<body onload="itemEditFinalize()">
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
            <p style="color: white; font-family: 'Times New Roman', Times, serif" id="contextDetails">
                BUILDING NAME: <?= $property_name ?> || ACCESS LEVEL: <?= $access_level ?>
            </p>
        </div>
    </div>
    <!--mobile navigation bar end-->

    <!--sidebar start-->
    <div class="sidebar">
        <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>

    </div>
    <!--sidebar end-->



    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>




    <?= $this->Html->script('scripts'); ?>

    <?= $this->Html->script('jquery.magnific-popup.min.js'); ?>

    <?= $this->Html->script('jquery.magnific-popup-init.js'); ?>

    <?= $this->Html->script('finalize.js'); ?>



    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWNMU-t_-d2PareIKOT1-6oDHjD7Z2JG4&libraries=places&callback=initAutocomplete"
        async defer></script>


    <script type="text/javascript">
    $(document).ready(function() {
        $('.nav_btn').click(function() {
            $('.mobile_nav_items').toggleClass('active');
        });
    });
    </script>


</body>

</html>
