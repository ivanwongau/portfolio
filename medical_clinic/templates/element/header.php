<?php

use Cake\ORM\TableRegistry;

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes"/>
    <meta name="description" content="">
    <meta name="author" content="Louis">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Monash Health</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <script src="/team19/webroot/bootstrap5.0/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
            crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
    <!-- Bootstrap core CSS -->
    <link href="/team19/webroot/bootstrap5.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <meta name="theme-color" content="#7952b3">
    <!-- Custom styles for this template -->
   
    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="webroot/css/monashHealth-styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<header
    class="d-flex align-items-center justify-content-between justify-content-md-between py-2 mb-4 border-bottom container">

    <a href=<?= $this->Url->build(['controller' => 'MonashHealth', 'action' => 'index']); ?> class="d-flex
       align-items-center col-md-2 mb-2 mb-md-0 text-dark text-decoration-none">
        <div class="headerLogo" style="height:auto,width:auto">
            <?= $this->Html->image('monashHealth.png') ?>
        </div>
    </a>

    <?php if (!$this->Identity->isLoggedIn()) { ?>
        <ul class="nav col-8 col-md-auto mb-2 justify-content-center mb-md-0 flex">
            <li>
                <a href=<?= $this->Url->build(['controller' => 'MonashHealth', 'action' => 'index']); ?>  class="nav-link
                   px-2 link-secondary h3 text-center">Home</a></li>
        </ul>
    <?php } ?>

    <?php if ($this->Identity->isLoggedIn() and $this->Identity->get('role') === '3') { ?>
        <ul class="nav col-3 col-md-auto mb-2 justify-content-center mb-md-0 fs-3">
            <li>
                <a href=<?= $this->Url->build(['controller' => 'MonashHealth', 'action' => 'view']); ?>  class="nav-link
                   px-2 link-secondary h3 text-center">Home</a></li>
            <li>

                <?php
                // Searches for the clinician the user is assigned to
                $clientsQuery = TableRegistry::getTableLocator()->get('Clients');
                $userClient = $clientsQuery->find()->select([])
                    ->where(['user_id' => $this->Identity->get('id')])
                    ->first();

                if ($userClient != null) {

                    $clientsCliniciansQuery = TableRegistry::getTableLocator()->get('ClientsClinicians');
                    $clientsClinicians = $clientsCliniciansQuery->find()->select([])->where(['client_id' => $userClient->id])->first();

                    if ($clientsClinicians != null) {
                        $cliniciansQuery = TableRegistry::getTableLocator()->get('Clinicians');

                        $clinicianUser = $cliniciansQuery->find()->select([])->where(['id' => $clientsClinicians->clinician_id])->first();

                        if ($clinicianUser != null) {

                            ?>
                            <a href=<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $clinicianUser->user_id]); ?> class="nav-link
                               px-2 link-dark">My Clinician</a>

                        <?php } else { ?>
                            <a href="#" class="nav-link
                       px-2 link-dark disabled">My Clinician</a>
                        <?php }
                    } else { ?>
                    <a href="#" class="nav-link
                       px-2 link-dark disabled">My Clinician</a>
                <?php }
                } else {
                    ?>
                    <a href="#" class="nav-link
                       px-2 link-dark disabled">My Clinician</a>
                    <?php
                } ?>


            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    Log
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item fs-4"
                       href=<?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Medical Logs</a>
                    <a class="dropdown-item fs-4"
                       href=<?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Food Intake</a>
                </div>
            </li>
            <li><a href=<?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?> class="nav-link
                   px-2 link-dark">Goals</a></li>
            <li>
                <a href=<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile', $this->Identity->get('id')]); ?>  class="nav-link
                   px-2
                   link-dark">My Profile</a></li>

        </ul>
    <?php } ?>

    <?php if ($this->Identity->isLoggedIn() and $this->Identity->get('role') === '2') { ?>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li>
                <a href=<?= $this->Url->build(['controller' => 'MonashHealth', 'action' => 'view']); ?>  class="nav-link
                   px-2 link-secondary">Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    My Client
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'Clients', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Client</a>

                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Goals</a>
                </div>
            </li>

            <li>
                <a href=<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile', $this->Identity->get('id')]); ?>  class="nav-link
                   px-2
                   link-dark">My Profile</a></li>
        </ul>
    <?php } ?>

    <?php if ($this->Identity->isLoggedIn() and $this->Identity->get('role') === '1') { ?>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li>
                <a href=<?= $this->Url->build(['controller' => 'MonashHealth', 'action' => 'view']); ?>  class="nav-link
                   px-2 link-secondary">Home</a></li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Monitor
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'Clients', 'action' => 'overview']); ?> class="nav-link
                       px-2 link-dark">Clients</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'Clinicians', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Clinicians</a>
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'ClinicianQualifications', 'action' => 'view']); ?> class="nav-link
                       px-2 link-dark">Qualifications</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'clientsClinicians', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Client-Clinician Pairings</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    My Clients
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'Clients', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Clients</a>
                    <a class="dropdown-item"
                       href=<?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?> class="nav-link
                       px-2 link-dark">Goals</a>
                </div>
            </li>


            <li>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile', $this->Identity->get('id')]); ?>"
                   class="nav-link px-2
                   link-dark">My Profile</a></li>
        </ul>
    <?php } ?>

    <div class="col-md-3 text-end">
        <?php if (!$this->Identity->isLoggedIn()) {
            ?>
            <button onclick="location.href='<?= $this->Url->build(['controller' => 'users', 'action' => 'login']); ?> '"
                    type="button" class="btn btn-outline-primary me-2">Login
            </button>
            <?php
        }
        ?>
        <?php if ($this->Identity->isLoggedIn()) {
            ?>
            <button
                onclick="location.href='<?= $this->Url->build(['controller' => 'users', 'action' => 'logout']); ?> '"
                type="button" class="btn btn-outline-primary me-2">Logout
            </button>
            <?php
        }
        ?>
    </div>


    <style type=text/css>

       
        @media screen and (max-width:580px){
            .img{
                min-height:50%;
                min-width: 50%; 
            }
            .headerLogo{
            width:95px;
            height:28px;
            }
            
        }

       
        </style>

</header>


