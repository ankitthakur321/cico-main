<?php

class Payment extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('HotelsModel');
        $this->load->model('userModel');
        $this->load->model('cartModel');
        $this->load->model('bookingModel');
        $this->load->model('EmailModel');
    }
    
    function paymentSuccessInfo()
    {
        date_default_timezone_set('Asia/Kolkata');
        $uId = $this->session->userdata('userid');
        
        //Saving Booking Records
        $response1 = $this->bookingModel->saveBookingRecords();
        
        $data1 = $this->bookingModel->getBookingData($uId);
        $data2 = $this->HotelsModel->getHotelData($this->session->userdata('hotelId'));
        $data['payment_id'] = $this->input->post('paymentId');
        $data['order_id'] = $this->input->post('orderId');
        $data['checksum'] = $this->input->post('checksum');
        $data['booking_id_fk'] = $data1[0]['id'];
        $data['user_id_fk'] = $this->input->post('uId');
        $data['hotel_id_fk'] = $this->input->post('hotelId');
        $data['payment_date'] = date('Y-m-d h:i:s');
        $data['amount'] = $this->input->post('amount');
        
        // echo "<pre>";
        // print_r($data);
        //Saving Booking Records
        $response2 = $this->bookingModel->savePaymentSuccessRecords($data);
        if($response1 && $response2){
            $data2 = $this->HotelsModel->getFullHotelData($this->session->userdata('hotelId'));
            $fromEmail="admin@checkinandcheckout.com";
            $userEmail = $this->session->userdata('emailId');
            $subject="Hotel Booking Confirmation";
		    $message="<center><img src='https://checkinandcheckout.com/assets/images/icon/logo.png'></center><br>Hello ".$this->session->userdata('uName').",<br />Your booking is successful for the date: ".$this->session->userdata('bookingCheckInDate')." for the hotel ".$data2[0]['hotel_name'].".<br /><br />Thanks and Regards,<br /><a href='checkinandcheckout.com' target='_blank'> CheckInandCheckOut.com</a><br />";
		    $mailSend = $this->EmailModel->send_contact_mail($fromEmail,$userEmail,$subject,$message);
			if($mailSend==true){
			    $message2="Hello there,<br />Your hotel room has been booked by ".$this->session->userdata('uName')." on ".$this->session->userdata('bookingCheckInDate').".<br /><br />Thanks and Regards,<br /><a href='checkinandcheckout.com' target='_blank'> CheckInandCheckOut.com</a><br />";
		        $mailSend2 = $this->EmailModel->send_contact_mail($fromEmail,$data2[0]['owner_email'],$subject,$message2);
		        if($mailSend2==true){
		            $toMail = "supply@checkinandcheckout.com";
		            $message3="Hello there,<br />The hotel room from the hotel ".$data2[0]['hotel_name']." has been booked successfully by ".$this->session->userdata('uName')." on ".$this->session->userdata('bookingCheckInDate')." .<br />";
		            $mailSend3 = $this->EmailModel->send_contact_mail($fromEmail,$toMail,$subject,$message3);
		            if($mailSend3 == true)
		            {
		                $toMail = "booking@checkinandcheckout.com";
    		            $message4="Hello there,<br />The hotel room from the hotel ".$data2[0]['hotel_name']." has been booked successfully by ".$this->session->userdata('uName')." on ".$this->session->userdata('bookingCheckInDate')." .<br />";
    		            $mailSend4 = $this->EmailModel->send_contact_mail($fromEmail,$toMail,$subject,$message3);
		                $messge = array('message' => "Congratulations! The hotel has been successfully booked. Please open the booking tab to see the bookings.",'class' => 'alert alert-success');
                        $this->session->set_flashdata('status',$messge);
                        return redirect('user/profile');
		            }
		            else{
		                $messge = array('message' => 'Congratulations! Your hotel has been booked, but mail is not sent to admin.','class' => 'alert alert-warning');
                        $this->session->set_flashdata('status',$messge);
                        redirect('users/profile');
		            }
		        }
		        else {
    		        $messge = array('message' => 'Your hotel has been booked, but mail is not sent to hotel owner.','class' => 'alert alert-warning');
                    $this->session->set_flashdata('status',$messge);
                    redirect('users/profile');
		        }
			}
			else {
		        $messge = array('message' => 'Your hotel has been booked, but mail is not sent to user.','class' => 'alert alert-warning');
                $this->session->set_flashdata('status',$messge);
                redirect('users/profile');
	        }
        }
        else{
            $messge = array('message' => 'Sorry! The hotel cannot be booked, due to technical error.','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
            return redirect('user/profile');
        }
        
    }
    
    function paymentFailureInfo()
    {
        date_default_timezone_set('Asia/Kolkata');
        $uId = $this->session->userdata('userid');
        $data['payment_id'] = $this->input->post('paymentfailureId');
        $data['order_id'] = $this->input->post('orderfailureId');
        $data['user_id_fk'] = $this->input->post('failureuId');
        $data['hotel_id_fk'] = $this->input->post('failurehotelId');
        $data['payment_date'] = date('Y-m-d h:i:s');
        $data['amount'] = $this->input->post('failureAmount');
        $data['reason'] = $this->input->post('failureReason');
        $data['error_code'] = $this->input->post('errorcode');
        $data['error_description'] = $this->input->post('errorDescription');
        $data['error_source'] = $this->input->post('errorSource');
        
        // echo "<pre>";
        // print_r($data);
        
        // //Saving Booking Records
        $response = $this->bookingModel->savePaymentFailureRecords($data);
        if($response)
        {
            $messge = array('message' => "Payment request failed due to ".$this->input->post('failureReason'),'class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
            return redirect('user/hotelbooking');
        }
        else{
            $messge = array('message' => 'Sorry! The hotel cannot be booked, due to technical error.','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
            return redirect('user/hotelbooking');
        }
    }
    
    
}

?>