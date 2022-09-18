<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reactivate Account | Check In & Check Out</title>
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
            <h2 class="login-title">Account Deactivated</h2>
            <form action="<?=base_url('login/accountReactivate')?>" method="POST" id="reactivationForm">
                <p>You have deactivated your account earlier. Do you want to reactivate it?</p>
                <input type="hidden" name="userid" value="<?=$userId?>" required/>
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <input name="loginBtn" id="reactivateBtn" class="btn bg-success login-btn" type="submit" value="Yes! Reactivate">
                    <a name="loginBtn" id="NoBtn" class="btn login-btn" href="<?=base_url('login')?>"> No </a>
                </div>
            </form>
            <br><br>
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