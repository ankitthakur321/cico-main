<?php include('includes/header.php')?>
<?php include('includes/navbar.php')?>

    <!-- breadcrumb start -->
    <section class="breadcrumb-section flight-sec animation-bg pt-0">
        <img src="https://checkinandcheckout.com/old/assets/images/slider-2.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-right breadcrumb-content  pt-0">
                        <div>
                            <h2>Contact Us</h2>
                            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url('/')?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

     <!-- contact detail section start -->
    <section class="contact_section small-section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="contact_wrap">
                        <div class="title_bar">
                            <i class="fas fa-map-marker-alt"></i>
                            <h4>Address</h4>
                        </div>
                        <div class="contact_content">
                            <p>Patna, Bihar, India</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="contact_wrap">
                        <div class="title_bar">
                            <i class="fas fa-envelope"></i>
                            <h4>email address</h4>
                        </div>
                        <div class="contact_content">
                            <ul>
                                <li>support@checkinandcheckout.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="contact_wrap">
                        <div class="title_bar">
                            <i class="fas fa-phone-alt"></i>
                            <h4>phone</h4>
                        </div>
                        <div class="contact_content">
                            <ul>
                                <li>+91-9153900180</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact detail section end -->


    <!-- get in touch section start -->
    <section class="small-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="get-in-touch">
                        <h3>get in touch</h3>
                        <?php

                            if($this->session->flashdata('status')) {
                            $message = $this->session->flashdata('status');
                        ?>
                            <div class="mt-5 <?php echo $message['class'] ?> fade show" role="alert">
                                <?php echo $message['message']; ?>    
                            </div>
                        <?php
                            }
                        ?>
                        <form method="POST" action="<?=site_url('home/sendMessage')?>">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" required="required">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="email address" required="required">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input class="form-control" id="subject" name="subject" type="text" placeholder="subject" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" placeholder="Write Your Message"
                                        id="Message" name="message" rows="6"></textarea>
                                </div>
                                <div class="col-md-12 submit-btn">
                                    <button class="btn btn-solid" type="submit">Send Your Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115133.01016842092!2d85.0730025389232!3d25.608020764526835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f29937c52d4f05%3A0x831a0e05f607b270!2sPatna%2C%20Bihar!5e0!3m2!1sen!2sin!4v1650540137706!5m2!1sen!2sin" allowfullscreen></iframe>
                        <!--<iframe-->
                        <!--    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583091352!2d-74.11976373946229!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1563449626439!5m2!1sen!2sin"-->
                        <!--    allowfullscreen></iframe>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- get in touch section end -->





<?php include('includes/footer.php') ?>
<?php include('includes/scripts.php') ?>

</body>

</html>