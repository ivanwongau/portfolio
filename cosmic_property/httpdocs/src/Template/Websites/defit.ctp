<?php $this->layout = 'flexstart' ?>
<section id="inspection" class="inspection d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">DE FIT</h1>
            </div>
        </div>
        <div class="col-lg-6 inspection-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="img/ins.jpg" class="img-fluid" alt="">
        </div>
    </div>
    </div>
</section>



<section id="about" class="about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0">
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h2>DE FIT</h2>
                    <p> The renting time of your office or shop has ended and want to move to another place? We got your back,
                        with our office de fit service. Office defits is to return the office spaces back to ‘base build’.

                            Shop defits allows a new shop owner to configure the layout of the shop to their requirements in terms of layout and design.
                            Shop defits are an essential part of a new shop business.
                            With our service we offer a full professional building service and will strip out and refit your office or shop in no time.
                        </p>
                </div>
            </div>
            <!--            align-items-center-->
            <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                <img src="../webroot/img/defit.jpg" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>

<section id="recent-blog-posts" class="recent-blog-posts">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6">
                <div class="post-box" >
                    <a href="<?php echo $this->Url->build(['controller'=>'websites','action'=>'contactus']) ?>"
                       class="readmore stretched-link mt-auto"><span>Contact Us</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="post-box" style="display: none">
                </div>
            </div>
        </div>
    </div>
</section><!-- End Recent Blog Posts Section -->

