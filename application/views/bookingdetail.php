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
                            <h2>Booking Detail</h2>
                            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url('/')?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Booking</li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- booking section start -->
    <section class="section-b-space bg-inner animated-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 booking-order">
                    <div class="summery-box">
                        <div class="hotel-section">
                            <div class="hotel-img">
                                <img src="<?= base_url('').$booking_detail[0]['hotel_image']?>" class="img-fluid blur-up lazyload" alt="">
                            </div>
                            <div class="hotel-detail">
                                <h6><?= $booking_detail[0]['hotel_name']?></h6>
                                <p><?=$booking_detail[0]['hotel_location'].", ".$booking_detail[0]['state'].", ".$booking_detail[0]['country']?></p>
                            </div>
                        </div>
                        <div class="summery-section">
                            <div class="box">
                                <div class="left">
                                    <div class="up">
                                        <h5>Booking ID</h5>
                                        <h6>CICO1</h6>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="up">
                                        <h5>Status</h5>
                                        <?php   if(date('d-m-Y', strtotime($booking_detail[0]['checkInDate']))>=date('d-m-Y') && $booking_detail[0]['checkIn_status'] !=1 ) {
                                                    echo "<h6 class='text-info'>Upcoming</h6>";
                                                } else if($booking_detail[0]['cancelled_status']==1) { 
                                                    echo "<h6 class='text-danger'>Cancelled</h6>";
                                                } else { 
                                                    echo "<h6 class='text-success'>Completed</h6>";
                                                }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="summery-section">
                            <div class="box">
                                <div class="left">
                                    <div class="up">
                                        <h5>CheckIn</h5>
                                        <h6><?=date('d M, Y', strtotime($booking_detail[0]['checkInDate']))?></h6>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="up">
                                        <h5>CheckOut</h5>
                                        <h6><?=date('d M, Y', strtotime($booking_detail[0]['checkOutDate']))?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="summery-section">
                            <div class="box">
                                <div class="left">
                                    <h5><?= $booking_detail[0]['booked_rooms']?> Rooms, <?= $booking_detail[0]['guests']?> Guest</h5>
                                </div>
                                <div class="right">
                                    <h5><?= $booking_detail[0]['room_title']?>, <?= $booking_detail[0]['stay_type']?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="summery-section">
                            <div class="box">
                                <h5>Hotel policy</h5>
                                <p class="text-dark">It is mandatory for guests to present valid photo identification at the time of
                                        check-in. According to government regulations, a valid Photo ID has to be
                                        carried by every person above the age of 18 staying at the hotel.
                                        The identification proofs accepted are Aadhar Card, Driving License, Voter ID
                                        Card, and Passport. Without Original copy of valid ID the guest will not be
                                        allowed to check-in.
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 booking-order">
                    <div class="summery-box">
                        <h2>Guest & Payment Details</h2>
                        <div class="summery-section">
                            <div class="payment-details">
                                <h5>Guest details</h5>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td><?= $booking_detail[0]['name']?></td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>+91 <?= $booking_detail[0]['phoneNumber']?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= $booking_detail[0]['emailAddress']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="summery-section">
                            <div class="payment-details">
                                <h5>Payment details</h5>
                                    <?php
                                        if($booking_detail[0]['initial_booking_price'] < 1000)
                                        {
                                            $tax=1;
                                        }
                                        else
                                        {
                                            $tax=1.12;
                                        }
                                        
                                        $base_price= $booking_detail[0]['initial_booking_price'] / $tax;
                                    ?>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Hotel charges</td>
                                            <td>₹<?= ceil($base_price)?></td>
                                        </tr>
                                        <tr>
                                            <td>Hotel tax</td>
                                            <td>₹<?= $booking_detail[0]['initial_booking_price'] - ceil($base_price)?></td>
                                        </tr>
                                        <tr>
                                            <td>Service tax</td>
                                            <td>₹0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><div class="summery-section">
                            <div class="payment-details">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Total payable amount</td>
                                            <td>₹<?= $booking_detail[0]['initial_booking_price']?></td>
                                        </tr>
                                        <tr>
                                            <td>Paid amount</td>
                                            <td>₹<?= $booking_detail[0]['booking_price']?></td>
                                        </tr>
                                        <tr>
                                            <td>Dues Amount</td>
                                            <td>₹<?= $booking_detail[0]['initial_booking_price'] - $booking_detail[0]['booking_price']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="summery-section">
                            <div class="payment-details">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Final payable amount</td>
                                            <td class="amount">₹<?= $booking_detail[0]['initial_booking_price'] - $booking_detail[0]['booking_price']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- booking section end -->



<?php include('includes/footer.php') ?>
<?php include('includes/scripts.php') ?>

</body>

</html>