<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
    <meta name="description" content="">
    <meta name="author" content="Louis">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Monash Health</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <script src="/team19/webroot/bootstrap5.0/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link href="/team19/webroot/bootstrap5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="/team19/webroot/css/carousel.css" rel="stylesheet">

    <meta name="theme-color" content="#7952b3">
</head>

<body class="pt-2">
<!-- header -->
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
           <!-- <img src="/team19/webroot/img/monashHealth.png" alt="MONASH HEALTH" style="heigh:20%;width:40%"/>-->

            <?= $this->html->image('monashHealth.png',['alt'=>'MONASH HEALTH','style'=>'height:20%;width:40%'])?>

        </a>

        <div class="col-md-3 text-end">
            <button onclick="location.href='<?= $this->Url->build(['controller'=>'users','action'=>'login']);?> '" type="button" class="btn btn-outline-primary me-2">Login</button>
        </div>
    </header>
    <body class="pt-2">
    <main>

            <!-- START THE FEATURETTES -->

            <div class="row">
                <div class="col-md-7 p-0">
                    <h2 class="p-0">Monash Medical Centre</h2>
                    <p class="lead">Monash Medical Centre is a 640 bed teaching and research hospital of international standing providing a comprehensive range of specialist surgical, medical, allied health and mental health services to our community.</p>
                    <h4><a href="tel:+61395946666"><i class="fas fa-phone"></i> (03) 9594 6666</a></h4>
                    <h4><a href="https://goo.gl/maps/LWanty2JgzpV26it5" target="_blank"><i class="fas fa-map-marker"></i> 246 Clayton Road,Clayton VIC 3168</a></h4>
                </div>
                <div class="col-md-5">
                    <!--<img src="/team19/webroot/img/MMC1.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" />-->
                    <?= $this->html->image('MMC1.jpg',['class'=>'bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto','width'=>'500','height'=>'500'])?>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="">Casey Hospital</h2>
                    <p class="lead">Casey Hospital is a 229 bed hospital providing a comprehensive range of health services for the rapidly growing communities of Melbourne’s outer-east.</p>
                    <h4><a href="tel:+61387681200"> <i class="fas fa-phone"></i> +61 3 8768 1200</a></h4>
                    <h4><a href="https://goo.gl/maps/8tfaBpPQ8qzDzPui6" target="_blank"> <i class="fas fa-map-marker"></i> 62-70 Kangan Drive,Berwick 3806</a></h4>
                </div>
                <div class="col-md-5 order-md-1">
                    <!--<img src="/team19/webroot/img/MMC2.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" />-->
                    <?= $this->html->image('MMC2.jpg',['class'=>'bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto','width'=>'500','height'=>'500'])?>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="">Dandenong Hospital</h2>
                    <p class="lead">Dandenong Hospital is a 520 bed acute hospital providing a wide range of health services to the people living and working in Dandenong and surrounding areas.</p>
                    <h4><a href="tel:+61395541000"><i class="fas fa-phone"></i> +61 3 9554 1000</a></h4>
                    <h4><a href="https://goo.gl/maps/frVUECFieMFycLsv9" target="_blank"> <i class="fas fa-map-marker"></i> 135 David Street,Dandenong 3175</a></h4>

                </div>
                <div class="col-md-5">
                    <!--<img src="/team19/webroot/img/MMC3.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" />-->
                    <?= $this->html->image('MMC3.jpg',['class'=>'bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto','width'=>'500','height'=>'500'])?>
                </div>
            </div>
            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="">Monash Children’s Hospital </h2>
                    <p class="lead">Monash Children’s Hospital, part of Monash Health, is one of Australia’s leading providers of integrated children’s health services, with more than 30 specialist services and programs.</p>
                    <h4><a href="tel:+61385723000"><i class="fas fa-phone"></i> (03) 8572 3000</a></h4>
                    <h4><a href="https://goo.gl/maps/vL1XUdomVh11R1V47" target="_blank"><i class="fas fa-map-marker"></i> 246 Clayton Road,Clayton VIC 3168</a></h4>
                </div>

                <div class="col-md-5 order-md-1">
                    <!--<img src="/team19/webroot/img/MMC4.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" />-->
                    <?= $this->html->image('MMC3.jpg',['class'=>'bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto','width'=>'500','height'=>'500'])?>
                </div>
            </div>

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="d-flex justify-content-center" style="padding-top:100px">
            <?= $this->element('rooter'); ?>

        </footer>
    </main>


    </body>


    <script language=javascript>
        .clearfix {
            display: inline-block;
        }
        .header{ width:100%; margin:0px auto; position:relative; border-top:8px solid #000;}
        .header .head{ width:1100px; margin:0px auto; height:100px;}
        .head .logo{ width:227px; height:65px; float:left; margin-top:17px;}
        .head .logo img{ width:227px; height:65px; vertical-align:top;}
        .head .nav_m{ width:850px; float:right; text-align:right; position:relative;}
        .head .nav{ width:100%; text-align:right;}
        .head .nav li{ display:inline-block; *display:inline; zoom:1; height:35px; margin-top:32px; margin-left:95px;}
        .head .nav li a{ font-size:16px; color:#333333; display:inline-block; *display:inline; zoom:1; height:35px; line-height:35px;}
        .head .nav li.now a,.head .nav li:hover a{ color:#C93F24;}
    </script>


