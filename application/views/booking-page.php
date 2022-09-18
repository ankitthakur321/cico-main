<?php include('includes/header.php')?>
<?php include('includes/navbar.php')?>


    <!-- booking section start -->
    <section class="section-b-space bg-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
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
                    <div class="guest-detail">
                        <h2>Booking Person Information</h2>
                        <form method="POST" action="<?=base_url('user/pay')?>" id="bookingForm">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col first-name">
                                        <label>name</label>
                                        <input type="text" id="firstName" class="form-control" placeholder="Full name" name="userName" value="<?=$userData[0]['name']?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="initialBookingPrice" name="initialBookingPrice" value="<?=$this->session->userdata("bookingPrice")?>" required />
                            <input type="hidden" id="finalBookingPrice" name="finalBookingPrice" value="<?=$this->session->userdata("bookingPrice")?>" required />
                            <input type="hidden" id="paymentType" name="paymentType" required />
                            <!--<input type="hidden" id="finalBookingPrice" name="finalBookingPrice" value="<?=$this->session->userdata("bookingPrice")?>" required />-->
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="userEmail" value="<?=$userData[0]['email']?>">
                                <small id="emailHelp" class="form-text text-muted">Booking confirmation will be sent to
                                    this email ID.</small>
                            </div>
                            <div class="form-group">
                                <label>contact info</label>
                                <input id="mobile-no" type="tel" class="form-control" name="userPhone" value="<?=$userData[0]['phone']?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">special request</label>
                                <textarea class="form-control" id="specialRequest" name="specialRequest" rows="3"
                                    placeholder="e.g.. early check-in"></textarea>
                            </div>
                            <!--<div class="form-group">
                                <label for="exampleFormControlTextarea1">have a coupon code?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Promo Code">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">apply</span>
                                    </div>
                                </div>
                            </div>-->
                            <div class="submit-btn">
                                <button class="btn btn-solid" id="partPayment" type="button">pay at hotel<br><small class="m-0" style="font-size:10px;">Confirm Booking At ₹ <?=$partPrice?$partPrice:0?></small></button>
                                <button class="btn btn-solid" style="padding-top:20px;padding-bottom:19px;" id="fullPayment" type="button">pay now</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 booking-order">
                    <div class="summery-box">
                        <h2>booking summary</h2>
                        <div class="hotel-section">
                            <div class="hotel-img">
                                <img src="<?=base_url($hoteldetail[0]['hotel_image'])?>" class="img-fluid blur-up lazyload" alt="">
                            </div>
                            <div class="hotel-detail">
                                <h6><?=$hoteldetail[0]['hotel_name']?></h6>
                                <p><?=$hoteldetail[0]['hotel_location'].", ".$hoteldetail[0]['state'].", ".$hoteldetail[0]['country']?></p>
                            </div>
                        </div>
                        <div class="summery-section">
                            <div class="box">
                                <div class="left">
                                    <div class="up">
                                        <h6>check in</h6>
                                        <h5><?=$this->session->userdata('bookingCheckInDate')?$this->session->userdata('bookingCheckInDate'):'N/A'?></h5>
                                    </div>
                                    <div class="down">
                                        <h6>check in time</h6>
                                        <h5><?=$this->session->userdata('bookingCheckOutTime')?$this->session->userdata('bookingCheckInTime'):'N/A'?></h5>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="up">
                                        <h6>check out</h6>
                                        <h5><?=$this->session->userdata('bookingCheckInDate')?$this->session->userdata('bookingCheckOutDate'):'N/A'?></h5>
                                    </div>
                                    <div class="down">
                                        <h6>check out time</h6>
                                        <h5><?=$this->session->userdata('bookingCheckInTime')?$this->session->userdata('bookingCheckOutTime'):'N/A'?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="summery-section">
                            <h5 class="mb-0"><?=$this->session->userdata('totalGuests')?$this->session->userdata('totalGuests'):0?> <?php $rDetail = $roomdetail($this->session->userdata('bookingRoomType')); echo $rDetail[0]['room_title']; ?> </h5>
                            <a href="<?=site_url('hotels/hoteldetails/5')?>" class="edit-cls">edit</a>
                        </div>
                        <div class="summery-section">
                            <div class="payment-details">
                                <h5>payment details</h5>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>base price</td>
                                            <td><?=$this->session->userdata('bookingPrice')?($this->session->userdata('bookingPrice')<=999?"₹ ".ceil($this->session->userdata('bookingPrice')/1):"₹ ".ceil($this->session->userdata('bookingPrice')/1.12)):'0'?></td>
                                        </tr>
                                        <tr>
                                            <td>service fees</td>
                                            <td>+ ₹ 0</td>
                                        </tr>
                                        <tr>
                                            <td>taxes</td>
                                            <td>+ ₹ <?=$this->session->userdata('bookingPrice')?($this->session->userdata('bookingPrice') - ($this->session->userdata('bookingPrice')<=999?ceil($this->session->userdata('bookingPrice')/1):ceil($this->session->userdata('bookingPrice')/1.12))):'0'?></td>
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
                                            <td>payable amount</td>
                                            <td class="amount"><?=$this->session->userdata('bookingPrice')?"₹ ".$this->session->userdata('bookingPrice'):'N/A'?></td>
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

<!-- country select -->
<script src="<?= base_url('assets/js/intlTelInput.js')?>"></script>
<script>
    var input = document.querySelector("#mobile-no");
    window.intlTelInput(input, {
        utilsScript: "<?= base_url('assets/js/utils.js')?>",
    });
    
    $("#partPayment").click(function(){
        var pr = "<?=$partPrice?>";
        $('#finalBookingPrice').val(pr);
        $('#paymentType').val("Part Payment");
        $('#bookingForm').submit();
    });
    
    $("#fullPayment").click(function(){
        var pr = "<?=$this->session->userdata("bookingPrice")?>";
        $('#finalBookingPrice').val(pr);
        $('#paymentType').val("Full Payment");
        $('#bookingForm').submit();
    });
</script>

</body>

</html>