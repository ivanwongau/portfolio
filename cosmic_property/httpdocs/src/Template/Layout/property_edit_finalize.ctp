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



$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Cosmic Property</title>
    <?= $this->Html->css('loginstyle.css'); ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('newstyle.css') ?>


    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body onload="propertyEditFinalize()">

    <!--wrapper start-->
    <div class="wrapper">
        <!--header menu start-->

        <div class="header">
            <div class="header-menu">
                <div class="title">Cosmic <span>Property</span></div>
                <div class="sidebar-btn">
                    <i class="fas fa-bars"></i>
                </div>


                <ul style="margin-top: 20px">
                    <li>
                        <?php $url = ['controller' => 'users', 'action' => 'notification'];
                        $url = $this->Url->build($url) ?>
                        <a href="<?= $url ?>" class="notification">
                            <span class="fas fa-bell"></span>
                            <span class="badge"><?php echo $count ?></span>
                        </a>
                    </li>

                    <li>
                        <?php echo $this->Html->link(
                            $this->Html->tag('i', '', ['class' => "fas fa-user-circle"]),
                            ['controller' => 'users', 'action' => 'profile'],
                            ['escape' => false]
                        ); ?>
                    </li>

                    <li>
                        <?php echo $this->Html->link(
                            $this->Html->tag('i', '', ['class' => "fas fa-power-off"]),
                            ['controller' => 'users/logout'],
                            ['escape' => false]
                        ); ?>
                    </li>
                </ul>
            </div>
        </div>
        <!--header menu end-->
        <!--sidebar start-->
        <div class="sidebar">
            <div class="sidebar-menu">
                <center>
                    <h4 style="color: white;"><b>Welcome <br>
                            <?= h($user->first_name) . ' ' . h($user->last_name) ?> !</b></h4>
                </center>

                <hr class="sidebar-divider my-0">

                <li class="item">
                    <span>
                        <?php echo $this->Html->link(
                            $this->Html->tag('i', '', ['class' => "fas fa-fw fa-building"]) . ' BUILDINGS',
                            ['controller' => 'properties', 'action' => 'buildinglist'],
                            ['class' => 'menu-btn', 'escape' => false]
                        ); ?>
                    </span>
                </li>
                <!--                <span style="font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';-webkit-font-smoothing: unset;">Buildings</span></a>-->
                <hr class="sidebar-divider my-0">


                <?php if ($user->role == 'admin') { ?>
                    <li class="item">
                        <span>
                            <?php echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => "fas fa-fw fa-user-circle"]) . ' USERS',
                                ['controller' => 'users/index'],
                                ['class' => 'menu-btn', 'escape' => false]
                            ); ?>
                        </span>
                    </li>
                    <hr class="sidebar-divider my-0">
                <?php } ?>


                <?php if ($user->role == 'admin') { ?>
                    <li class="item">
                        <span>
                            <?php echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => "fas fa-envelope"]) . ' ENQUIRIES',
                                ['controller' => 'enquiries/index'],
                                ['class' => 'menu-btn', 'escape' => false]
                            ); ?>
                        </span>
                    </li>
                    <hr class="sidebar-divider my-0">
                <?php } ?>


                <?php if ($user->role == 'admin') { ?>
                    <li class="item">
                        <span>
                            <?php echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => "fas fa-handshake"]) . ' ACCESS CONTROL',
                                ['controller' => 'BuildingsUsers/index'],
                                ['class' => 'menu-btn', 'escape' => false]
                            ); ?>
                        </span>
                    </li>
                    <hr class="sidebar-divider my-0">
                <?php } ?>


                <?php if ($user->role == 'admin') { ?>
                    <li class="item">
                        <span>
                            <?php echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => "fas fa-scroll"]) . ' SUBSCRIPTION',
                                ['controller' => 'subscriptions/index'],
                                ['class' => 'menu-btn', 'escape' => false]
                            ); ?>
                        </span>
                    </li>
                    <hr class="sidebar-divider my-0">
                <?php } ?>
            </div>
        </div>
        <!--sidebar end-->
        <!--main container start-->
        <div class="main-container clearfix">
            <br><br>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <!--main container end-->
    </div>
    <!--wrapper end-->

    <script type="text/javascript">
        $(document).ready(function() {
            $(".sidebar-btn").click(function() {
                $(".wrapper").toggleClass("collapse");
            });
        });
    </script>
    <?= $this->Html->script('finalize.js'); ?>

</body>

</html>
