    <!-- latest jquery-->
    <script src="<?=base_url('assets/js/jquery-3.5.1.min.js')?>"></script>

    <!-- date-time picker js -->
    <script src="<?=base_url('assets/js/date-picker.js')?>"></script>

    <!-- tilt effect js-->
    <script src="<?=base_url('assets/js/tilt.jquery.js')?>"></script>
    
    <!-- portfolio js -->
    <script src="<?=base_url('assets/js/jquery.magnific-popup.js')?>"></script>
    <script src="<?=base_url('assets/js/zoom-gallery.js')?>"></script>
    
    <!-- video js-->
    <script src="<?=base_url('assets/js/jquery.vide.min.js')?>"></script>

    <!-- slick js-->
    <script src="<?=base_url('assets/js/slick.js')?>"></script>

    <!-- slick js-->
    <script src="<?=base_url('assets/js/sticky-search.js')?>"></script>
    
    <!-- Price Range js-->
    <script src="<?=base_url('assets/js/price-range.js')?>"></script>

    <!-- Bootstrap js-->
    <script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>

    <!-- lazyload js-->
    <script src="<?=base_url('assets/js/lazysizes.min.js')?>"></script>

    <!-- Theme js-->
    <script src="<?=base_url('assets/js/script.js')?>"></script>
    
    <!-- stick section js -->
    <script src="<?= base_url('assets/js/sticky-kit.js')?>"></script>
    
    <!--flatpicker js -->
    <script src="<?= base_url('assets/js/flatpickr.js')?>"></script>
    
    <!--timepicker-->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    
    <script>
        var date1 = $("#datepicker").flatpickr({
          minDate: new Date(),
          dateFormat: "d-m-Y",
          disableMobile: "true",
          onChange: function(selectedDates, dateStr, instance) {
            date2.set('minDate', dateStr)
          }
        });
        var date2 = $("#datepicker1").flatpickr({
          minDate: new Date(),
          dateFormat: "d-m-Y",
          disableMobile: "true",
          onChange: function(selectedDates, dateStr, instance) {
            date1.set('maxDate', dateStr)
          }
        });
        
        function getFormattedDate(date) {
            let year = date.getFullYear();
            let month = (1 + date.getMonth()).toString().padStart(2, '0');
            let day = date.getDate().toString().padStart(2, '0');
          
            return day + '-' + month + '-' + year;
        }
        
        function getTomorrow() {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1); // even 32 is acceptable
            return `${tomorrow.getDate().toString().padStart(2,'0')}-${(1 + tomorrow.getMonth()).toString().padStart(2,'0')}-${tomorrow.getFullYear()}`;
        }
         $('#location').on('keypress', function(e) {
                return e.which !== 13;
            });
        $(document).ready(function () {
            // $('#datepicker').val(getFormattedDate(new Date()));
            // $('#datepicker1').val(getTomorrow());
            $('#copyrightText').html("Powered by ARD Rooms24 Private Limited &copy; " + new Date().getFullYear() + " <a href='https://www.checkinandcheckout.com/'>CheckInandCheckOut.com</a>. All rights reserved.");

        });
        
        
    
    function showLocation(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                localStorage.clear();
                localStorage.setItem('latitude', latitude);
                localStorage.setItem('longitude', longitude);
                var latlongvalue = position.coords.latitude + "," + position.coords.longitude;
                var input = document.getElementById('location');
                //console.log(latlongvalue);
                var request = new XMLHttpRequest();

                var method = 'GET';
                // var url1 = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=25.6132,85.1564&key=AIzaSyDHaLfxmuqqwZgx93cy6dvIpobwMp3SxGQ&sensor=true';
                var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latlongvalue+'&key=AIzaSyDHaLfxmuqqwZgx93cy6dvIpobwMp3SxGQ&sensor=true';
                var async = true;
        
                request.open(method, url, async);
                request.onreadystatechange = function(){
                  if(request.readyState == 4 && request.status == 200){
                    var data = JSON.parse(request.responseText);
                    var address = data.results[5];
                    var ct =address.formatted_address;
                    var cityName = ct.split(', ');
                    if(input.value==''){
                        input.value = cityName[0];
                    }
                    // console.log(cityName[0]);
                  }
                }
                request.send();
             }
             function errorHandler(err) {
                if(err.code == 1) {
                   console.log("Error: Location Access is denied!");
                } else if( err.code == 2) {
                   console.log("Error: Your Position is unavailable!");
                }
             }
             
             function getLocation(){
                 let ct = document.getElementById('location');
                 if(ct.value=='')
                 {
                    if(navigator.geolocation)
                    {
                       // timeout at 60000 milliseconds (60 seconds)
                       var options = {timeout: 60000};
                       navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
                    } 
                    else
                    {
                       console.log("Sorry, browser does not support geolocation!");
                    }
                 }
             }
            
           
        </script>