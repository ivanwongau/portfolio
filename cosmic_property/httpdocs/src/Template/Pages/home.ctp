<?php $this->layout = 'flexstart'?>


<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h3>A home. An office. A building. A location.</h3>
                <h1 data-aos="fade-up">MAKING SPACES BETTER PLACES</h1>
                <p data-aos="fade-up" data-aos-delay="400">SPACE : an empty area that is available to be used.<br>PLACE: a portion of space designated or available for use.</p>

                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'aboutus']) ?>" class="btn-learn-more scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Learn more</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- End Hero -->

<!--<div class="wrapper row2">-->
<!--    <div class="hoc container clear">-->
<!--         ################################################################################################ -->
<!--        <ul class="nospace group figures">-->
<!--            <li class="one_third first">-->
<!--                <figure>--><?php //echo $this->Html->image('back4.png');?>
<!--                    <figcaption>--><?php //echo $this->Html->link('LONG TERM MAINTENANCE PLAN',['controller' => 'websites/ltmp']);?><!--</figcaption>-->
<!--                </figure>-->
<!--            </li>-->
<!--            <li class="one_third">-->
<!--                <figure>--><?php //echo $this->Html->image('back3.png');?>
<!--                    <figcaption>--><?php //echo $this->Html->link('APARTMENT REFURBISHMENT',['controller' => 'websites/aptrefur']);?><!--</figcaption>-->
<!--                </figure>-->
<!--            </li>-->
<!--            <li class="one_third">-->
<!--                <figure>--><?php //echo $this->Html->image('back5.png');?>
<!--                    <figcaption>--><?php //echo $this->Html->link('WAREHOUSE CONVERSION',['controller' => 'websites/wareconver']);?><!--</figcaption>-->
<!--                </figure>-->
<!--            </li>-->
<!--        </ul>-->
<!--        ################################################################################################ -->
<!--    </div>-->
<!--</div>-->


<section id="values" class="values">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <p>Our Services</p>
        </header>

        <div class="row">
            <div class="back figures col-lg-4 mt-4 mt-lg-0 col-md-6">
                <div class="box home-box" data-aos="fade-up" data-aos-delay="200">
                    <figure>
                        <img src="<?php echo $this->Url->build("/img/back4.png")?>" alt="">
                        <figcaption><?php echo $this->Html->link('LONG TERM MAINTENANCE PLAN',['controller' => 'websites/ltmp']);?></figcaption>
                    </figure>
                </div>
            </div>
            <div class="back figures col-lg-4 mt-4 mt-lg-0 col-md-6">
                <div class="box home-box" data-aos="fade-up" data-aos-delay="400">
                    <figure>
                        <img src="<?php echo $this->Url->build("/img/back3.png")?>" alt="">
                        <figcaption><?php echo $this->Html->link('APARTMENT REFURBISHMENT',['controller' => 'websites/aptrefur']);?></figcaption>
                    </figure>
                </div>
            </div>
            <div class="back figures col-lg-4 mt-4 mt-lg-0  col-md-6">
                <div class="box home-box" data-aos="fade-up" data-aos-delay="600">
                    <figure>
                        <img src="<?php echo $this->Url->build("/img/back5.png")?>" alt="">
                        <figcaption><?php echo $this->Html->link('WAREHOUSE CONVERSION',['controller' => 'websites/wareconver']);?></figcaption>
                    </figure>
                </div>
            </div>

        </div>
    </div>
    <!-- ################################################################################################ -->
</section>
<!-- End Services Section -->

<!-- ======= DescriptionsOfCompany Section ======= -->
<section id="desc" class="descriptionsOfCompany">

    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-4">
                <div class="box" data-aos="fade-up" data-aos-delay="200">
                    <img src="<?php echo $this->Url->build("/assets/img/values-1.png")?>" class="img-fluid" alt="">
                    <h3>EXPERIENCE</h3>
                    <p>We have experience across many construction sectors including but not limited too:<br> <br>
                         - Small Commercial Builds<br>
                         - Large Industrial Builds<br>
                         - Sporting Facilities Builds<br>
                         - Pavillion Refurbishments<br>
                         - Shop Front Remodelling and Refurbishment<br>
                         - Live Occupany Extentions & Refurbishments</p>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="box" data-aos="fade-up" data-aos-delay="400">
                    <img src="<?php echo $this->Url->build("/assets/img/values-3.png")?>" class="img-fluid" alt="">
                    <h3>HIGH QUALITY</h3>

                    <p>We pride ourselves in delivering quality products and services at all levels. Our philosophy which enables us to achieve this is simply this.<br><br>TAKING OWNERSHIP.<br></p>
                    <p>We take full ownership of your project as if it were ours. The question continually asked of ourselves is "would we accept this if it were ours?"</p>
                    <p>This mind set of "everything effects everything else" is the way in which we operate and conduct ourselves. We take what is yours very seriously and personally. </p>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="box" data-aos="fade-up" data-aos-delay="600">
                    <img src="<?php echo $this->Url->build("/assets/img/values-2.png")?>" class="img-fluid" alt="">
                    <h3>CREATIVITY</h3>
                    <p>We thrive in environments that challenge the norm, where creative concepts and ideas are at the forefront of design.<br> <br> Our mission is to deliver your vision in the most accurate form possible and bring into reality the image in your mind.<br><br> Applying creative solutions is our common practice.</p>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- End DescriptionsOfCompany Section -->


<!-- ======= Counts Section ======= -->
<section id="counts" class="counts">
    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <p>Our Guarantee</p>
        </header>

        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-award-fill"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="2328" data-purecounter-duration="1" class="purecounter"></span>
                        <p>COOPERATION</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #ee6c20;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="12345" data-purecounter-duration="1" class="purecounter"></span>
                        <p>CUSTOMERS</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-shop-window" style="color: #15be56;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                        <p>BRANCH</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-card-checklist" style="color: #bb0852;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                        <p>INSPECTORS</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

