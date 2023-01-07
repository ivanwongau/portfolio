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
    <title>Dodmond</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?= $this->Html->css('layout.css');?>
</head>
<body id="top">
<!--header-->
<div class="wrapper row1">
    <nav id="mainav" class="hoc clear">
        <!-- ################################################################################################ -->
        <ul class="clear">
            <li class="active"><?php echo $this->Html->link(
                    'Home',
                    ['controller' => 'websites/home']);?></li>
            <li ><?php echo $this->Html->link(
                    '▼ Inspection',
                    ['controller' => 'websites/inspection','class'=>'drop']);?></a>
                <ul>
                    <li><?php echo $this->Html->link(
                            'Long Term Maintenance Plan',
                            ['controller' => 'websites/ltmp']);?></li>
                    <li> <?php echo $this->Html->link(
                            'Building Condition Report',
                            ['controller' => 'websites/bcr']);?></li>
                </ul>
            </li>
            <li ><?php echo $this->Html->link(
                    '▼ Commercial Construction',
                    ['controller' => 'websites/commercons','class'=>'drop']);?></a>
                <ul>
                    <li><?php echo $this->Html->link(
                            'Industrial Construction',
                            ['controller' => 'websites/induscons']);?></li>
                    <li><?php echo $this->Html->link(
                            'Small Commercial Construction',
                            ['controller' => 'websites/smallcommcons']);?></li>
                    <li><?php echo $this->Html->link(
                            'Office Fit Out',
                            ['controller' => 'websites/ofitout']);?></li>
                    <li><?php echo $this->Html->link(
                            'Office De Fit',
                            ['controller' => 'websites/defit']);?></li>
                    <li><?php echo $this->Html->link(
                            'Warehouse Conversion',
                            ['controller' => 'websites/wareconver']);?></li>
                    <li><?php echo $this->Html->link(
                            'Apartment Refurbishment and Domestic Upgrade',
                            ['controller' => 'websites/aptrefur']);?></li>
                </ul>
            </li>
            <li><?php echo $this->Html->link(
                    'Project Management',
                    ['controller' => 'websites/projmana']);?></li>
            <li ><?php echo $this->Html->link(
                    'About Us',
                    ['controller' => 'websites/aboutus']);?></li>
            <li><?php echo $this->Html->link(
                    'Contact Us',
                    ['controller' => 'websites/contactus']);?></li>
        </ul>
        <!-- ################################################################################################ -->
    </nav>
</div>
<!--body-->
<div class="wrapper bgded overlay footbackimage">
    <div id="pageintro" class="hoc clear">
        <!--################################################################################################ -->
        <ul class="slides">
            <li>
                <article>
                    <p>A home. An office. A building. A location.</p>
                    <h3 class="heading">MAKING SPACES BETTER PLACES </h3>
                    <p>SPACE : an empty area that is available to be used. <br> PLACE: a portion of space designated or available for use.</p>
                    <footer>
                        <button class="btn">
                            <?= $this->HTML->link('Learn More',['controller' => 'websites/aboutus']);?>
                        </button>
                    </footer>
                </article>
            </li>
        </ul>
    </div>
    <!-- ################################################################################################ -->
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row2">
    <div class="hoc container clear">
        <!-- ################################################################################################ -->
        <ul class="nospace group figures">
            <li class="one_third first">
                <figure><?php echo $this->Html->image('back4.png');?>
                    <figcaption><?php echo $this->Html->link('LONG TERM MAINTENANCE PLAN',['controller' => 'websites/ltmp']);?></figcaption>
                </figure>
            </li>
            <li class="one_third">
                <figure><?php echo $this->Html->image('back3.png');?>
                    <figcaption><?php echo $this->Html->link('APARTMENT REFURBISHMENT',['controller' => 'websites/aptrefur']);?></figcaption>
                </figure>
            </li>
            <li class="one_third">
                <figure><?php echo $this->Html->image('back5.png');?>
                    <figcaption><?php echo $this->Html->link('WAREHOUSE CONVERSION',['controller' => 'websites/wareconver']);?></figcaption>
                </figure>
            </li>
        </ul>
        <!-- ################################################################################################ -->
    </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
    <main class="hoc container clear">
        <!-- main body -->
        <!-- ################################################################################################ -->
        <div class="sectiontitle">
        </div>
        <ul class="nospace group">
            <li class="one_third first">
                <article><i class="btmspace-30 fa fa-3x fa-laptop"></i>
                    <h6 class="heading font-x1">EXPERIENCE</h6>
                    <p class="btmspace-30">We have experience across many construction sectors including but not limited too:<br> <br>
                        - Small Commercial Builds<br>
                        - Large Industrial Builds<br>
                        - Sporting Facilities Builds<br>
                        - Pavillion Refurbishments<br>
                        - Shop Front Remodelling and Refurbishment<br>
                        - Live Occupany Extentions & Refurbishments</p>
                </article>
            </li>
            <li class="one_third">
                <article><i class="btmspace-30 fa fa-3x fa-lastfm"></i>
                    <h6 class="heading font-x1">HIGH QUALITY</h6>
                    <p class="btmspace-30">We pride ourselves in delivering quality products and services at all levels. Our philosophy which enables us to achieve this is simply this.<br><br>TAKING OWNERSHIP.<br><br>
                        We take full ownership of your project as if it were ours. The question continually asked of ourselves is "would we accept this if it were ours?"<br><br>This mind set of "everything effects everything else" is the way in which we operate and conduct ourselves. We take what is yours very seriously and personally. </p>
                </article>
            </li>
            <li class="one_third">
                <article><i class="btmspace-30 fa fa-3x fa-codiepie"></i>
                    <h6 class="heading font-x1">CREATIVITY</h6>
                    <p class="btmspace-30">We thrive in environments that challenge the norm, where creative concepts and ideas are at the forefront of design.<br> <br> Our mission is to deliver your vision in the most accurate form possible and bring into reality the image in your mind.<br><br> Applying creative solutions is our common practice.</p>
                </article>
            </li>
        </ul>
        <!-- ################################################################################################ -->
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/02.png');">-->
<div class="guarantee">
    <section class="hoc container clear">
        <!-- ################################################################################################ -->
        <div class="sectiontitle">
            <h6 class="heading">Our Guarantee </h6>
        </div>
        <ul id="stats" class="nospace group">
            <li class="one_quarter first"><i class="fa fa-3x fa-sellsy"></i>
                <p>COOPERATION PARTNER</p>
                <p>12345</p>
            </li>
            <li class="one_quarter"><i class="fa fa-3x fa-contao"></i>
                <p>Customers</p>
                <p>12345</p>
            </li>
            <li class="one_quarter"><i class="fa fa-3x fa-signing"></i>
                <p>Branch</p>
                <p>12345</p>
            </li>
            <li class="one_quarter"><i class="fa fa-3x fa-envira"></i>
                <p>Inspectors</p>
                <p>12345</p>
            </li>
        </ul>
        <!-- ################################################################################################ -->
    </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<?php echo $this->Html->script('jquery.min.js');?>
<?php echo $this->Html->script('jquery.backtotop.js');?>
<?php echo $this->Html->script('jquery.mobilemenu.js');?>
<?php echo $this->Html->script('jquery.flexslider-min.js');?>
</body>
</html>
