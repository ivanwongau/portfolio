<!DOCTYPE html>
<!--
Template Name: Dodmond
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<head>
    <title>Cosmic Property</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?= $this->Html->css('layout.css');?>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--navigation bar-->
<?= $this->element('navbar');?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--it should be here the content-->
<?= $this->fetch('content')?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--Footer-->
<?= $this->element('footer');?>

<!-- JAVASCRIPTS -->
<?php echo $this->Html->script('jquery.min.js');?>
<?php echo $this->Html->script('jquery.backtotop.js');?>
<?php echo $this->Html->script('jquery.mobilemenu.js');?>
<?php echo $this->Html->script('jquery.flexslider-min.js');?>
</body>
</html>
