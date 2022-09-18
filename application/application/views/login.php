<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Check In & Check Out</title>
    <link rel="icon" href="<?=base_url('assets/images/icon/fevicon.png')?>" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/login/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/login/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/login/css/login.css')?>">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-5 intro-section">
          <div class="brand-wrapper text-center">
            <a href="<?=base_url('/')?>"><img src="<?= base_url('assets/images/icon/logo-white.png')?>" alt="checkinandcheckout.com" class="logo"></a>
          </div>
          <div class="intro-content-wrapper d-none d-sm-block d-sm-none d-md-block">
            <h1 class="intro-title">Welcome to<br>Check In & Check Out !</h1>
            <p class="intro-text">Heard Right. For the very first time We Advocate Credit Pay. Come & Pay..maybe. You get seemless experience in your neighbourhood city hotels in your own budget.</p>
          </div>
          <div class="intro-section-footer d-none d-sm-block d-sm-none d-md-block">
            <p>Copyright 2022 checkinandcheckout.com</p>
          </div>
        </div>
        <div class="col-sm-7 form-section">
          <div class="login-wrapper">
            <h2 class="login-title">Sign in</h2>
            <form action="<?=base_url('login/login_auth')?>" method="POST" id="loginForm">
                <div class="form-group">
                    <!--<label for="mobileNo" class="sr-only">Mobile Number</label>-->
                    <input type="tel" name="mobileNo" id="mobileNo" class="form-control" placeholder="Mobile Number" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                </div>
                <div id="otpDiv" style="display:none">
                    <div class="form-group mb-3">
                        <!--<label for="password" class="sr-only">OTP</label>-->
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP" pattern="[0-9]{6}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                    </div>
                    <p class="text-center" id="">Resend OTP in <span id="timer"></span></p>
                </div>
                
                <div id="passDiv" style="display:none">
                    <div class="form-group mb-3">
                        <!--<label for="password" class="sr-only">Password</label>-->
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="custom-control custom-checkbox login-check-box">
                        <input type="checkbox" class="custom-control-input" id="showPassCheck">
                        <label class="custom-control-label" for="showPassCheck">Show Password</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <input name="loginBtn" id="loginBtn" class="btn login-btn" type="button" value="Login" disabled>
                    <a href="<?=base_url('login/forgot_password')?>" class="forgot-password-link" id="forgetPass" style="display:none">Forgot Password?</a>
                </div>
            </form>
            <p class="alert alert-danger my-2" style="display:none;" id="alertText"></p>
            <p class="alert alert-success my-2" style="display:none;" id="successText"></p>
            <?php

                if($this->session->flashdata('status')) {
                $message = $this->session->flashdata('status');
            ?>
                <div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?></div>
            <?php
                }
                else if($this->session->flashdata('loginfailed')){
                    $message = $this->session->flashdata('loginfailed');
             ?>
                <div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?></div>
            <?php
                }
            ?>
            <h6 class="social-login-title">OR</h6>
            <p class="text-center" id="">Signin with <a href="javascript:;" id="passLogin" class="link text-danger">Password</a> instead?</p>
            <!--<h6 class="social-login-title">OR</h6>
            <nav class="social-login-links">
              <a href="#!" class="social-login-link">
                <img src="<?= base_url('assets/login/images/facebook.svg')?>" alt="facebook logo"> Facebook
              </a>
              <a href="#!" class="social-login-link">
                <img src="<?= base_url('assets/login/images/twitter.svg')?>" alt="twitter logo"> Twitter
              </a>
              <a href="#!" class="social-login-link">
                <img src="<?= base_url('assets/login/images/google.svg')?>" alt="google logo"> Google
              </a>
            </nav>--><br><br>
            <a class="btn btn-default border-0" href="<?=base_url('/')?>"><span class="mdi mdi-arrow-left-bold-circle"></span> Back to Home</a>
          </div>
        </div>
      </div>
    </div>
  </main>
    <script src="<?= base_url('assets/login/js/jquery-3.4.1.min.js')?>"></script>
    <script src="<?= base_url('assets/login/js/popper.min.js')?>"></script>
    <script src="<?= base_url('assets/login/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/login/js/custom.js')?>"></script>
</body>
</html>