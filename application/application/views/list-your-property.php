<?php include('includes/header.php')?>
<?php include('includes/navbar.php')?>

<div class="container-fluid py-5">
			    <div class="row d-flex justify-content-center ">
			        <div class="col-lg-6">
			            <div class="card shadow">
        			        <div class="card-header text-center bg-danger p-3">
        			            <h4 style="color:white;"><span>List Your Property</span></h4>
        			        </div>
        			        <div class="card-body">
        			            <?php

                                    if($this->session->flashdata('status')) {
                                    $message = $this->session->flashdata('status');
                                ?>
                                    <div class="mt-5 <?php echo $message['class'] ?> alert-dismissible fade show" role="alert">
                                        <?php echo $message['message']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>    
                                    </div>
                                <?php
                                    }
                                ?>
            			        <form class="row g-3 p-3" method="POST" action="<?=site_url('home/sendPropertyDetails')?>">
            			            <div class="col-12">
                                        <label for="propertyType" class="form-label">Select Property Type</label>
										<select id="propertyType" name="propertyType" class="form-select" required>
											<option value="">Choose One</option>
											<option value="HOTEL">HOTEL</option>
											<option value="VILLLA">VILLA</option>
											<option value="HOLIDAY HOMES">HOLIDAY HOMES</option>
											<option value="APARTMENTS">APARTMENTS</option>
											<option value="FARMHOUSE">FARMHOUSE</option>
											<option value="HOUSEBOAT">HOUSEBOAT</option>
											<option value="GUEST HOUSE">GUEST HOUSE</option>
											<option value="RESORT">RESORT</option>
											<option value="HOME STAY">HOME STAY</option>
											<option value="PALACES">PALACES</option>
										</select>
                                    </div>
            			            <div class="col-12">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Enter Name" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPhone" class="form-label">Mobile Number</label>
                                        <input type="phone" class="form-control" id="inputPhone" name="inputPhone" placeholder="Enter Mobile Number" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter Email Address" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputDesignation" class="form-label">Designation</label>
                                        <input type="text" class="form-control" id="inputDesignation" name="inputDesignation" placeholder="Enter Designation" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputHotelName" class="form-label">Hotel Name</label>
                                        <input type="text" class="form-control" id="inputHotelName" name="inputHotelName" placeholder="Enter Hotel Name" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputHotelPhone" class="form-label">Mobile Number</label>
                                        <input type="phone" class="form-control" id="inputHotelPhone" name="inputHotelPhone" placeholder="Enter Hotel Mobile Number" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputHotelEmail" class="form-label">Hotel Email</label>
                                        <input type="email" class="form-control" id="inputHotelEmail" name="inputHotelEmail" placeholder="Enter Hotel Email Address" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Enter Hotel Address" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Enter City" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">State</label>
                                        <select name="inputState" class="form-control" id="inputState" required>
                                            <option value="" selected="selected" disabled>Select State/UT *</option>
                                            <option value="Andaman and Nicobar">Andaman and Nicobar</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Dadra And Nagar Haveli">Dadra And Nagar Haveli</option>
                                            <option value="Daman And Diu">Daman And Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Ladakh">Ladakh</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Puducherry">Puducherry</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                        </select>
                                    </div>
                                     <div class="col-md-12">
                                        <label for="inputRoomNo" class="form-label">Number of Rooms</label>
                                        <input type="text" class="form-control" id="inputRoomNo" name="inputRoomNo" placeholder="Number of Rooms" required>
                                    </div>
                                  <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-danger btn-block">Send Details</button>
                                  </div>
                                </form>
                            </div>
        			    </div>
			        </div>
			        
			    </div>
			    
			</div>



<?php include('includes/footer.php') ?>
<?php include('includes/scripts.php') ?>

</body>

</html>