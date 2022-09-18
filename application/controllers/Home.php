<?php

class Home extends CI_Controller {
    
	function index()
	{
	    $this->session->set_userdata('previous_url', current_url());
		$this->load->model('hotelsModel');
        $data['recommendedHotels'] = $this->hotelsModel->getRecomendedHotels(); 
        $data['topHotels'] = $this->hotelsModel->getTopHotels(); 
        $data['hotelPrice'] = function($hId){
                                $price = $this->hotelsModel->getHotelRoomData($hId);
                                if($price)
                                {
                                    if($price[0]['price']==0)
                                        return $price[1]['price'];
                                    else
                                        return $price[0]['price'];
                                }
                                else
                                {
                                    return "N/A";
                                }
                                
                             };
        $data['breakfastIncluded'] = function($hId){
                                        $bfst = $this->hotelsModel->getHotelRoomData($hId);
                                        if($bfst)
                                        {
                                            return $bfst[0]['isBreakfast'];
                                        }
                                     };
        $data['allowedPersons'] = function($hId){
                                        $prsns = $this->hotelsModel->getHotelRoomData($hId);
                                        if($prsns)
                                        {
                                            return $prsns[0]['number_of_allowed_person'];
                                        }
                                    };
                                    // echo "<pre>";
                                    // print_r($data);
        $this->dataUnset();
		$this->load->view('home', $data);
	}
	
	function about_us()
	{
	    $this->session->set_userdata('previous_url', current_url());
	   $this->load->view('about-us'); 
	}
	
	function contact_us()
	{
	   $this->session->set_userdata('previous_url', current_url());
	   $this->load->view('contact-us'); 
	}
	
	function list_your_property()
	{
       $this->session->set_userdata('previous_url', current_url());	    
	   $this->load->view('list-your-property'); 
	}
	
	function privacy_policies()
	{
	    $this->session->set_userdata('previous_url', current_url());
	    $this->load->view('privacy-policies'); 
	}
	
	function user_agreement()
	{
	   $this->session->set_userdata('previous_url', current_url());
	   $this->load->view('user-agreement'); 
	}
	
	function careers()
	{
	   $this->session->set_userdata('previous_url', current_url());
	   $this->load->view('careers'); 
	}
	
	function sendMessage()
	{
	    //Loading Email Model
	    $this->load->model('EmailModel');
	    $from = $this->input->post('email');
	    $name = $this->input->post('name');
	    $subject = $this->input->post('subject');
	    $toEmail = "support@checkinandcheckout.com";
	    $message = $this->input->post('message');
	    $newSubject="New Contact Form Submission";
	    $newMessage="Hello there,<br />
	                 There is a new contact form submission.<br><br>
	                 Name: ".$name."<br>
	                 Email-ID : ".$from."<br>
	                 Subject : ".$subject."<br>
	                 Message : ".$message."<br><br>
	                 Thanks and Regards,<br>
	                 <a href='checkinandcheckout.com' target='_blank'> CheckInandCheckOut.com</a><br>";
	                 
	    $mailSend = $this->EmailModel->send_contact_mail($from,$toEmail,$newSubject,$newMessage);
		if($mailSend==true){
		    $messge = array('message' => 'Thank You for contacting Us. We will get in touch with you very soon.','class' => 'alert alert-success');
            $this->session->set_flashdata('status',$messge);
	        return redirect('contact-us');
		}
		else{
		    $messge = array('message' => 'Email is not sent successfully.','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
	        return redirect('contact-us');
		}
	}
	
	function sendPropertyDetails()
	{
	    //Loading Email Model
	    $this->load->model('EmailModel');
	    $toEmail = "admin@checkinandcheckout.com";
	    $newSubject="Regarding Listing of Property";
	    $newMessage="Hello there,<br />
	                 There is a new submission for listing of property.<br><br>
	                 Name: ".$name."<br>
	                 Email-ID : ".$from."<br>
	                 Name : ".$this->input->post('inputName')."<br>
	                 Phone Number : ".$this->input->post('inputPhone')."<br>
	                 Email-ID : ".$this->input->post('inputEmail')."<br>
	                 Designation : ".$this->input->post('inputDesignation')."<br>
	                 Hotel Name : ".$this->input->post('inputHotelName')."<br>
	                 Hotel Phone : ".$this->input->post('inputHotelPhone')."<br>
	                 Hotel Email : ".$this->input->post('inputHotelEmail')."<br>
	                 Address : ".$this->input->post('inputAddress')."<br>
	                 City : ".$this->input->post('inputCity')."<br>
	                 State : ".$this->input->post('inputState')."<br>
	                 Total Rooms : ".$this->input->post('inputRoomNo')."<br>
	                 Property Type : ".$this->input->post('propertyType')."<br><br>";
	                 
	    $mailSend = $this->EmailModel->send_mail($toEmail,$newSubject,$newMessage);
		if($mailSend==true){
		    $messge = array('message' => 'Your Property details has been sent successfully.','class' => 'alert alert-success');
            $this->session->set_flashdata('status',$messge);
	        $this->load->view('list-your-property');
		}
		else{
		    $messge = array('message' => 'Your Property details has not been sent successfully.','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
	        $this->load->view('list-your-property');
		}
	}
	
	 function dataUnset()
    {
        $this->session->unset_userdata('hotelId');
        $this->session->unset_userdata('bookingCheckInDate');
        $this->session->unset_userdata('bookingCheckOutDate');
        $this->session->unset_userdata('bookingCheckInTime');
        $this->session->unset_userdata('bookingCheckOutTime');
        $this->session->unset_userdata('bookingPrice');
        $this->session->unset_userdata('finalBookingPrice');
        $this->session->unset_userdata('percentageAgreed');
        $this->session->unset_userdata('bookedRooms');
        $this->session->unset_userdata('totalGuests');
        $this->session->unset_userdata('guests');
        $this->session->unset_userdata('uName');
        $this->session->unset_userdata('emailId');
        $this->session->unset_userdata('phoneNumber');
        $this->session->unset_userdata('paymentType');
        $this->session->unset_userdata('bookingRoomType');
        $this->session->unset_userdata('bookingStayType');
    }
}

