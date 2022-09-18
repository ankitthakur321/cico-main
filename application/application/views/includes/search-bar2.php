<!-- section start -->
<section class="home_section p-0 animation-bg">
        <div class="py-4">
                <div class="container custom-container mix-layout-section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class=" home-content mix-layout smaller-content">
                                <div class="bg-transparent">
                                    <div id="sticky_cls">
                                        <div class="search-panel">
                                            <div class="search-section">
                                                <div class="search-box rounded10">
                                                    <?php $attributes = array('method' => 'GET'); 
                                                                echo form_open('hotels/hotelslist', $attributes)?>
                                                        <div class="left-part">
                                                            <div class="search-body title-hotel">
                                                                <h6>Location</h6>
                                                                <input type="text" name="location" id="location"  placeholder="Where are you?" onclick="getLocation()" class="form-control" value="<?=$this->session->userdata('location')?>" required>
                                                                <script>
                                                            		var options = {
                                                                    //   types: ['(cities)'],
                                                                      componentRestrictions: {country: "in"}
                                                                     };
                                                
                                                                    google.maps.event.addDomListener(window, 'load', initialize);
                                                                	function initialize() {
                                                                		var input = document.getElementById('location');
                                                                		var autocomplete = new google.maps.places.Autocomplete(input, options);
                                                                			google.maps.event.addListener(autocomplete,'place_changed', function() {
                                                                			    var place = autocomplete.getPlace();
                                                                			    localStorage.clear();
                                                                			    localStorage.setItem('latitude', place.geometry.location.lat());
                                                                                localStorage.setItem('longitude', place.geometry.location.lng());
                                                                                var cityName = input.value.split(', ');
                                                                                if(cityName.length==2){
                                                                                   cityName.pop(); 
                                                                                }
                                                                                else{
                                                                                    cityName.pop();
                                                                                    cityName.pop();
                                                                                }
                                                                                input.value = cityName;
                                                                    		});
                                                                    	
                                                                	} 
                                                                </script>
                                                            </div>
                                                            <div class="search-body">
                                                                <h6>check in</h6>
                                                                <input placeholder="CheckIn Date" id="datepicker" name="checkInDate" class="form-control bg-transparent" value="<?=$this->session->userdata('checkInDate')?>" autocomplete="off" />
                                                            </div>
                                                            <div class="search-body">
                                                                <h6>check out</h6>
                                                                <input placeholder="CheckOut Date" id="datepicker1" name="checkOutDate" class="form-control bg-transparent" value="<?=$this->session->userdata('checkOutDate')?>" autocomplete="off" />
                                                            </div>
                                                            <div class="search-body">
                                                                <h6>guests</h6>
                                                                <div class="qty-box">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <button type="button"
                                                                                class="btn quantity-left-minus"
                                                                                data-type="minus" data-field="">
                                                                                <i class="fas fa-chevron-down"></i>
                                                                            </button>
                                                                        </span>
                                                                        <input type="text" name="guests"
                                                                            class="form-control input-number bg-transparent" value="<?=$this->session->userdata('guests')?>" readonly>
                                                                        <span class="input-group-prepend">
                                                                            <button type="button"
                                                                                class="btn quantity-right-plus"
                                                                                data-type="plus" data-field="">
                                                                                <i class="fas fa-chevron-up"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="search-body btn-search">
                                                                <div class="right-part">
                                                                    <button type="submit" class="btn btn-solid color1">search</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
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
    <!-- section end -->