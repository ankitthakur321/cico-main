<!--Bottom Nav-->
<div class="navbar-bottom d-lg-none text-center ">
    <div class="row ">
        <div class="col-6 d-flex justify-content-center <?php if($this->uri->uri_string() == '') { echo 'active'; } ?>">
            <div><a href="<?=site_url('/')?>" class="<?php if($this->uri->uri_string() == '') { echo 'active'; } ?>"><i class="fas fa-home"></i><br>Home</a></div>
        </div>
        <div class="col-6 d-flex justify-content-center">
            <?php 
                if($this->session->userdata('loggedIn')){
            ?>
                    
                    <div><a href="<?=site_url('users/myBookings')?>" class="<?php if($this->uri->uri_string() == 'users/myBookings') { echo 'active'; } ?>"><i class="fas fa-shopping-bag"></i><br>Bookings</a></div>
                    <div><a href="<?=site_url('login/logout')?>"><i class="fas fa-sign-out"></i><br>Logout</a></div>
            <?php
                }
                else{
            ?>
                    <!-- <div><a href="<?=site_url('signup')?>" class="<?php if($this->uri->uri_string() == 'signup') { echo 'active'; } ?>"><i class="fas fa-user-plus"></i><br>Sign Up</a></div> -->
                    <div><a href="<?=site_url('login')?>" class="<?php if($this->uri->uri_string() == 'login' || $this->uri->uri_string() == 'login/guestLogin' ) { echo 'active'; } ?>"><i class="fas fa-sign-in-alt" id="login1"></i><br>Login</a></div>
            <?php
                }
            ?>
        </div>
    </div>
  
  <!-- <div><a href="<?=site_url('users/myCart')?>" class="<?php if($this->uri->uri_string() == 'users/myCart') { echo 'active'; } ?>"><i class="fas fa-shopping-cart"></i><br>My Cart</a></div> -->
    
</div>