<?php $this->layout = 'flexstart' ?>

<section id="contactus" class="contactus d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Contact Us</h1>
            </div>
        </div>
        <div class="col-lg-6 contactder-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="" class="img-fluid">
        </div>
    </div>
    </div>
</section>

<section id="contact" class="contact">

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>WE LOVES GETTING CUSTOMER EMAILS!</h2>
            <p>MAKE OUR DAY AND FILL OUR INBOX WITH COMMENTS AND QUESTIONS.</p>
        </header>
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-geo-alt"></i>
                            <h3>PO BOX</h3>
                            <p>501 TEMPLESTOWE 3106</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>+61 - 409 303 909</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>damian@cosmicproperty.com.au<br/><br/></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-clock"></i>
                            <h3>OPENING HOUR</h3>
                            <p>MONDAY - SATURDAY<br>7AM - 6PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <?php
                    date_default_timezone_set("Australia/Melbourne");
                    ?>
                    <div class="row gy-4">
                        <?= $this->Form->create(null, ['id'=>'Enquire','type' => 'post', 'url' => ['controller' => 'enquiries', 'action' => 'add']]) ?>
                        <div class="col-md-6">
                            <?= $this->Form->control('name', ['class' => 'form-control', 'required' => 'true']); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('temp_email', ['class' => 'form-control', 'label' => 'Email', 'required' => 'true', 'type' => 'email']); ?>
                        </div>
                        <div class="col-md-12">
                            <label for="topic">Topic</label>
                            <?= $this->Form->select('topic', [
                                'General enquiries' => 'General enquiries',
                                'Quote' => 'Quote',
                                'Inspection' => 'Inspection',
                                'Commercial Construction' => 'Commercial Construction',
                                'Project management' => 'Project management'], ['class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-12">
                            <br/>
                            <?= $this->Form->control('message', ['id' => 'comment', 'type' => 'textarea', 'class' => 'form-control', 'label' => 'Body', 'required' => 'true']); ?>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="error-message"></div>
                            <?php echo $this->Form->hidden('status', ['value' => 'open']); ?>
                            <br>
                            <?= $this->Recaptcha->display() ?>
                            <br>

                            <?= $this->Form->button('Submit', ['class' => 'btn btn-shadow btn-success']); ?>
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



