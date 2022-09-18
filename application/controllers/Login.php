<?php

class Login extends CI_Controller {
    
	function index()
	{
		$this->load->view('login');
	}
	
	function forgot_password()
	{
	    $this->load->view('forgot-password');
	}
	
	
	
	function login_auth()
    {
        $phone = $this->input->post('mobileNo');
        $this->load->model('loginModel');
        // $this->load->model('Cart');
        $data = $this->loginModel->login($phone);
        if(count($data)>0)
        {
            if($this->input->post('password'))
            {
                if($data[0]['deactivationStatus']!=1){
                    $password = $this->input->post('password');
                    // echo $password."<br>";
                    $pass = $data[0]['password'];
                    // echo $pass."<br>";
                    // echo password_verify($password, $pass);
                    if(password_verify($password, $pass)) 
                    {
                        $this->session->set_userdata('loggedIn',TRUE);
                        $this->session->set_userdata('userid',$data[0]['id']);
                        $this->session->set_userdata('name',$data[0]['name']);
                        $this->session->set_userdata('email',$data[0]['email']);
                        $this->session->set_userdata('phone',$data[0]['phone']);
                        $prev_url = $this->session->userdata('previous_url');
                        return redirect($prev_url);
                        //echo "User Signin successfully with password";
                        // echo $this->session->userdata('userid');
                    }
                    else
                    {
                        $messge = array('message' => 'Invalid Password.','class' => 'alert alert-danger');
                        $this->session->set_flashdata('status',$messge);
                        return redirect('login'); 
                    }
                }
                else
                {
                    return redirect('login/reactivateaccount/'.$data[0]['id']);
                }
            }
            else{
                if($data[0]['deactivationStatus']!=1){
                    $this->session->set_userdata('loggedIn',TRUE);
                    $this->session->set_userdata('userid',$data[0]['id']);
                    $this->session->set_userdata('name',$data[0]['name']);
                    $this->session->set_userdata('email',$data[0]['email']);
                    $this->session->set_userdata('phone',$data[0]['phone']);
                    $prev_url = $this->session->userdata('previous_url');
                    return redirect($prev_url);
                }
                else
                {
                    return redirect('login/reactivateaccount/'.$data[0]['id']);
                }
             
            }
            
        }
        else {
                $data = array(
                        'phone' => $this->input->post('mobileNo')
                );
                $response = $this->loginModel->saveUser($data);
                if($response==true){
                    $data = $this->loginModel->login($phone);
                    $this->session->set_userdata('loggedIn',TRUE);
                    $this->session->set_userdata('userid',$data[0]['id']);
                    $this->session->set_userdata('name',$data[0]['name']);
                    $this->session->set_userdata('email',$data[0]['email']);
                    $this->session->set_userdata('phone',$data[0]['phone']);
                    $prev_url = $this->session->userdata('previous_url');
                    return redirect($prev_url);
                }
        }
        
        
    }
    
    function reactivateaccount($uId)
    {
        $data['userId'] = $uId;
        $this->load->view('reactivate-account',$data);
    }
    
    function accountReactivate()
    {
        $this->load->model('loginModel');
        $uId = $this->input->post('userid');
        $data['deactivationStatus'] = 0;
        $response = $this->loginModel->updateRecords($data,$uId);
        if($response)
        {
            $data1 = $this->loginModel->getUserData($uId);
            $this->session->set_userdata('loggedIn',TRUE);
            $this->session->set_userdata('userid',$data1[0]['id']);
            $this->session->set_userdata('name',$data1[0]['name']);
            $this->session->set_userdata('email',$data1[0]['email']);
            $this->session->set_userdata('phone',$data1[0]['phone']);
            $prev_url = $this->session->userdata('previous_url');
            return redirect($prev_url);
        }
        else
        {
            $messge = array('message' => 'Some technical Error occured. Please try again later','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
            return redirect('login');
        }
    }
    
    function accountStatus()
    {
       $phone = $this->input->post('phone');
        $this->load->model('loginModel');
        $data = $this->loginModel->login($phone);
        if(count($data)>0)
        {
          $data1 = array(
            'accountStatus' => "User Found"
            );
        }
        else{
            $data1 = array(
                'accountStatus' => "User Not Found"
            );
        }
        echo json_encode($data1);
    }
  
    function sendOTP()
    {
        $phone = $this->input->post('phone');
        $curl = curl_init();
        $otp = rand(100000, 999999);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://2factor.in/API/V1/c30b9fb8-5cfa-11ec-b710-0200cd936042/SMS/".$phone."/" .$otp."/Send%20OTP",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        if ($err) {
          $data = array(
              'sentStatus' => "OTP can't be Sent"
              );
        } else {
          $data = array(
              'otp' => $otp,
              'sentStatus' => "Sent"
              );
        }
        
        echo json_encode($data);
         
    }
    
    
    function password_change()
	{
	    $phone = $this->input->post('cnfMobileNo');
	    $pass = $this->input->post('passwordNew');
	    if($phone && $pass)
	    {
	        $this->load->model('loginModel');
	        $response = $this->loginModel->saveNewPassword($phone);
	        if($response)
	        {
	            $messge = array('message' => 'Password Changed Successfully. Login to continue.','class' => 'alert alert-success');
                $this->session->set_flashdata('status',$messge);
                return redirect('login');
	        }
	        else
	        {
	            $messge = array('message' => 'Password cannot be changed Successfully.','class' => 'alert alert-danger');
                $this->session->set_flashdata('status',$messge);
                return redirect('login');
	        }
	    }
	    else
	    {
	       $messge = array('message' => 'Please Enter Required Fields.','class' => 'alert alert-danger');
           $this->session->set_flashdata('status',$messge);
           return redirect('login/changePassword'); 
	    }
        
	}
  
    function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('phone');
        $this->session->unset_userdata('cartItems');

        $this->load->view('login');

    }

}
