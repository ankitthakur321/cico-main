<?php include('includes/header.php')?>
<?php include('includes/navbar.php')?>  
<?php include('includes/search-bar2.php')?>



    <!-- section start -->
    <section class="pt-0 xs-section bg-inner" data-sticky_parent>
        <div class="container">
            <div class="row">
                <div class="col-lg-3"> 
                    <div class="pro_sticky_info" data-sticky_column>
                        <div class="left-sidebar">
                            <div class="back-btn">
                                <i class="fas fa-window-close"></i>&nbsp;&nbsp;close
                            </div>
                            <!--<div class="search-bar">
                                <input type="text" placeholder="Search here..">
                                <i class="fas fa-search"></i>
                            </div>-->
                            <div class="middle-part collection-collapse-block open">
                                <a href="javascript:void(0)" class="section-title collapse-block-title">
                                    <h5>latest filter</h5>
                                    <img src="<?=base_url('assets/images/icon/adjust.png')?>" class="img-fluid blur-up lazyload" alt="">
                                </a>
                                <div class="collection-collapse-block-content ">
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title">price range</h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="wrapper">
                                                    <div class="range-slider">
                                                        <input type="text" class="js-range-slider" id="price" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title">facility</h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="collection-brand-filter">
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input amenities" id="restaurant" value="11" <?php if($this->input->get('amenity') == 11) { echo "checked"; } ?>>
                                                        <label class="form-check-label"
                                                            for="restaurant">in-house restaurant</label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input amenities" id="wifi" value="4" <?php if($this->input->get('amenity') == 4) { echo "checked"; } ?> >
                                                        <label class="form-check-label" for="wifi">free wifi</label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input amenities" id="ac" value="31" <?php if($this->input->get('amenity') == 31) { echo "checked"; } ?>>
                                                        <label class="form-check-label" for="ac">Air conditioned</label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input amenities" id="parking" value="19" <?php if($this->input->get('amenity') == 19) { echo "checked"; } ?>>
                                                        <label class="form-check-label" for="parking">free parking</label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input amenities" id="nonAC" value="32" <?php if($this->input->get('amenity') == 32) { echo "checked"; } ?>>
                                                        <label class="form-check-label" for="nonAC">non air-conditioned</label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input amenities" id="fitness" value="12" <?php if($this->input->get('amenity') == 12) { echo "checked"; } ?>>
                                                        <label class="form-check-label" for="fitness">fitness
                                                            center</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title">star category</h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="collection-brand-filter">
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input ratings" id="five" value="5" <?php if($this->input->get('ratings') == 5) { echo "checked"; } ?>>
                                                        <label class="form-check-label rating" for="five">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <span class="ms-1">(<?php if($hotelsAddress1 != null){ $count=0; foreach($hotelsAddress1 as $ad) { if($ad['rating']=='5') $count++;  } echo $count; } ?>)</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input ratings" id="four" value="4" <?php if($this->input->get('ratings') == 4) { echo "checked"; } ?>>
                                                        <label class="form-check-label rating" for="four">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <span class="ms-1">(<?php if($hotelsAddress1 != null){ $count=0; foreach($hotelsAddress1 as $ad) { if($ad['rating']=='4') $count++;  } echo $count; } ?>)</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input ratings" id="three" value="3" <?php if($this->input->get('ratings') == 3) { echo "checked"; } ?>>
                                                        <label class="form-check-label rating" for="three">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <span class="ms-1">(<?php if($hotelsAddress1 != null){ $count=0; foreach($hotelsAddress1 as $ad) { if($ad['rating']=='3') $count++;  } echo $count; } ?>)</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check collection-filter-checkbox">
                                                        <input type="checkbox" class="form-check-input ratings" id="two" value="2" <?php if($this->input->get('ratings') == 2) { echo "checked"; } ?>>
                                                        <label class="form-check-label rating" for="two">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <span class="ms-1">(<?php if($hotelsAddress1 != null){ $count=0; foreach($hotelsAddress1 as $ad) { if($ad['rating']=='2') $count++;  } echo $count; } ?>)</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-info">
                                <h5><span>i</span> need help</h5>
                                <h4>+91 - 91539 00180</h4>
                                <h6>Monday to Friday 9.00am - 7.30pm</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 ratio3_2">
                    <a href="javascript:void(0)" class="mobile-filter mt-3">
                        <h5>latest filter</h5>
                        <img src="<?=base_url('assets/images/icon/adjust.png')?>" class="img-fluid blur-up lazyload" alt="">
                    </a>
                    <div class="container">
                        <div class="list-view row content grid">
                             <?php if($hotelsAddress != null){
					            echo "<h4 class='text-dark mb-3 pl-md-5 pl-lg-0'><strong>Hotels in ".$this->input->get('location')."</strong></h4>";
    					        foreach($hotelsAddress as $hAddress) :;?>
                                    
                                        
                                        <?php $hotelData = $hotelDetails($hAddress['hotel_id_fk']);  
            								     foreach($hotelData as $hData) :;
            								     
            								     if($hasHotelRooms($hData['hotel_id'])){
            								     
            							?>
            							<div class="list-box col-12 popular grid-item wow fadeInUp">
                                            <div class="list-img">
                                                <a href="<?=base_url('hotels/hoteldetails/'.$hData['hotel_id'])?>">
                                                    <img src="<?=base_url($hData['hotel_image']) ?>"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </div>
                                            <div class="list-content">
                                                <div>
                                                    <a href="<?=base_url('hotels/hoteldetails/'.$hData['hotel_id'])?>">
                                                        <h5><?=$hData['hotel_name'] ?></h5>
                                                    </a>
                                                    <p><?=$hData['hotel_location'].", ".$hData['country'] ?></p>
                                                    <div class="rating">
                                                        <?php   $hotelRating = $hData['rating'];  
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
                                                    <div class="facility-icon">
                                                        <div class="facility-box">
                                                            <img src="<?=base_url('assets/images/icon/hotel/cctv.png')?>"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                            <span>CCTV</span>
                                                        </div>
                                                        <div class="facility-box">
                                                            <img src="<?=base_url('assets/images/icon/hotel/wifi.png')?>"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                            <span>wifi</span>
                                                        </div>
                                                        <div class="facility-box">
                                                            <img src="<?=base_url('assets/images/icon/hotel/shower.png')?>"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                            <span>Shower</span>
                                                        </div>
                                                        <div class="facility-box">
                                                            <img src="<?=base_url('assets/images/icon/hotel/television.png')?>"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                            <span>Television</span>
                                                        </div>
                                                    </div>
                                                    <div class="price">
                                                        <!--<del><?=$hotelPrice($hData['hotel_id'])?></del>-->
                                                        <?=$hotelPrice($hData['hotel_id'])!="N/A"?"₹ ".$hotelPrice($hData['hotel_id'])."<span>/ per night</span>":$hotelPrice($hData['hotel_id'])?> 
                                                        <?php if(!$this->session->userdata('loggedIn')) { ?>
                                                            <p class="mb-0 text-warning">login & unlock a secret deal</p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="top-icon">
                                                        
                                                    </div>
                                                    <div class="offer-box border-0">
                                                        <?php if($this->session->userdata('loggedIn')) { ?>
                									           <?php if($inCart($hData['hotel_id']))
                									                 { 
                									           ?>
                        									            <a disabled><i class="fas fa-shopping-cart text-danger"></i>&nbsp;Added to Cart</a>
                									           <?php 
                									                 }
                									                 else
                									                 {
                									           ?>
                									                    <a href="<?=base_url('hotels/addToCart/').$hData['hotel_id']?>" class="text-dark" data-bs-toggle="tooltip" data-placement="top" title="Add to Cart" data-original-title="Add to Cart">
                                                                            <i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart
                                                                        </a>
                									           <?php
                									                 }
                									           ?>
                									   <?php }
                									         else
                									         {
                									   ?>
                									            <a href="<?=base_url('hotels/addToCart/').$hData['hotel_id']?>" class="text-dark" data-bs-toggle="tooltip" data-placement="top" title="Add to Cart" data-original-title="Add to Cart">
                                                                    <i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart
                                                                </a> 
                									   <?php }
                									   ?>
                                                        
                                                    </div>
                                                    <a href="<?=base_url('hotels/hoteldetails/'.$hData['hotel_id'])?>" class="btn btn-solid color1 book-now">book now</a>
                                                </div>
                                            </div>
                                            <?php if($hData['priority']==1) { ?>
                                                <div class="label-offer">Recommended</div>
                                            <?php } ?>
                                        </div>
                                        <?php } endforeach;?>
                                    
                                    
                            <?php 
    						    endforeach;
    						?>
						        <!--<nav aria-label="Page navigation example" class="pagination-section">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>-->
    						  <?php
					            }
					            else{
					                echo "<h4 class='text-dark mb-2'><strong>We are coming soon in ".$this->input->get('location')."</strong></h4>";
					            }
    						 ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->


<?php include('includes/footer.php') ?>
<?php include('includes/scripts.php') ?>
<script>

$(document).ready(function () {
        if ($(window).width() > 991) {
            $(".product_img_scroll, .pro_sticky_info").stick_in_parent();
        }
    });

function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

$('.amenities').click(function() {
    
    if($(this).prop("checked") == false)
    {
        var originalURL = window.location.href;
        var alteredURL = removeParam("amenity", originalURL);
        window.location.href = alteredURL;
    }
    else{
        var originalURL = window.location.href;
        var alteredURL = removeParam("amenity", originalURL);
        var amnVal = $(this).val();
        window.location.href = alteredURL + "&amenity=" + amnVal;
    }
});
  
$('.ratings').click(function() {
    if($(this).prop("checked") == false)
    {
        var originalURL = window.location.href;
        var alteredURL = removeParam("ratings", originalURL);
        window.location.href = alteredURL;
    }
    else 
    {
        var originalURL = window.location.href;
        var alteredURL = removeParam("ratings", originalURL);
        var ratingVal = $(this).val();
        window.location.href = alteredURL + "&ratings=" + ratingVal;
    }
        
});

$('#price').change(function(){
    var prc = $(this).val().split(";");
    var originalURL = window.location.href;
    var alteredURL = removeParam("minprice", originalURL);
    var alteredURL1 = removeParam("maxprice", alteredURL);
    window.location.href = alteredURL1 + "&minprice=" + prc[0] + "&maxprice=" + prc[1] ;
});

$(function () {
  
var $range = $(".js-range-slider"),
    $inputFrom = $(".js-input-from"),
    $inputTo = $(".js-input-to"),
    instance,
    min = 399,
    max = 4000,
    from = 0,
    to = 0;

$range.ionRangeSlider({
    type: "double",
    min: min,
    max: max,
    from: <?=$this->input->get('minprice')?$this->input->get('minprice'):0 ?>,
    to: <?=$this->input->get('maxprice')?$this->input->get('maxprice'):1499 ?>,
  prefix: '₹',
    onStart: updateInputs,
    onChange: updateInputs,
    step: 100,
    prettify_enabled: true,
    prettify_separator: ".",
  values_separator: " - ",
  force_edges: true
  

});
instance = $range.data("ionRangeSlider");

function updateInputs (data) {
    from = data.from;
    to = data.to;
    
    $inputFrom.prop("value", from);
    $inputTo.prop("value", to); 
}

$inputFrom.on("input", function () {
    var val = $(this).prop("value");
    
    // validate
    if (val < min) {
        val = min;
    } else if (val > to) {
        val = to;
    }
    
    instance.update({
        from: val
    });
});

$inputTo.on("input", function () {
    var val = $(this).prop("value");
    
    // validate
    if (val < from) {
        val = from;
    } else if (val > max) {
        val = max;
    }
    
    instance.update({
        to: val
    });
});

    });
</script>




</body>

</html>
