<!-- header start -->
<header class="light_header">
    <div class="container py-3">
        <div class="row ">
            <div class="col">
                <div class="menu">
                    <div class="brand-logo">
                        <a href="<?= base_url('/') ?>">
                            <img src="<?= base_url('assets/images/icon/logo.png') ?>" alt="" class="img-fluid blur-up lazyload">
                        </a>
                    </div>
                    <nav>
                        <!--<div class="main-navbar ">-->
                        <!--    <div id="mainnav">-->
                        <!--        <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>-->
                        <!--        <div class="menu-overlay"></div>-->
                        <!--        <ul class="nav-menu">-->
                        <!--            <li class="back-btn">-->
                        <!--                <div class="mobile-back text-end">-->
                        <!--                    <span>Back</span>-->
                        <!--                    <i aria-hidden="true" class="fa fa-angle-right ps-2"></i>-->
                        <!--                </div>-->
                        <!--            </li>-->
                        <!--            <li><a href="#" class="menu-title">My Cart</a></li>-->
                        <!--            <li><a href="#" class="menu-title">Login</a></li>-->
                        <!--            <li><a href="#" class="menu-title">Register</a></li> -->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </nav>
                        <ul class="header-right">
                            <?php if($this->session->userdata('loggedIn')) { ?>
                                <li class="user user-light rounded5">
                                    <a href="<?=base_url('user/profile')?>" class="text-dark">
                                        <i class="fas fa-user"></i>&nbsp;&nbsp;<strong>My Account</strong>
                                    </a>
                                </li>
                            <?php }
                                  else { 
                            ?>
                                <li class="user user-light rounded5">
                                    <a href="<?=base_url('login')?>" class="text-dark">
                                        <i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;<strong>Login / Signup</strong>
                                    </a>
                                </li>
                            <?php 

                            }
                             ?>
                        </ul>
                   
                </div>
            </div>
        </div>
    </div>
</header>
<!--  header end -->