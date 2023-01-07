<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Cosmic Property</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href=<?php echo $this->Url->build("/assets/img/logo1.png")?> rel="icon">
    <link href=<?php echo $this->Url->build("/assets/img/apple-touch-icon.png")?> rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href=<?php echo $this->Url->build("/assets/vendor/bootstrap/css/bootstrap.min.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/vendor/bootstrap-icons/bootstrap-grid.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/vendor/bootstrap-icons/bootstrap-icons.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/vendor/aos/aos.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/vendor/remixicon/remixicon.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/vendor/swiper/swiper-bundle.min.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/vendor/glightbox/css/glightbox.min.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/vendor/glightbox/css/glightbox.min.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css")?> >

    <!-- Template Main CSS File -->
    <link href=<?php echo $this->Url->build("/assets/css/style.css")?> rel="stylesheet">
    <link href=<?php echo $this->Url->build("/assets/css/custom.css")?> rel="stylesheet">

</head>





<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <?= $this->Flash->render()?>
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="<?php echo $this->Url->build('/') ?>" class="logo d-flex align-items-center">
            <img src="<?php echo $this->Url->build("/img/logo.png")?>" alt="">
<!--            <span>FlexStart</span>-->
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="<?php echo $this->Url->build('/') ?>">Home</a></li>
                <li class="dropdown"><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'inspection']) ?>"><span>Inspection</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'ltmp']) ?>">Long Term Maintenance Plan</a></li
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'bcr']) ?>">Building Condition Report</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href=" <?php echo $this->Url->build(['controller'=>'websites','action'=>'commercons']) ?>"><span>Commercial Construction</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'induscons']) ?>">Industrial Construction</a></li>
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'smallcommcons']) ?>">Small Commercial Construction</a></li>
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'ofitout']) ?>">Office Fit Out</a></li>
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'defit']) ?>">Office De Fit</a></li>
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'wareconver']) ?>">Warehouse Conversion</a></li>
                        <li><a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'aptrefur']) ?>">Apartment Refurbishment and Domestic Upgrade</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'projmana']) ?>">Project Management</a></li>
                <li><a class="nav-link scrollto" href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'aboutus']) ?>">About Us</a></li>
                <li><a class="nav-link scrollto" href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'contactus']) ?>">Contact Us</a></li>
                <li><a class="getstarted scrollto" href="<?php echo $this->Url->build(['controller'=>'Users','action'=>'login']) ?>">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->


<main id="main" style="margin-top: 115px">
    <?php echo $this->fetch('content')?>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="#" class="logo d-flex align-items-center">
                        <img src="/assets/img/logo.png" alt="">
                        <span>COSMIC PROPERTY</span>
                    </a><br>
                    <p>VBA REGISTERED BUILDING PRACTITIONER</p><br>
                    <figure><?php echo $this->Html->image('/img/vba.jpg',array('class'=>'borderedbox inspace-10 btmspace-15'));?></figure>

                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'pages','action'=>'home'])?>">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'aboutus'])?>">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'inspection']) ?>">Inspection</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'contactus']) ?>">Contact Us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'Users','action'=>'login']) ?>">Login</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'ltmp']) ?>">Long Term Maintenance Plan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'bcr']) ?>">Building Condition Report</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'induscons']) ?>">Industrial Construction</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'ofitout']) ?>">Office Fit Out</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'projmana']) ?>">Project management</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>

                    <p><i class="bi bi-geo-alt" style="color: #ee6c20;"></i>
                        &nbsp;501 Templestowe 3106 <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Melbourne<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Australia <br>
                        <strong><i class="bi bi-clock" style="color: #15be56;"></i></strong>&nbsp; Mon – Fri, 9am – 5pm<br>
                        <strong><i class="bi bi-telephone-forward-fill" style="color: #ee6c20;"></i></strong>&nbsp; +61 - 409 303 909<br>

                        <strong class="bi bi-chat-square-text-fill" style="color: #15be56;"></strong>&nbsp;&nbsp;damian@cosmicproperty.com.au
                    </p>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span> 2018 Cosmic Property</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src=<?php echo $this->Url->build("/assets/vendor/bootstrap/js/bootstrap.bundle.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/vendor/aos/aos.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/vendor/php-email-form/validate.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/vendor/swiper/swiper-bundle.min.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/vendor/purecounter/purecounter.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/vendor/isotope-layout/isotope.pkgd.min.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/vendor/glightbox/js/glightbox.min.js")?>></script>


<script src=<?php echo $this->Url->build("/assets/js/main.js")?>></script>
<script src=<?php echo $this->Url->build("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js")?>></script>
<script src=<?php echo $this->Url->build("https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js")?>></script>
<script src=<?php echo $this->Url->build("https://code.jquery.com/jquery-3.4.1.min.js")?>></script>

</body>

</html>
