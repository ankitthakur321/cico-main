<?php include('includes/header.php')?>
<?php include('includes/navbar.php')?>
<?php include('includes/search-bar.php')?>

    
    <!-- recommanded section start -->
    <section>
        <div class="tourSection ratio3_2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title-1">
                            <span class="title-label rounded20">we recommend best for you</span>
                            <h2 class="pt-0">Recommended Hotels</h2>
                        </div>
                        <div class="row">
                            <?php foreach($recommendedHotels as $rHotel):; ?>
						    <div class="col-lg-4">
                                <div class="room-wrapper">
                                    <div class="room-inner">
                                        <div class="room" id="rooms">
                                            <figure>
                                                <img src="<?=base_url($rHotel['hotel_image'])?>" alt="Website Image" style="height:35vh">
                                            </figure>
                                            <div class="caption">
                                                <div class="txt1"><?=$rHotel['hotel_name']?></div>
                                                <div class="txt2">
                                                    <div class="small-stars">
                                                        <?php  $hotelRating = $rHotel['rating'];  
                                                                $i=0;
                                                                while($i<5)
                                                                {
                                                                    if($i < $hotelRating)
                                                                        echo "<i class='fas fa-star'></i>";
                                                                    else
                                                                        echo "<i class='far fa-star'></i>";
                                                                    $i++;
                                                                }
                            								                     
                            							 ?>
                                                    </div>                                          
                                                </div>
                                                <div class="txt3 text-truncate">
                                                    <?=$rHotel['hotel_address']?>                                                
                                                </div>
                                            </div>
                                            <div class="select-txt">
                                                <a href="<?=base_url('hotels/hoteldetails/').$rHotel['id']?>"><span>BOOK THIS ROOM<i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                                            </div>
                                            <div class="room-icons">
                                                <div class="room-ic room-ic-breakfast" style="padding-top:0px;">
                                                    <!--<i class="fa fa-wifi" aria-hidden="true"></i>-->
                                                    <img aria-hidden="true" src="<?=base_url('assets/images/wifi.gif')?>" width="71px" alt="Website Image">
                                                    <div class="txt1">FREE WIFI</div>
                                                </div>
                                                <div class="room-ic room-ic-person">
                                                    <?php   $i=0;
                                                            $allowed = $allowedPersons($rHotel['id']);
                                                            while($i < $allowed)
                                                            {
                                                                echo "<i class='fa fa-user' aria-hidden='true'></i>";
                                                                $i++;
                                                            }
                                                    ?>                                                   
                                                    <div class="txt1">MAX<br>PERSON</div>
                                                </div>
                                                <div class="room-ic room-ic-breakfast" style="padding-top: 0px;">
                                                    <!--<i class="fa fa-coffee" aria-hidden="true"></i>-->
                                                    <img aria-hidden="true" src="<?=base_url('assets/images/icon/icon_gif/tea.gif')?>" width="71px" alt="Website Image">
                                                    <div class="txt1">BREAKFAST<br><?=$breakfastIncluded($rHotel['id'])?></div>
                                                </div>
                                                <div class="room-price">
                                                     <?php if($hotelPrice($rHotel['id']) != 'N/A') { echo "<div class='txt1'>₹ <span>".$hotelPrice($rHotel['id'])."</span></div><div class='txt2'>PER NIGHT</div>"; } else { echo "<div class='txt1'>N/A</div>"; } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="label-offer">Recommended</div>-->
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                        </div>
                        <!--row end-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- recommanded section end -->
    
    
    <!-- Top Hotels section start -->
    <section class="pt-3">
        <div class="tourSection ratio3_2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title-1 pb-5">
                            <h2 class="pb-2">Top Hotels</h2>
                            <span class="title-label rounded20">Top trending hotes on our site</span>
                        </div>
                        <div class="row">
                            <?php foreach($topHotels as $tHotel):; ?>
						        <div class="col-lg-4">
                                <div class="room-wrapper">
                                    <div class="room-inner">
                                        <div class="room" id="rooms">
                                            <figure>
                                                <img src="https://www.checkinandcheckout.com/<?=$tHotel['hotel_image']?>" alt="" style="height:35vh" alt="Website Image">
                                            </figure>
                                            <div class="caption">
                                                <div class="txt1"><?=$tHotel['hotel_name']?></div>
                                                <div class="txt2">
                                                    <div class="small-stars">
                                                        <?php  $hotelRating = $tHotel['rating'];  
                                                                $i=0;
                                                                while($i<5)
                                                                {
                                                                    if($i < $hotelRating)
                                                                        echo "<i class='fas fa-star'></i>";
                                                                    else
                                                                        echo "<i class='far fa-star'></i>";
                                                                    $i++;
                                                                }
                            								                     
                            							 ?>
                                                    </div>                                          
                                                </div>
                                                <div class="txt3 text-truncate">
                                                    <?=$tHotel['hotel_address']?>                                                
                                                </div>
                                            </div>
                                            <div class="select-txt">
                                                <a href="<?=base_url('hotels/hoteldetails/').$tHotel['id']?>"><span>BOOK THIS ROOM<i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                                            </div>
                                            <div class="room-icons">
                                                <div class="room-ic room-ic-breakfast" style="padding-top:0px;">
                                                    <!--<i class="fa fa-wifi" aria-hidden="true"></i>-->
                                                    <img aria-hidden="true" src="https://checkinandcheckout.com/assets/images/wifi.gif" width="71px" alt="Website Image">
                                                    <div class="txt1">FREE WIFI</div>
                                                </div>
                                                <div class="room-ic room-ic-person">
                                                    <?php   $i=0;
                                                            $allowed = $allowedPersons($tHotel['id']);
                                                            while($i < $allowed)
                                                            {
                                                                echo "<i class='fa fa-user' aria-hidden='true'></i>";
                                                                $i++;
                                                            }
                                                    ?>                                                   
                                                    <div class="txt1">MAX<br>PERSON</div>
                                                </div>
                                                <div class="room-ic room-ic-breakfast" style="padding-top: 0px;">
                                                    <!--<i class="fa fa-coffee" aria-hidden="true"></i>-->
                                                    <img aria-hidden="true" src="<?=base_url('assets/images/icon/icon_gif/tea.gif')?>" width="71px" alt="Website Image">
                                                    <div class="txt1">BREAKFAST<br><?=$breakfastIncluded($tHotel['id'])?></div>
                                                </div>
                                                <div class="room-price">
                                                     <?php if($hotelPrice($tHotel['id']) != 'N/A') { echo "<div class='txt1'>₹ <span>".$hotelPrice($tHotel['id'])."</span></div><div class='txt2'>PER NIGHT</div>"; } else { echo "<div class='txt1'>N/A</div>"; } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="label-offer">Top Hotels</div>-->
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <!--row end-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Hotels section end -->


    <!-- tour section start -->
    <section class="section-b-space">
        <div class="tourSection ratio_asos">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title-1">
                            <h2 class="pt-0">Most Popular Cities</h2>
                        </div>
                        <div class="slide-6 no-arrow">
                            <div>
                                <a href="<?=site_url('hotels/hotelslist')?>?location=Patna">
                                    <div class="tourBox wow zoomIn">
                                        <div class="tourImg">
                                            <img src="<?=base_url('assets/images/tour/vector/patna.jpg')?>"
                                                class="img-fluid blur-up lazyload bg-img" alt="Website Image">
                                        </div>
                                        <div class="tourContent">
                                            <h3>Patna</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="<?=site_url('hotels/hotelslist')?>?city=Delhi">
                                    <div class="tourBox wow zoomIn">
                                        <div class="tourImg">
                                            <img src="<?=base_url('assets/images/hotel/delhi.jpg')?>"
                                                class="img-fluid blur-up lazyload bg-img" alt="Website Image">
                                        </div>
                                        <div class="tourContent">
                                            <h3>Delhi</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="<?=site_url('hotels/hotelslist')?>?city=Kolkata">
                                    <div class="tourBox wow zoomIn">
                                        <div class="tourImg">
                                            <img src="<?=base_url('assets/images/hotel/kolkata.jpg')?>"
                                                class="img-fluid blur-up lazyload bg-img" alt="Website Image">
                                        </div>
                                        <div class="tourContent">
                                            <h3>Kolkata</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="<?=site_url('hotels/hotelslist')?>?city=Mumbai">
                                    <div class="tourBox wow zoomIn">
                                        <div class="tourImg">
                                            <img src="<?=base_url('assets/images/hotel/mumbai.jpg')?>"
                                                class="img-fluid blur-up lazyload bg-img" alt="Website Image">
                                        </div>
                                        <div class="tourContent">
                                            <h3>Mumbai</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tour section end -->


    <!-- how to start section start -->
    <section class="small-section process-steps icon-large">
        <img src="<?=base_url('assets/images/tour/background/15.jpg')?>" class="bg-img img-fluid blur-up lazyload" alt="Website Image">
        <div class="container">
            <div class="title-1 detail-title">
                <h2 class="pt-0">Super Easy Booking</h2>
            </div>
            <div class="step-bg">
                <div class="row">
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="<?=base_url('assets/images/tour/vector/13.png')?>"
                                    class="img-fluid blur-up lazyload filter-none" alt="Website Image">
                                <h4>explore</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="<?=base_url('assets/images/tour/vector/14.png')?>"
                                    class="img-fluid blur-up lazyload filter-none" alt="Website Image">
                                <h4>Get Quotes</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="<?=base_url('assets/images/tour/vector/15.png')?>"
                                    class="img-fluid blur-up lazyload filter-none" alt="Website Image">
                                <h4>customize</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="<?=base_url('assets/images/tour/vector/16.png')?>"
                                    class="img-fluid blur-up lazyload filter-none" alt="Website Image">
                                <h4>book & enjoy</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- how to start section end -->
    
    <!-- section start -->
    <section class="about-section section-b-space bg-white">
        <div class="container">
            <div class="title-3">
                <span class="title-label rounded20">100% SAFE TO STAY</span>
                <h2><a class="text-dark" href="https://www.cowin.gov.in" target="_blank" rel="noopener">COVID-19 Safety Precautions</a></h2>
            </div>
            <div class="highlight-section">
                <div class="row">
                    <div class="col-xl-3 col-6">
                        <a class="text-dark" href="https://www.cowin.gov.in" target="_blank" rel="noopener">
                            <div class="highlight-box wow fadeInUp">
                                <div>
                                    <img src="<?=base_url('assets/images/icon/covid/distance.svg')?>" style="width: 83px;" alt="Website Image">
                                </div>
                                <div class="content-sec">
                                    <h5>Social Distancing</h5>
                                    <p>All hotel staffs are trained to practice social distancing throughout the day.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-6">
                        <a class="text-dark" href="https://www.cowin.gov.in" target="_blank" rel="noopener">
                            <div class="highlight-box wow fadeInUp">
                                <div>
                                    <img src="<?=base_url('assets/images/icon/covid/temprature.svg')?>" style="width: 83px;" alt="Website Image">
                                </div>
                                <div class="content-sec">
                                    <h5>Daily Temperature Check</h5>
                                    <p>Anyone with a temperature above 99.1 F to be sent on mandatory leave.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-6">
                        <a class="text-dark" href="https://www.cowin.gov.in" target="_blank" rel="noopener">
                            <div class="highlight-box wow fadeInUp">
                                <div>
                                    <img src="<?=base_url('assets/images/icon/covid/hand-sanitizer.svg')?>" style="width: 83px;" alt="Website Image">
                                </div>
                                <div class="content-sec">
                                    <h5>Sanitization</h5>
                                    <p>All rooms are disinfected before every check-in. The common areas are sanitized.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-6">
                        <a class="text-dark" href="https://www.cowin.gov.in" target="_blank" rel="noopener">
                            <div class="highlight-box wow fadeInUp">
                                <div>
                                    <img src="<?=base_url('assets/images/icon/covid/mask1.svg')?>" style="width: 83px;" alt="Website Image">
                                </div>
                                <div class="content-sec">
                                    <h5>Masks & Gloves</h5>
                                    <p>The usage of masks & gloves are mandatory by the every hotel staff.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section start -->

    <!-- subscribe section start -->
    <section class="subscribe_section medium-section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="subscribe-detail">
                        <div>
                            <h2>subscribe our news <span>our news</span></h2>
                            <p>Subscribe and receive our newsletters to follow the news about our offer and updates.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="input-section">
                        <input type="text" class="form-control" placeholder="Enter Your Email"
                            aria-label="Recipient's username">
                        <a href="#" class="btn btn-rounded btn-sm color1">subscribe</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--subscribe section end -->

<?php include('includes/footer.php') ?>
<?php include('includes/scripts.php') ?>

</body>

</html>
