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
                            <h2>About Us</h2>
                            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url('/')?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- about section start -->
    <section class="about-section three-image about_page animated-section section-b-space">
        <div class="container">
            <div class="title-3">
                <span class="title-label">CheckIn And CheckOut</span>
                <h2>About Us<span>About Us</span></h2>
            </div>
            <div class="row">
                <div class="col-xl-7">
                    <div class="ticket-box">
                        <div class="image-box">
                            <img src="<?= base_url('assets/images/about.png')?>" class="img-fluid blur-up lazyloaded" alt="">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#video" class="video-icon" tabindex="0">
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="about-text">
                        <div>
                            <div class="title-3">
                                <span class="title-label">introduction</span>
                            </div>
                            <h2>welcome to<br>checkinandcheckout.com </h2>
                            <p>CheckIn and CheckOut is a hotel booking and stay platform. You can search hotels form our plateform at your needy place and book your sutaible stay.</p>
                            <img src="../assets/images/mix/signature.png" class="img-fluid blur-up lazyload" alt="">
                            <div class="buttons-about">
                                <a href="#know-more" class="btn btn-lower btn-curve">Know More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->
    
    <!-- video modal -->
    <div class="modal fade video-modal" id="video" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                        <iframe src="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/checkinandcheckoutdotcom/videos/1284867102035104/" width="738" height="500" allowFullScreen="true"></iframe>
                    <!--<iframe src="https://www.youtube.com/embed/ezuKIzXJuz8" allowfullscreen></iframe>-->
                </div>
            </div>
        </div>
    </div>
    <!-- video modal -->

    <!--  team section start -->
    <!--<section class="team-section animated-section section-b-space">-->
    <section class="team-section animated-section section-b-space bg-size blur-up lazyloaded" style="background-image: url(&quot;<?= base_url('assets/images/cab/grey-bg.jpg')?>&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
        <div class="container">
            <div class="title-1">
                <span class="title-label">Awesome Teams</span>
                <h2>our team</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="team-box">
                        <div class="img-part">
                            <img src="<?= base_url('assets/uploads/teams/member_1.jpg')?>"
                                class="img-fluid blur-up lazyload" alt="">
                        </div>
                        <div class="team-content">
                            <h3>Ravi Narayan Singh</h3>
                            <h6>Founder and MD</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-box">
                        <div class="img-part">
                            <img src="<?= base_url('assets/uploads/teams/member_2.jpg')?>"
                                class="img-fluid blur-up lazyload" alt="">
                        </div>
                        <div class="team-content">
                            <h3>Shashwat Kumar Kishan</h3>
                            <h6>Co-Founder and CEO</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-box">
                        <div class="img-part">
                            <img src="<?= base_url('assets/uploads/teams/member_3.jpg')?>"
                                class="img-fluid blur-up lazyload" alt="">
                        </div>
                        <div class="team-content">
                            <h3>Rajnish Ranjan</h3>
                            <h6>CTO</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team section end -->

    <!--  about section start -->
    <section class="team-section animated-section section-b-space" id="know-more">
        <div class="container">
            <div class="title-1 title-5">
                <span class="title-label">Know More About</span>
                <h2>CheckIn and CheckOut</h2>
                <p>You Want it. Then Get It... Stay in Free and Affordable Hotels</p>
            </div>
            <div class="row">
                <div class="col">
                    <ul>
				        <li style="font-weight:bolder;">Stay in Free and Affordable Hotels</li>
				            <p class="text-dark">
				                Heard Right. For the very first time We Advocate Credit Pay. Come & Pay..maybe. You get seemless experience in your neighbourhood city hotels in your own budget. 
				            </p>
				       
				       <li style="font-weight:bolder;">You are controller Of Your Stay and Pay</li>
				           <p class="text-dark">
				               Yes. you got to decide and choose the duration of your stay and pay for that only. We offer short stay hotels. Why pay for more when less is more ? 
				           </p>
				       <li style="font-weight:bolder;">Short Stay time-Slot</li>
				           <p class="text-dark">
				               Power stay – 3 hour<br><br> 6 hour stay <br><br>Fixed Hour Stay- 12 Pm – 11 am
				           </p>
				       <li style="font-weight:bolder;">Trust is Paramount</li>
				           <p class="text-dark">
				               You trust us for your privacy we trust CheckIn and CheckOut. Especially for couples to ease their mood . Professionalism is checked at every process. No chance of complain from our customers. 
				           </p>
				       
				       <li style="font-weight:bolder;">How Is It possible?</li>
				           <p class="text-dark">
				               Well we want to create a safe and secure environment for couples in the judgemental society. And it’s upon us. All you got to do is carry your original local Id’s and welcome sir and madam . 
				           </p>
				       
				       <li style="font-weight:bolder;">Do Not Comprimise</li>
				           <p class="text-dark">
				               Now you don’t have to delay your plan because of cash and place. We provide you super affordable stay anytime and anywhere.
				           </P>
				       <li style="font-weight:bolder;">Easy checkIn and checkOut</li>
				           <p class="text-dark">
				               Easy to book online, no clutter and clean rooms with a good meal. Proper sanitation before you and friendly hotels to give the best. 
				           </p>
				           <p class="text-dark">
				               We Are Getting Started Public…..Rush to avail Offers. 
				           </p>
				           <p class="text-dark">
				               Questions our customers Have 
				           </p>
				           <p class="text-dark">
				               Are the CheckIn and CheckOut hotels safe ?
				           </p>
				           <p class="text-dark">
				               What are the payment options available while booking in checkIn and checkout ?
				           </p>
				           <p class="text-dark">
				               Do both the Partners need to Have their Id’s. 
				           </p>
				       
				    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- team section end -->



<?php include('includes/footer.php') ?>
<?php include('includes/scripts.php') ?>

</body>

</html>