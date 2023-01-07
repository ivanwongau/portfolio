<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cosmic Property</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src=<?php echo $this->Url->build("https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js")?>></script>
    	<script src=<?php echo $this->Url->build("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js")?>></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">


    <!-- Favicon icon -->
    <link href=<?php echo $this->Url->build("/assets/img/logo1.png")?> rel="icon">
    <!-- font css -->
    <link rel="stylesheet" href=<?php echo $this->Url->build("/assets/fonts/feather.css")?>>
    <link rel="stylesheet" href=<?php echo $this->Url->build("/assets/fonts/fontawesome.css")?>>
    <link rel="stylesheet" href=<?php echo $this->Url->build("/assets/fonts/material.css")?>>
    <link rel="stylesheet" href=<?php echo $this->Url->build("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css")?>>
    <!-- vendor css -->
    <link rel="stylesheet" href=<?php echo $this->Url->build("/assets/css/style1.css")?>>

</head>

<body class="">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Mobile header ] start -->
<div class="pc-mob-header pc-header">
    <div class="pcm-logo">
        <a href="<?php echo $this->Url->build(['controller'=>'pages','action'=>'home']) ?>"> <img src=<?php echo $this->Url->build("/assets/img/logo_lg.png")?> alt="Home" class="logo logo-lg"></a>
    </div>
    <div class="pcm-toolbar">
        <a href="#!" class="pc-head-link" id="mobile-collapse">
            <div class="hamburger hamburger--arrowturn">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>

        <a href="#!" class="pc-head-link" id="header-collapse">
            <i data-feather="more-vertical"></i>
        </a>
    </div>
</div>
<!-- [ Mobile header ] End -->

<!-- [ navigation menu ] start -->
<nav class="pc-sidebar ">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="<?php echo $this->Url->build(['controller'=>'pages','action'=>'home']) ?>" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src=<?php echo $this->Url->build("/assets/img/logo_lg.png")?> alt="" class="logo logo-lg">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Properties</label>
                </li>
                <li class="pc-item">
                    <a href="<?php echo $this->Url->build(['controller'=>'properties','action'=>'buildinglist']) ?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">home</i></span><span class="pc-mtext">Buildings</span></a>
                </li>

                <?php if($user->role=='admin'){?>
                <li class="pc-item pc-caption">
                    <label>Information</label>
                    <!--						<span>UI Components</span>-->
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'index']) ?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">business_center</i></span><span class="pc-mtext">Users</span></a>
                </li>
                <li class="pc-item">
                    <a href="<?php echo $this->Url->build(['controller'=>'subscriptions','action'=>'index']) ?>" class="pc-link" ><span class="pc-micon"><i class="material-icons-two-tone">history_edu</i></span><span class="pc-mtext">Subscription</span></a>
                </li>
                
                <!--					<li class="pc-item pc-caption">-->
                <!--						<label>Forms</label>-->
                <!--					</li>-->
                <!--					<li class="pc-item pc-hasmenu">-->
                <!--						<a href="#!" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">edit</i></span><span class="pc-mtext">Forms Elements</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>-->
                <!--					</li>-->
                <li class="pc-item pc-caption">
                    <label>Users' enquiry</label>
                </li>
                <li class="pc-item">
                    <a href="<?php echo $this->Url->build(['controller'=>'Enquiries','action'=>'index']) ?>" class="pc-link" ><span class="pc-micon"><i class="material-icons-two-tone">bubble_chart</i></span><span class="pc-mtext">Enquiries</span></a>
                </li>
                <li class="pc-item pc-caption">
                    <label>User Permissions</label>
                    <span>View & delete</span>
                </li>
                <li class="pc-item">

                    <a href="<?php echo $this->Url->build(['controller'=>'PropertiesUsers','action'=>'index']) ?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">table_rows</i></span><span class="pc-mtext">Access Control</span></a>
                </li>

                <li class="pc-item">

                <a href="<?php echo $this->Url->build(['controller'=>'DashboardRename','action'=>'index']) ?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">table_rows</i></span><span class="pc-mtext">Rename Center</span></a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="pc-header ">
    <div class="header-wrapper">
        <?= $this->Flash->render()?>
        <div class="ml-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
<!--                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">-->
<!--                        <i class="material-icons-two-tone">search</i>-->
<!--                    </a>-->
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown drp-search">
                        <form class="px-3">
                            <div class="form-group mb-0 d-flex align-items-center">
                                <i data-feather="search"></i>
                                <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
                            </div>
                        </form>
                    </div>
                </li>
                <li class="pc-h-item">
                    <a class="pc-head-link me-0" href="<?php echo $this->Url->build(['controller' => 'users','action' => 'notification']) ?>"
                       data-bs-toggle="modal" data-bs-target="#notification-modal">
                        <i class="material-icons-two-tone">notifications_active</i>
                        <span class="bg-danger pc-h-badge dots"><span class="sr-only"></span></span>
                    </a>
                </li>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src=<?php echo $this->Url->build("/assets/img/user/profile.png")?> alt="user-image" class="user-avtar">
                        <span>
								<span class="user-name"><?= h($user->first_name) .' '.h($user->last_name) ?></span>
							</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <a href=" <?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>" class="dropdown-item">
                            <i class="material-icons-two-tone">account_circle</i>
                            <span>Profile</span>
                        </a>
                        <a href="<?php echo $this->Url->build(['controller' => 'users/logout'],array('class'=>'dropdown-item','escape'=>false))?>" class="dropdown-item">
                            <i class="material-icons-two-tone">chrome_reader_mode</i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>
            </ul>
        </div>

    </div>
</header>


<?php echo $this->fetch('content')?>


<!-- Warning Section Ends -->
<!-- Required Js -->
<script src=<?php echo $this->Url->build("/assets/js/vendor-all.min.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/js/plugins/bootstrap.min.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/js/plugins/feather.min.js")?>></script>
<script src=<?php echo $this->Url->build("/assets/js/pcoded.min.js")?>></script>



</body>

</html>
