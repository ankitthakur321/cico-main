<?php

class Agreement extends CI_Controller {
    
	function viewAgreement($aId)
	{
	    $this->load->model('agreementModel');
	    $data['agreement'] = $this->agreementModel->getAgreement($aId);
		$this->load->view('agreement',$data);
	}
	
	function showAgreement($aId)
	{
	    $this->load->model('agreementModel');
	    $data['agreement'] = $this->agreementModel->getAgreement($aId);
		$this->load->view('agreement',$data);
	}
	
	function acceptAgreement($aId)
	{
	    $this->load->model('agreementModel');
	    $data['agreed'] = "Yes";
	    $response = $this->agreementModel->updateAgreement($data, $aId);
	    if($response)
	    {
	        $data1 = $this->agreementModel->getAgreement($aId);
	        $this->load->model('EmailModel');
		    $subject="Accepting Hotel Agreement";
		    $message="<center><img src='https://checkinandcheckout.com/assets/images/logo.png'></center><br>Hello ".$data1[0]['hotel_name'].",<br />Thank you for accepting the hotel agreement policy.<br /><br />Thanks and Regards,<br /><a href='checkinandcheckout.com' target='_blank'> CheckInandCheckOut.com</a><br />";
		    $mailSend = $this->EmailModel->send_mail($data1[0]['hotel_email'],$subject,$message);
			if($mailSend==true){
			    $message2="Hello ".$data1[0]['bd_name'].",<br />The agreement for the hotel ".$data1[0]['hotel_name']." has been successfully accepted by them.<br /><br />Thanks and Regards,<br /><a href='checkinandcheckout.com' target='_blank'> CheckInandCheckOut.com</a><br />";
		        $mailSend2 = $this->EmailModel->send_mail($data1[0]['bd_email'],$subject,$message2);
		        if($mailSend2==true){
		            $toMail = "admin@checkinandcheckout.com";
		            $message3="Hello admin,<br />The agreement for the hotel ".$data1[0]['hotel_name']." has been successfully accepted by them.<br />";
		            $mailSend3 = $this->EmailModel->send_mail($toMail,$subject,$message3);
		            $messge = array('message' => 'Congratulations! You have accepted the agreement.','class' => 'alert alert-success');
                    $this->session->set_flashdata('status',$messge);
        	        $data['agreement'] = $this->agreementModel->getAgreement($aId);
        	        $this->load->view('agreement',$data);
		        }
			    
			}
	    }
	    else{
	        echo "Not Updated";
	    }
	    
	}
	
}
