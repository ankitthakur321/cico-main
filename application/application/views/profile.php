<?php include('includes/header.php')?>
<?php include('includes/navbar.php')?>
<?php //include('includes/search-bar.php')?>


    <!-- section start-->
    <section class="small-section dashboard-section bg-inner" data-sticky_parent>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="pro_sticky_info" data-sticky_column>
                        <div class="dashboard-sidebar">
                            <div class="profile-top">
                                <div class="profile-image">
                                    <?php if($profile[0]['photo']== NULL){?>
                                        <img src="<?= base_url('assets/images/icon/User-avatar.svg')?>" class="img-fluid blur-up lazyload" alt="">
                                    <?php 
                                        }
                                        else{
                                    ?>
                                        <img src="<?= $profile[0]['photo']?>" class="img-fluid blur-up lazyload" alt="">
                                    <?php }?>
                                    <a class="profile-edit" href="javascript:void(0)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                            </path>
                                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                        </svg>
                                    </a>
                                </div>
                                <div class="profile-detail">
                                    <h5><?= $profile[0]['name']?></h5>
                                </div>
                            </div>
                            <div class="faq-tab">
                                <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active"
                                            href="#dashboard">dashboard</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#profile">profile</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#bookings">bookings</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#bookmark">Cart</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#security">security</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="<?= base_url('login/logout')?>">Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="product_img_scroll" data-sticky_column>
                        <div class="faq-content tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="dashboard">
                                <div class="dashboard-main">
                                    <?php
                                        if($this->session->flashdata('status')) {
                                        $message = $this->session->flashdata('status');
                                    ?>
                                        <div class="mt-5 <?php echo $message['class'] ?> alert-dismissible fade show" role="alert">
                                            <?php echo $message['message']; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="dashboard-intro">
                                        <h5>welcome! <span>CICO User</span></h5>
                                        <p>you have completed  <?php if($profile[0]['name']== NULL || $profile[0]['email']== NULL){?> 50% of your profile. Add basic info to complete profile. <?php } else echo "100% of your profile" ?> 
                                        </p>
                                        <div class="complete-profile">
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <?php if($profile[0]['name']== NULL){?>
                                                        <div class="complete-box not-complete">
                                                            <i class="far fa-window-close"></i>
                                                            <h6>Profile Name</h6>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="complete-box">
                                                            <i class="far fa-check-square"></i>
                                                            <h6>Verified Profile Name</h6>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-xl-4">
                                                    <?php if($profile[0]['email']== NULL){?>
                                                        <div class="complete-box not-complete">
                                                            <i class="far fa-window-close"></i>
                                                            <h6>verified email ID</h6>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="complete-box">
                                                            <i class="far fa-check-square"></i>
                                                            <h6>verified email ID</h6>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="complete-box">
                                                        <i class="far fa-check-square"></i>
                                                        <h6>verified phone number</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($profile[0]['name']== NULL){?>
                                        <div class="dashboard-intro">
                                        <h5>Comlete Your Profile</h5>
                                            <div class="complete-profile">
                                                <?php echo form_open('user/userinfo')?>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="fullName">Full Name</label>
                                                            <input type="text" name="name" class="form-control name" id="fullName" placeholder="Enter Full Name" value="<?= set_value('name');?>" required="">
                                                            <?= form_error('name','<small class="form-text" style="color:tomato; font-size:12px">','</small>')?>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="userEmail">Email address</label>
                                                            <input type="email" name="email" class="form-control" id="userEmail" value="<?= set_value('email');?>" placeholder="Enter email Address">
                                                            <?= form_error('email','<small class="form-text" style="color:tomato; font-size:12px">','</small>')?>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="newpass">Create password for your account</label>
                                                            <input type="text" name="password" class="form-control" id="newpass" placeholder="Create Password" required="" autocomplete="off">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="confirmPass">Confirm Password</label>
                                                            <input type="text" name="passconf" class="form-control" id="confirmPass" placeholder="Confirm Password" required="" autocomplete="off">
                                                            <small class="form-text" style="color:tomato; font-size:12px;display:none" id="cnfPassAlert"></small>
                                                        </div>
                                                        <div class="col-md-12 submit-btn">
                                                            <button class="btn btn-solid" id="saveInfo" type="submit" disabled>Save Information</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php 
                                        }
                                        else{
                                    ?>
                                    <div class="counter-section">
                                        <div class="row">
                                            <div class="col-xl-4 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="https://img.icons8.com/fluency/48/000000/hotel-check-in.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3><?=count($upcoming)?></h3>
                                                    <h5>Upcoming Bookings</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-booking-hotel-management-flaticons-lineal-color-flat-icons-4.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3><?=count($completed)?></h3>
                                                    <h5>Completed Bookings</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="https://img.icons8.com/external-bearicons-flat-bearicons/64/000000/external-Cancelled-miscellany-texts-and-badges-bearicons-flat-bearicons.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3><?=count($cancelled)?></h3>
                                                    <h5>Cancelled Bookings</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-info">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="chart">
                                                    <div class="detail-left">
                                                        <ul>
                                                            <li><span class="completed"></span> Completed</li>
                                                            <li><span class="upcoming"></span> Upcoming</li>
                                                            <li><span class="cancelled"></span> Cancelled</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                 <!-- Charts section js -->
                                                    <script src="<?= base_url('assets/js/apexcharts.js')?>"></script>

                                                <script>
                                                     /*****Chart Data Fetching*****/
                                                    <?php 
                                                        $totalBookings = count($completed) + count($upcoming) + count($cancelled); 
                                                        $completedPercent = ceil((count($completed)/$totalBookings)*100);
                                                        $upcomingPercent = ceil((count($upcoming)/$totalBookings)*100);
                                                        $cancelledPercent = ceil((count($cancelled)/$totalBookings)*100);
                                                    ?>
                                                    var options = {
                                                        chart: {
                                                            height: 350,
                                                            type: 'radialBar',
                                                        },
                                                        plotOptions: {
                                                            radialBar: {
                                                                dataLabels: {
                                                                    name: {
                                                                        fontSize: '22px',
                                                                    },
                                                                    value: {
                                                                        fontSize: '16px',
                                                                    },
                                                                    total: {
                                                                        show: true,
                                                                        label: 'Total',
                                                                        formatter: function (w) {
                                                                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                                                            return <?=$totalBookings?>
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        },
                                                        
                                                        series: [<?=$completedPercent?>, <?=$upcomingPercent?>, <?=$cancelledPercent?>],
                                                        labels: ['Completed', 'Upcoming', 'Cancelled'],
                                                        colors:['#32CD32', '#a264ff', '#fa4962'],
                                                        stroke: {
                                                            lineCap: "round",
                                                        }
                                                    
                                                    }
                                                    
                                                    var chart = new ApexCharts(
                                                        document.querySelector("#chart"),
                                                        options
                                                    );
                                                    
                                                    chart.render();
                                                </script>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="activity-box">
                                                    <h6>recent activity</h6>
                                                    <ul>
                                                        <li>
                                                            <i class="fas fa-plane"></i>
                                                            Paris to Dubai
                                                            <span>3 days ago</span>
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-plane"></i>
                                                            Paris to Dubai
                                                            <span>23 june</span>
                                                        </li>
                                                        <li class="blue-line">
                                                            <i class="fas fa-hotel"></i>
                                                            hotel sea view
                                                            <span>20 april</span>
                                                        </li>
                                                        <li class="yellow-line">
                                                            <i class="fas fa-taxi"></i>
                                                            Paris To Toulouse
                                                            <span>12 feb</span>
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-plane"></i>
                                                            Paris to Dubai
                                                            <span>14 jan</span>
                                                        </li>
                                                        <li class="blue-line">
                                                            <i class="fas fa-hotel"></i>
                                                            hotel sea view
                                                            <span>12 jan</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>profile</h4>
                                        <!--<span data-bs-toggle="modal" data-bs-target="#edit-profile">edit</span>-->
                                    </div>
                                    <div class="dashboard-detail">
                                        <ul>
                                            <li>
                                                <div class="details">
                                                    <div class="left">
                                                        <h6>name</h6>
                                                    </div>
                                                    <div class="right">
                                                        <h6><?= $profile[0]['name']?></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--<li>-->
                                            <!--    <div class="details">-->
                                            <!--        <div class="left">-->
                                            <!--            <h6>birthday</h6>-->
                                            <!--        </div>-->
                                            <!--        <div class="right">-->
                                            <!--            <h6>-</h6>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <div class="details">-->
                                            <!--        <div class="left">-->
                                            <!--            <h6>gender</h6>-->
                                            <!--        </div>-->
                                            <!--        <div class="right">-->
                                            <!--            <h6>-</h6>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <div class="details">-->
                                            <!--        <div class="left">-->
                                            <!--            <h6>street address</h6>-->
                                            <!--        </div>-->
                                            <!--        <div class="right">-->
                                            <!--            <h6>-</h6>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <div class="details">-->
                                            <!--        <div class="left">-->
                                            <!--            <h6>city/state</h6>-->
                                            <!--        </div>-->
                                            <!--        <div class="right">-->
                                            <!--            <h6>-</h6>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <div class="details">-->
                                            <!--        <div class="left">-->
                                            <!--            <h6>zip</h6>-->
                                            <!--        </div>-->
                                            <!--        <div class="right">-->
                                            <!--            <h6>-</h6>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</li>-->
                                        </ul>
                                    </div>
                                </div>
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>login details</h4>
                                    </div>
                                    <div class="dashboard-detail">
                                        <ul>
                                            <li>
                                                <div class="details">
                                                    <div class="left">
                                                        <h6>email address</h6>
                                                    </div>
                                                    <div class="right">
                                                        <h6><?=$profile[0]['email']?></h6>
                                                        <span data-bs-toggle="modal"
                                                            data-bs-target="#updateEmailModal">edit</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="details">
                                                    <div class="left">
                                                        <h6>phone no:</h6>
                                                    </div>
                                                    <div class="right">
                                                        <h6>+91 <?=$profile[0]['phone']?></h6>
                                                        <!--<span data-bs-toggle="modal" data-bs-target="#edit-phone">edit</span>-->
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="details">
                                                    <div class="left">
                                                        <h6>password</h6>
                                                    </div>
                                                    <div class="right">
                                                        <h6>&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;</h6>
                                                        <span data-bs-toggle="modal"
                                                            data-bs-target="#edit-password">edit</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bookings">
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>upcoming booking</h4>
                                    </div>
                                    <?php foreach($upcoming as $new):;?>
                                    <div class="dashboard-detail">
                                        <div class="booking-box">
                                            <div class="date-box">
                                                <span class="date"><?=date('d', strtotime($new['checkInDate']))?></span>
                                                <span class="month"><?=date('M', strtotime($new['checkInDate']))?></span>
                                            </div>
                                            <div class="detail-middle">
                                                <div class="media">
                                                    <div class="icon">
                                                        <i class="fas fa-hotel"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><?= $new['hotel_name']?></h6>
                                                        <p>amount paid: <span>₹<?= $new['booking_price']?></span></p>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">ID: CICO<?= $new['bookingid']?></h6>
                                                        <p><span>20 oct, 2020</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-last">
                                                <a href="<?= base_url('user/bookingDetail/').$new['bookingid']?>"><span class="badge bg-info"><i class="fa fa-info-circle text-white"> </i> Detail</span></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#cancel-booking<?= $new['bookingid']?>"><span class="badge bg-danger"><i class="fas fa-window-close text-white" data-bs-toggle="tooltip"
                                                        data-placement="top" title="cancel booking"></i> Cancel</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cancel booking modal start -->
                                        <div class="modal fade edit-profile-modal" id="cancel-booking<?=$new['bookingid']?>" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel<?=$new['bookingid']?>">Cancel Booking</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="<?=base_url('user/cancelBooking')?>">
                                                            <input type="hidden" name="bookingId" value="<?=$new['bookingid']?>" />
                                                            <div class="left-sidebar">
                                                                <div class="middle-part p-0">
                                                                    <div class="filter-block">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" id="locationIssue<?=$new['bookingid']?>" name="locationIssue">
                                                                                    <label class="form-check-label" for="6">Location</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" id="hygienIssue<?=$new['bookingid']?>" name="hygienIssue">
                                                                                    <label class="form-check-label" for="7">Hygien</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" id="amenitiesIssue<?=$new['bookingid']?>" name="amenitiesIssue">
                                                                                    <label class="form-check-label" for="8">Aminities Issue</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" id="behaviourIssue<?=$new['bookingid']?>" name="behaviourIssue">
                                                                                    <label class="form-check-label" for="9">Behaviour and Harrasment</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" id="moneyIssue<?=$new['bookingid']?>" name="moneyIssue">
                                                                                    <label class="form-check-label" for="10">Asking for extra money</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" id="betterDealIssue<?=$new['bookingid']?>" name="betterDealIssue">
                                                                                    <label class="form-check-label" for="11">Found better deal somewhere else</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" id="checkinDeniedIssue<?=$new['bookingid']?>" name="checkinDeniedIssue">
                                                                                    <label class="form-check-label" for="15">Checkin Denied</label>
                                                                                </div>
                                                                                <div style="padding-left:25px">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" value="1" id="religionIssue<?=$new['bookingid']?>" name="religionIssue">
                                                                                        <label class="form-check-label" for="1">Religion</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" value="1" id="ageIssue<?=$new['bookingid']?>" name="ageIssue">
                                                                                        <label class="form-check-label" for="2">Age</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" value="1" id="idproofIssue<?=$new['bookingid']?>" name="idproofIssue">
                                                                                        <label class="form-check-label" for="3">ID</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" value="1" id="pricingIssue<?=$new['bookingid']?>" name="pricingIssue">
                                                                                        <label class="form-check-label" for="4">Pricing</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" value="1" id="restrictionsIssue<?=$new['bookingid']?>" name="restrictionsIssue">
                                                                                        <label class="form-check-label" for="5">Restrictions</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-12 mt-3">
                                                                                <textarea class="form-control" placeholder="Others(Describe in Details)" id="describeIssue<?=$new['bookingid']?>" name="describeIssue" rows="3"></textarea>
                                                                            </div>
                                                                            <div class="col-md-12 mt-3 float-right" id="submitBtnDiv">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-solid ml-5">Yes! Cancel Booking</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Cancle booking modal start -->
                                    <? endforeach;?>
                                </div>
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>past booking</h4>
                                    </div>
                                    <?php foreach($completed as $past):;?>
                                    <div class="dashboard-detail">
                                        <div class="booking-box">
                                            <div class="date-box">
                                                <span class="date"><?=date('d', strtotime($past['checkInDate']))?></span>
                                                <span class="month"><?=date('M', strtotime($past['checkInDate']))?></span>
                                            </div>
                                            <div class="detail-middle">
                                                <div class="media">
                                                    <div class="icon">
                                                        <i class="fas fa-hotel"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><?= $past['hotel_name']?></h6>
                                                        <p>amount paid: <span>₹<?= $past['booking_price']?></span></p>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">ID: CICO<?= $past['bookingid']?></h6>
                                                        <p>Booking date: <span>20 oct, 2020</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-last">
                                                <a href="<?= base_url('user/bookingDetail/').$past['bookingid']?>"><span class="badge bg-success"><i class="fa fa-info-circle text-white"> </i> Detail</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <? endforeach;?>
                                </div>
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>cancelled booking</h4>
                                    </div>
                                    <?php foreach($cancelled as $cancel):;?>
                                    <div class="dashboard-detail">
                                        <div class="booking-box">
                                            <div class="date-box">
                                                <span class="date"><?=date('d', strtotime($cancel['checkInDate']))?></span>
                                                <span class="month"><?=date('M', strtotime($cancel['checkInDate']))?></span>
                                            </div>
                                            <div class="detail-middle">
                                                <div class="media">
                                                    <div class="icon">
                                                        <i class="fas fa-hotel"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><?= $cancel['hotel_name']?></h6>
                                                        <p>amount paid: <span>₹<?= $cancel['booking_price']?></span></p>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">ID: CICO<?= $cancel['bookingid']?></h6>
                                                        <p>Booking date: <span>20 oct, 2020</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-last">
                                                <a href="<?= base_url('user/bookingDetail/').$cancel['bookingid']?>"><span class="badge bg-danger"><i class="fa fa-info-circle text-white"> </i> Detail</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <? endforeach;?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bookmark">
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>My Cart</h4>
                                    </div>
                                    <div class="product-wrapper-grid ratio3_2 special-section grid-box">
                                        <div class="row content grid">
                                            <?php foreach($carts as $cart):;?>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="<?= base_url('hotels/hoteldetails/').$cart['hid']?>">
                                                            <img src="<?= base_url('').$cart['hotel_image']?>"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="<?= base_url('hotels/hoteldetails/').$cart['hid']?>">
                                                                <h5><?= $cart['hotel_name']?></h5>
                                                            </a>
                                                            <h6><?= $cart['hotel_address']?></h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="<?= base_url('user/removeCart/').$cart['cid']?>" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <? endforeach;?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="security">
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>deactivate your accont</h4>
                                    </div>
                                    <div class="dashboard-detail">
                                        <div class="delete-section">
                                            <p>Hi <span class="text-bold"><?= $profile[0]['name']?></span>,</p>
                                            <p>we are sorry to here you would like to deactivate your account.</p>
                                            <p><span class="text-bold">note:</span></p>
                                            <p>deactvating your account will temporarly remove your profile, personal
                                                settings, and all other associated information.
                                                once your account is deactivated, you will be logged out.
                                            </p>
                                            <p>if you understand and agree to the above statement, and would still like
                                                to deactivate your account, than click below</p>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#delete-account"
                                                class="btn btn-solid">deactivate my account</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section end-->
    
    

    <!-- edit profile modal start -->
    <div class="modal fade edit-profile-modal" id="edit-profile" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first">first name</label>
                                <input type="text" class="form-control" id="first" placeholder="first name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last">last name</label>
                                <input type="text" class="form-control" id="last" placeholder="last name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gender">gender</label>
                                <select id="gender" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>female</option>
                                    <option>male</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>birthday</label>
                                <input class="form-control" placeholder="18 april" id="datepicker" />
                            </div>
                            <div class="form-group col-12">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit profile modal start -->


    <!-- edit address modal start -->
    <div class="modal fade edit-profile-modal" id="updateEmailModal" tabindex="-1" role="dialog"
        aria-labelledby="updateEmailModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change email address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?=base_url('user/updateEmail')?>">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="oldEmail">old email</label>
                                <input type="email" class="form-control" id="oldEmail" name="oldEmail">
                            </div>
                            <div id="newEmailDiv" style="display:none">
                                <div class="form-group col-12">
                                    <label for="newEmail">enter new email</label>
                                    <input type="email" class="form-control" id="newEmail" name="newEmail">
                                </div>
                                <div class="form-group col-12">
                                    <label for="comfirmEmail">confirm your email</label>
                                    <input type="email" class="form-control" id="confirmEmail" name="confirmEmail">
                                </div>
                            </div>
                            <div class="form-group col-12" id="emailFooter" style="display:none;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-solid" id="changeEmailBtn">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- edit address modal start -->


    <!-- edit phone no modal start -->
    <div class="modal fade edit-profile-modal" id="edit-phone" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change phone no</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="ph-o">old phone no</label>
                                <input type="number" class="form-control" id="ph-o">
                            </div>
                            <div class="form-group col-12">
                                <label for="ph-n">enter new phone no</label>
                                <input type="number" class="form-control" id="ph-n">
                            </div>
                            <div class="form-group col-12">
                                <label for="ph-c">confirm your phone no</label>
                                <input type="number" class="form-control" id="ph-c">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit phone no modal start -->


    <!-- edit password modal start -->
    <div class="modal fade edit-profile-modal" id="edit-password" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?=base_url('user/updatePassword')?>">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="p-o">old password</label>
                                <input type="email" class="form-control" id="oldPassword" name="oldPassword">
                            </div>
                            <div id="newPassDiv" style="display:none">
                                <div class="form-group col-12">
                                    <label for="p-n">enter new password</label>
                                    <input type="email" class="form-control" id="newPassword" name="newPassword">
                                </div>
                                <div class="form-group col-12">
                                    <label for="p-c">confirm your password</label>
                                    <input type="email" class="form-control" id="cnfPassword" name="cnfPassword">
                                </div>
                            </div>
                            <div class="form-group col-12" id="passFooter" style="display:none;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-solid" id="changePasswordBtn">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- edit password modal start -->
    <div class="modal fade edit-profile-modal" id="edit-card" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">edit your card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">name on card</label>
                            <input type="text" class="form-control" id="name" placeholder="Mark jecno">
                        </div>
                        <div class="form-group">
                            <label for="number">card number</label>
                            <input type="text" class="form-control" id="number" placeholder="7451 2154 2115 2510">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="expiry">expiry date</label>
                                <input type="text" class="form-control" id="expiry" placeholder="12/23">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cvv">cvv</label>
                                <input type="password" maxlength="3" class="form-control" id="cvv"
                                    placeholder="&#9679;&#9679;&#9679;" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">update card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- add card modal start -->
    <div class="modal fade edit-profile-modal" id="add-card" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">add new card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="a-month">card type</label>
                            <select id="a-month" class="form-control">
                                <option selected>add new card...</option>
                                <option>credit card</option>
                                <option>debit card</option>
                                <option>debit card with ATM pin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="a-na">name on card</label>
                            <input type="text" class="form-control" id="a-na">
                        </div>
                        <div class="form-group">
                            <label for="a-n">card number</label>
                            <input type="text" class="form-control" id="a-n">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="a-e">expiry date</label>
                                <input type="text" class="form-control" id="a-e">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="a-c">cvv</label>
                                <input type="password" maxlength="3" class="form-control" id="a-c" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">add card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- add card modal start -->
    <div class="modal fade edit-profile-modal" id="delete-account" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account deactivation request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <p class="text-dark">Before you leave, please tell us why you'd like to deactivate your CICO account.
                        This information will help us improve. (optional)</p>
                    <form>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">deactivete my account</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->
    

<?php include('includes/footer.php') ?>
<?php include('includes/scripts.php') ?>

    
<script>
    $(document).ready(function () {
        if ($(window).width() > 991) {
            $(".product_img_scroll, .pro_sticky_info").stick_in_parent();
        }
    });
    
    $("#confirmPass").on('keyup', function(){
        pass1 = $("#newpass").val();
        pass2 = $("#confirmPass").val();
        if(pass2 === pass1)
        {
            $("#cnfPassAlert").html("Password matched successfully.");
            $("#cnfPassAlert").prop("style","color:green");
            $('#saveInfo').prop("disabled",false);
            $('#confirmPass').removeClass("is-invalid");
            $('#confirmPass').addClass("is-valid");
        }
        else{
            $("#cnfPassAlert").prop("style","display:block;color:tomato");
            $("#cnfPassAlert").html("Password does not matched.");
            $('#saveInfo').prop("disabled",true);
            $('#confirmPass').addClass("is-invalid");
            
        }
        
    });
    
   
    
    let oEmail = document.getElementById("oldEmail");
    oEmail.addEventListener('change',function(){
        
        var oldEmail = $(this).val();
        if(oldEmail!=''){
            $.ajax({
            type: "POST",
            url: "<?=base_url('user/checkEmail')?>",
            dataType: 'json',
            data: {oldEmail: oldEmail},
            success: function(res) {
                if(res.accountStatus=='User Found')
                {
                    $('#newEmailDiv').prop("style", "display:block");
                }
                else{
                    $('#newEmailDiv').prop("style", "display:none");
                    $('#emailFooter').prop("style", "display:none");
                    alert("Wrong Email");
                }
            }
          });
        }
    });
    
    let cEmail = document.getElementById("confirmEmail");
    cEmail.addEventListener('keyup',function(){
        
        var cEmail = $(this).val();
        if(cEmail == $('#newEmail').val())
        {
            $('#emailFooter').prop("style", "display:block");
        }
        else{
            $('#emailFooter').prop("style", "display:none");
        }
    });
    
    let oPass = document.getElementById("oldPassword");
    oPass.addEventListener('change',function(){
        
        var oldPassword = $(this).val();
        if(oldPassword!=''){
            $.ajax({
            type: "POST",
            url: "<?=base_url('user/checkPassword')?>",
            dataType: 'json',
            data: {oldPassword: oldPassword},
            success: function(res) {
                if(res.passwordStatus=='Password Matched')
                {
                    $('#newPassDiv').prop("style", "display:block");
                }
                else{
                    $('#newPassDiv').prop("style", "display:none");
                    $('#passFooter').prop("style", "display:none");
                    alert("Password Not Matched");
                }
            }
          });
        }
    });
    
    let cPassword = document.getElementById("cnfPassword");
    cPassword.addEventListener('keyup',function(){
        
        var cPass = $(this).val();
        if(cPass == $('#newPassword').val())
        {
            $('#passFooter').prop("style", "display:block");
        }
        else{
            $('#passFooter').prop("style", "display:none");
        }
    });
    
    // let changeEmailBtn = document.getElementById("changeEmailBtn");
    // changeEmailBtn.addEventListener('click',function(){
    //     var newEmail = $("#newEmail").val();
    //     $.ajax({
    //     type: "POST",
    //     url: "<?=base_url('user/updateEmail')?>",
    //     dataType: 'json',
    //     data: {newEmail: newEmail},
    //     success: function(res) {
    //         if(res.changeStatus=="Email Changed")
    //         {
    //             alert("Email Successfully Changed");
    //             // $('#updateEmailModal').modal('hide');
    //         }
    //         else{
    //             alert("Email Not Successfully Changed");
    //             // $('#updateEmailModal').modal('hide');
    //         }
    //     }
    //   });
    // });
    
    
    
    
</script>

</body>

</html>

