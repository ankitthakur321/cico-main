<?php

class User extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('HotelsModel');
        $this->load->model('userModel');
        $this->load->model('cartModel');
        $this->load->model('bookingModel');
    }
    
    function profile()
    {
        $data['profile']=$this->userModel->getUser();
        $data['carts']=$this->cartModel->cart();
        $data['upcoming']=$this->bookingModel->getUpcomingBooking();
        $data['completed']=$this->bookingModel->getCompletedBooking();
        $data['cancelled']=$this->bookingModel->getCancelledBooking();
        // echo "<pre>";
        // print_r($data);
        // die;
        $this->load->view('profile',$data);
    }
    
    function userinfo()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'User Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['profile']=$this->userModel->getUser();
            $this->load->view('profile',$data);
        }
        else
        {
            $userdata['name']=$this->input->post('name');
            $userdata['email']=$this->input->post('email');
            $pass=$this->input->post('password');
            
            $userdata['password'] = password_hash($pass, PASSWORD_DEFAULT);
            $response = $this->userModel->updateUser($userdata);
            if($response)
            {
                $msg = array('message' => 'Profile Updated Successfully','class' => 'alert alert-success');
                $this->session->set_flashdata('status',$msg);
                return redirect('user/profile');
            }
            else{
                $msg = array('message' => 'Profile Not Updated Successfully','class' => 'alert alert-success');
                $this->session->set_flashdata('status',$msg);
                return redirect('user/profile');
            }
            
        }
    }
    
    function removeCart($cartid)
    {
        $success=$this->cartModel->removehotels($cartid);
        if($success)
        {
            return redirect('user/profile');
        }
    }
    
    function hotelbooking()
    {
        $hId = $this->session->userdata('hotelId');
        $data['userData']=$this->userModel->getUser();
        $data['hoteldetail'] = $this->HotelsModel->getFullHotelData($hId);
        $data['roomdetail'] = function($rId){
                                    $rData = $this->HotelsModel->getHotelRoomDetails($rId);
                                    return $rData;
                                };
        $price=$this->session->userdata('bookingPrice');
        $percentageAgreed=$this->session->userdata('percentageAgreed');
        $quantity=$this->session->userdata('bookedRooms');
        $data['partPrice'] = $this->partPayment($price, $percentageAgreed, $quantity);
        $this->load->view('booking-page', $data);
    }
    
    function partPayment($price, $percentageAgreed, $quantity)
    {
        if(($price>0) && ($price<=999))
        {
            $price1 = ($percentageAgreed/100)*$price;
            $price2 = $price1 + ($price1 * (18/100)); 
            $temp = floor($price2)+0.5;
            $finalprice = $price2 > $temp?ceil($price2):floor($price2);
            $finalprice = $finalprice * $quantity;
        }
        else if($price >= 1000)
        {
            $price1 = ($price / (1.12));
            $price2 = ($percentageAgreed/100)*$price1;
            $price3 = $price2 + ($price2 * (18/100));
            $temp = floor($price3)+0.5;
            $finalprice = $price3 > $temp?ceil($price3):floor($price3);
            $finalprice = $finalprice * $quantity;
        }
        
        return $finalprice;
    }
    
    
    function pay()
    {
        $this->session->set_userdata('uName', $this->input->post('userName'));
        $this->session->set_userdata('emailId', $this->input->post('userEmail'));
        $this->session->set_userdata('phoneNumber', $this->input->post('userPhone'));
        $this->session->set_userdata('paymentType', $this->input->post('paymentType'));
        $this->session->set_userdata('initialbookingPrice', $this->input->post('initialBookingPrice'));
        $this->session->set_userdata('finalbookingPrice', $this->input->post('finalBookingPrice'));
        
        $data['amount'] = $this->input->post('finalBookingPrice');
        $amount = $this->input->post('finalBookingPrice');
        $this->load->helper('order_helper');
        $orderId = fetchId($amount);
        $data['orderId'] = $orderId;
        
        $response = $this->bookingModel->savepaymentRequestData($orderId);
        $this->load->view('pay', $data);
    }
    
    function checkEmail()
    {
        $email = $this->input->post('oldEmail');
        $this->load->model('loginModel');
        $data = $this->loginModel->login($email);
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
    
    function checkPassword()
    {
        $uId = $this->session->userdata('userid');
        $this->load->model('loginModel');
        $data = $this->loginModel->getUserData($uId);
        $password = $this->input->post('oldPassword');
        $pass = $data[0]['password'];
        if(password_verify($password, $pass)) 
        {
            $data1 = array(
                'passwordStatus' => "Password Matched"
            );
        }
        else{
            $data1 = array(
                'passwordStatus' => "Password Not Matched"
            );
        }
        echo json_encode($data1);
    }
    
    function updateEmail()
    {
        $data['email'] = $this->input->post('newEmail');
        $uId = $this->session->userdata('userid');
        $this->load->model('loginModel');
        $response = $this->loginModel->updateRecords($data,$uId);
        if($response)
        {
            $msg = array('message' => 'Email Changed Successfully','class' => 'alert alert-success');
            $this->session->set_flashdata('status',$msg);
            return redirect('user/profile');
        }
        else
        {
            $msg = array('message' => 'Email Not Changed Successfully','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$msg);
            return redirect('user/profile');
        }
    }
    
    function updatePassword()
    {
        
        $data['password'] = password_hash($this->input->post('newPassword'), PASSWORD_DEFAULT);
        $uId = $this->session->userdata('userid');
        $this->load->model('loginModel');
        $response = $this->loginModel->updateRecords($data,$uId);
        if($response)
        {
            $msg = array('message' => 'Password Changed Successfully','class' => 'alert alert-success');
            $this->session->set_flashdata('status',$msg);
            return redirect('user/profile');
        }
        else
        {
            $msg = array('message' => 'Password Not Changed Successfully','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$msg);
            return redirect('user/profile');
        }
    }
    
    function cancelBooking()
    {
        $this->load->model('BookingModel');
        $uId = $this->session->userdata('userdata');
        $bId = $this->input->post('bookingId');
        $data['booking_id_fk'] = $bId;
        if($this->input->post('locationIssue'))
        {
            $data['location'] = $this->input->post('locationIssue');
        }
        if($this->input->post('hygienIssue'))
        {
            $data['hygien'] = $this->input->post('hygienIssue');
        }
        if($this->input->post('amenitiesIssue'))
        {
            $data['amenities_issue'] = $this->input->post('amenitiesIssue');
        }
        if($this->input->post('behaviourIssue'))
        {
            $data['behaviour_and_harrasment'] = $this->input->post('behaviourIssue');
        }
        if($this->input->post('moneyIssue'))
        {
            $data['asking_for_extra_money'] = $this->input->post('moneyIssue');
        }
        if($this->input->post('betterDealIssue'))
        {
            $data['found_better_deal'] = $this->input->post('betterDealIssue');
        }
        if($this->input->post('checkinDeniedIssue'))
        {
            $data['checkin_denied'] = $this->input->post('checkinDeniedIssue');
        }
        if($this->input->post('religionIssue'))
        {
            $data['religion'] = $this->input->post('religionIssue');
        }
        if($this->input->post('ageIssue'))
        {
            $data['age'] = $this->input->post('ageIssue');
        }
        if($this->input->post('idproofIssue'))
        {
            $data['id_proof'] = $this->input->post('idproofIssue');
        }
        if($this->input->post('pricingIssue'))
        {
            $data['pricing'] = $this->input->post('pricingIssue');
        }
        if($this->input->post('restrictionsIssue'))
        {
            $data['restrictions'] = $this->input->post('restrictionsIssue');
        }
        if($this->input->post('describeIssue'))
        {
            $data['other'] = $this->input->post('describeIssue');
        }
        
        $response= $this->BookingModel->saveCancelBookingReasonData($data);
        if($response)
        {
            $data1['cancelled_status'] = 1;
            $data1['cancelled_by'] = "USER";
            $data1['cancelled_at'] = date("Y-m-d h:i:s");
            $data1['checkIn_status'] = 0;
            $data1['checkOut_status'] = 0;
            $response1 = $this->BookingModel->updateBooking($bId,$data1);
            if($response1)
            {
                $msg = array('message' => 'Booking Cancelled Successfully','class' => 'alert alert-success');
                $this->session->set_flashdata('status',$msg);
                return redirect('user/profile');
            }
        }
        else
        {
            $msg = array('message' => 'Booking does not cancelled successfully','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$msg);
            return redirect('user/profile');
        }
    }
    
    function bookingDetail()
    {
        $b_id=$this->uri->segment(3);
        
        $this->load->model('bookingModel');
        $data['booking_detail']=$this->bookingModel->bookingDetails($b_id);
        // echo "<pre>";
        // print_r($data);
        // die;
        $this->load->view('bookingdetail',$data);
    }
    
    
}

?>