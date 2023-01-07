<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Database\StatementInterface $error
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;
use Cake\Error\Debugger;


// $this->layout = 'error';

 ?>
    <div class="container" style="margin-top: 200px;">
        <h1 class="d-flex justify-content-center" ><?= __d('cake', 'An Internal Error Has Occurred') ?></h2>
        <h3 class="error d-flex justify-content-center">
            <strong><?= __d('cake', 'Error') ?>: </strong>
            <?= h($message) ?>
        </h3>
    </div>

<?php?>

<?php 
    
    ?>
     <!-- FOOTER -->
     <!-- Footer -->
     <div class="container">
        <footer id="myFooter " class=" footer font-small bg-info d-flex align-items-center justify-content-between justify-content-md-between py-2 mb-4 border-bottom container" style="bottom: 0;">
        <!-- :root{--wp-admin-theme-color:#007cba;--wp-admin-theme-color-darker-10:#006ba1;--wp-admin-theme-color-darker-20:#005a87} -->
        <!-- Footer Links -->
        <div class="container text-center text-md-left text-white">

            <!-- Grid row -->
            <div class="row">

            <!-- Grid column -->
            <div class="col-md-4 mx-auto">

                <!-- Content -->
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4 text-white">Monash Health</h5>
                <p class="text-white">Monash Health acknowledges the Traditional Custodians of the land, the Wurundjeri and Boonwurrung peoples, and we pay our respects to them, their culture and their Elders past, present and future.</p>

            </div>
            <!-- Grid column -->

            <div class="col-md-3 mx-auto">

                <!-- Links -->
                <h5 class="text-white text-uppercase mt-3 mb-4">Location</h5>
              
                <ul class=" text-white" style="width:100%">
                <li>
                    <a href="https://monashhealth.org/contact/monash-medical-centre/" class="text-white font-weight-bold">Monash Medical Centre</a>
                </li>
                <li>
                    <a href="https://monashhealth.org/contact/casey-hospital/" class="text-white font-weight-bold">Casey Hospital</a>
                </li>
                <li>
                    <a href="https://monashhealth.org/contact/dandenong-hospital" class="text-white font-weight-bold">Dandenong Hospital</a>
                </li>
                <li>
                    <a href="https://monashhealth.org/contact/monash-childrens-hospital/" class="text-white font-weight-bold">Monash Children’s Hospital</a>
                </li>
                </ul>
            </div>

            <hr class="clearfix w-100 d-md-none">


            </div>
        </div>

        <hr>

    
        </footer>
        <!-- Footer -->
    </div>

        <style type=text/css>

        .footer {   
            position: fixed;
            /* height: 100px; */
            bottom: 0;
            width: 100%;
            background-color: #153C80 !important;
        }
       



        </style>

    
<?php?>


