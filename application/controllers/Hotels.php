<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotels extends CI_Controller {

    function hotelslist()
	{
	    $location= $this->input->get('location');
	    $minprice = $this->input->get('minprice');
        $maxprice = $this->input->get('maxprice');
	    $amenity = $this->input->get('amenity');
	    $ratings = $this->input->get('ratings');
	    $this->load->model('hotelsModel');
	     // Load cart model
        $this->load->model('cartModel');
        $data['amenities'] = $this->hotelsModel->getAminities();
        if($amenity!==null && $ratings!==null && $maxprice!==null && $maxprice!==null)
        {
            $data['hotelsAddress'] = $this->hotelsModel->getLocationwithFilter($location,$amenity,$ratings,$minprice,$maxprice);
            $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
        }
        else if($amenity!==null && $ratings!==null)
        {
            $data['hotelsAddress'] = $this->hotelsModel->getLocationwithRatingsandAmenity($location,$amenity,$ratings);
            $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
        }
        else if($amenity===null || $ratings===null || ($maxprice===null && $maxprice===null))
        {
            if($maxprice!==null && $maxprice!==null && $ratings!==null)
            {
                $data['hotelsAddress'] = $this->hotelsModel->getLocationwithPriceandRatings($location,$minprice,$maxprice, $ratings);
                $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
            }
            else if($maxprice!==null && $maxprice!==null && $amenity!==null)
            {
                $data['hotelsAddress'] = $this->hotelsModel->getLocationwithPriceandAmenity($location,$minprice,$maxprice, $amenity);
                $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
            }
            else if($amenity!==null)
            {
                $data['hotelsAddress'] = $this->hotelsModel->getLocationwithAmenity($location,$amenity);
                $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
            }
            else if($ratings!==null)
            {
                $data['hotelsAddress'] = $this->hotelsModel->getLocationwithRatings($location,$ratings);
                $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
            }
            else if($maxprice!==null && $maxprice!==null)
            {
                $data['hotelsAddress'] = $this->hotelsModel->getLocationwithPrice($location,$minprice,$maxprice);
                $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
            }
            
            else
            {
                $data['hotelsAddress'] = $this->hotelsModel->getCity($location);
                $data['hotelsAddress1'] = $this->hotelsModel->getCity($location);
            }
        }
	    
        $data['hotelDetails'] = function($hId){
                                $hotelData = $this->hotelsModel->getFullHotelData($hId);
                                return $hotelData;
                             };
        $data['hasHotelRooms'] = function($hId){
                                $rData = $this->hotelsModel->getHotelRoomData($hId);
                                if(count($rData)>0)
                                {
                                    return true;
                                }
                                else{
                                    return false;
                                }
                                
                             };
         $data['hotelAmenities'] = function($hId){
                                $hotelAmenities = $this->hotelsModel->getHotelAmenities($hId);
                                return $hotelAmenities;
                             };
        $data['amenitiesData'] = function($aId){
                                $Amenities = $this->hotelsModel->getAmenities($aId);
                                return $Amenities;
                             };
        $data['hotelPrice'] = function($hId){
                                $price = $this->hotelsModel->getHotelRoomData($hId);
                                if($price)
                                {
                                    return $price[0]['price'];
                                }
                                else
                                {
                                    return "N/A";
                                }
                                
                             };
        $data['inCart'] = function($hId){
                            $uId = $this->session->userdata('userid');
                            $bag = $this->cartModel->getCartItems($uId, $hId);
                            if(count($bag)>0)
                            {
                                    return true;
                            }
                            else
                            {
                                return false;    
                            }
                        };
        $this->dataUnset();
        $this->session->set_userdata('location', $this->input->get('location'));
        $this->session->set_userdata('checkInDate', $this->input->get('checkInDate'));
        $this->session->set_userdata('checkOutDate', $this->input->get('checkOutDate'));
        $this->session->set_userdata('guests', $this->input->get('guests'));
        $currentURL = current_url();
        $params   = $_SERVER['QUERY_STRING'];
        if($params!=null)
            $fullURL = $currentURL . '?' . $params; 
        else
            $fullURL = $currentURL;
        $this->session->set_userdata('previous_url', $fullURL); 
        $this->session->unset_userdata('previous_url1');
        $this->load->view('hotel-list',$data);
	}
	public function hoteldetails($hId)
	{
	   // $hId = $this->input->get('hId');
	    $this->load->model('HotelsModel');
	    $this->load->model('cartModel');
        $data['hoteldetail'] = $this->HotelsModel->getFullHotelData($hId);
        $data['hotelGallery'] = $this->HotelsModel->getHotelGallery($hId);
        $data['amenities'] = $this->HotelsModel->getDetailAmenities($hId);
        $data['hotelPrice'] = function($hId){
                                $price = $this->HotelsModel->getHotelRoomData($hId);
                                if($price)
                                {
                                    return $price[0]['price'];
                                }
                                else
                                {
                                    return "N/A";
                                }
                                
                             };
        $data['hotelRooms'] = $this->HotelsModel->getHotelRoomData($hId);
        $data['inCart'] = function($hId){
                            $uId = $this->session->userdata('userid');
                            $bag = $this->cartModel->getCartItems($uId, $hId);
                            if(count($bag)>0)
                            {
                                    return true;
                            }
                            else
                            {
                                return false;    
                            }
                        };
        // echo "<pre>";
        // print_r($data);
        
        $currentURL = current_url();
        $params   = $_SERVER['QUERY_STRING'];
        if($params!=null)
            $fullURL = $currentURL . '?' . $params; 
        else
            $fullURL = $currentURL;
        $this->session->set_userdata('previous_url', $fullURL);
        $this->session->unset_userdata('previous_url1');
	    $this->load->view('hotel-details', $data);
// 		$this->load->view('hotel-details');
	}
	
	function getRoomPrice()
	{
	    $rId = $this->input->post('rmId');
	    $this->load->model('HotelsModel');
	    $rData = $this->HotelsModel->getHotelRoomFullDetails($rId);
	    if($rData!=null)
        {
          $data = array(
            'roomPrice' => $rData[0]['price'],
            'threeHrsPrice' => $rData[0]['three_hrs_price'],
            'sixHrsPrice' => $rData[0]['six_hrs_price'],
            'roomTitle' => strtolower($rData[0]['room_title']),
            'roomID' => $rData[0]['room_id'],
            );
        }
        echo json_encode($data);
	}

    function addToCart($hId)
	{
	    $this->load->model('BookingModel');
	    $data1 = $this->BookingModel->getBookingData($hId);
	    if(!$this->session->userdata('loggedIn'))
	    {
	        $this->session->set_userdata('previous_url1', $this->session->userdata('previous_url'));
	        $currentURL = current_url();
            $params   = $_SERVER['QUERY_STRING'];
            if($params!=null)
                $fullURL = $currentURL . '?' . $params; 
            else
                $fullURL = $currentURL;
            $this->session->set_userdata('previous_url', $fullURL); 
            redirect('login');
	    }
	    else
	    {
    	    // Load cart model
            $this->load->model('cartModel');
            
            // Add product to the cart
            if($this->cartModel->savetoCart($hId))
            {
                $crtItems = $this->cartModel->getCartItem($this->session->userdata('userid'));
                $this->session->set_userdata('cartItems',count($crtItems));
                $prev_url = $this->session->userdata('previous_url1')?$this->session->userdata('previous_url1'):$this->session->userdata('previous_url');
                return redirect($prev_url);
            }
            else{
                echo "error";
            }
	    }
	    
	}
	
	function bookingdetails($hId)
	{
	    $this->session->set_userdata('hotelId', $hId);
        $this->session->set_userdata('bookingCheckInDate', $this->input->post('bookingCheckInDate'));
        $this->session->set_userdata('bookingCheckOutDate', $this->input->post('bookingCheckOutDate'));
        $this->session->set_userdata('bookingCheckInTime', $this->input->post('bookingCheckInTime'));
        $this->session->set_userdata('bookingCheckOutTime', $this->input->post('bookingCheckOutTime'));
        $this->session->set_userdata('bookingPrice',$this->input->post('bookingPrice'));
        $this->session->set_userdata('percentageAgreed',$this->input->post('percentageAgreed'));
        $this->session->set_userdata('bookedRooms',$this->input->post('bookingRooms'));
        $this->session->set_userdata('totalGuests',$this->input->post('totalGuests'));
        $this->session->set_userdata('guests', $this->input->post('bookingGuests'));
        $this->session->set_userdata('bookingRoomType', $this->input->post('bookingRoomType'));
        $this->session->set_userdata('bookingStayType', $this->input->post('bookingStayType'));
        return redirect('user/hotelbooking');
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
        $this->session->unset_userdata('initialBookingPrice');
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
    
    function filterHotels()
    {
        $location= $this->input->get('location');
        $minprice = $this->input->get('minprice');
        $maxprice = $this->input->get('maxprice');
	    $this->load->model('hotelsModel');
	    $data = $this->hotelsModel->getLocationwithPrice($location,$minprice,$maxprice);
	    echo "<pre>";
	    print_r($data);
	    
    }
    
    /*function emailFormat($uId)
    {
        $this->load->model('bookingModel');
        $data = $this->bookingModel->getBookingData($uId);
         $eml = "
                
            <!DOCTYPE html>
            <html lang='en'>
            
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>CheckIn And CheckOut | Booking</title>
                <link
                    href='https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap'
                    rel='stylesheet'>
                <style type='text/css'>
                    body {
                        font-family: Nunito, sans-serif;
                        position: relative;
                        background: white;
                        font-size: 14px;
                        color: black;
                    }
            
                    ul {
                        margin: 0;
                        padding: 0;
                    }
            
                    li {
                        display: inline-block;
                        text-decoration: unset;
                    }
            
                    a {
                        text-decoration: none;
                    }
            
                    .btn {
                        background-color: #292929;
                        border-color: transparent;
                        -webkit-print-color-adjust: exact;
                        letter-spacing: 0.4px;
                        border-radius: 4px;
                        font-weight: 800;
                        font-size: 14px;
                        line-height: 19px;
                        color: #FFFFFF;
                        cursor: pointer;
                        padding: 7px 13px;
                        -webkit-box-shadow: 1px 11px 20px 0px rgba(233, 179, 14, 0.12);
                        box-shadow: 1px 11px 20px 0px rgba(233, 179, 14, 0.12);
                        text-transform: capitalize;
            
                    }
            
                    .btn:focus {
                        outline: none;
                    }
            
                    .text-center {
                        text-align: center
                    }
            
                    .template-width {
                        width: 724px;
                    }
            
                    .success-img img {
                        width: 10%;
                        margin: 10px 0 10px;
                    }
            
                    .booking-table {
                        width: 100%;
                        border: 1px solid #dddddd;
                        margin-top: 40px;
                    }
            
                    @media (max-width: 767px) {
                        .template-width {
                            width: 550px;
                        }
            
                        .booking-table .booking-td {
                            width: 100% !important;
                            display: block;
                        }
            
                        .booking-table tr .booking-td:first-child {
                            border-right: none !important;
                        }
            
                    }
            
                    @media (max-width: 576px) {
                        .template-width {
                            width: 420px;
                        }
            
                        .success-img h3 {
                            width: 90% !important;
                        }
                    }
            
                    @media (max-width: 480px) {
                        .template-width {
                            width: 300px;
                        }
                    }
                </style>
            </head>
            
            <body style='margin: 80px auto;'>
                <table class='template-width' align='center' border='0' cellpadding='0' cellspacing='0'
                    style='background-color: #fff;  box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);'>
                    <tbody>
                        <tr>
                            <td style='padding: 10px 20px;'>
                                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tbody>
                                        <tr class='header'>
                                            <td align='left' valign='top'>
                                                <a href='https://checkinandcheckout.com'>
                                                    <img src='https://checkinandcheckout.com/assets/images/icon/logo.png' style='width: 100px;' class='main-logo'>
                                                </a>
                                            </td>
                                            <td class='menu' align='right'>
                                                <ul>
                                                    <li>+91-9153900180<br> support@checkinandcheckout.Com</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class='success-img' style='text-align: center;'>
                                <img src='https://checkinandcheckout.com/assets/images/check.png'>
                                 <h2
                                    style='margin: 0 auto; width: 90%;  font-size:calc(18px + (22 - 18) * ((100vw - 320px) / (1920 - 320)));'>
                                    Booking Successful ! Get Ready For Enjoy Your Booking</h2>
                                <h3 style='width: 70%;margin: 5px auto 28px;line-height: 1.4;color: #9a9a9a;font-weight: 400;'>
                                    At <br><b style='color: #747474'>".$data[0]['hotel_name']."</b> <br>".$data[0]['hotel_location']."
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td style='padding: 0 20px;margin-bottom:-100px;'>
                                <table class='booking-table'>
                                    <tbody>
                                        <tr>
                                            <td class='booking-td' style='border-right: 1px solid #dddddd; width: 50%;'>
                                                <h5
                                                    style='margin: 0 0 6px 0; font-size: 18px; border-bottom: 1px solid #dddddd; padding: 10px;'>
                                                    Booking Details</h5>
                                                <table style='padding-left: 10px; color: #616161; padding-bottom: 10px;
                                                padding-top: 5px;'>
                                                    <tbody style='font-size: 16px; line-height: 1.5;'>
                                                        <tr>
                                                            <td>Booking No:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>CICO".$data[0]['id']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Booking Status:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>Confirmed</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Booking Date:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data[0]['created_at']))."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Check In:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data[0]['checkInDate']))."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Check Out:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data[0]['checkOutDate']))."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rooms Type:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['room_title']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stay Type:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['stay_type']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guest:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['guests']." Adults
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rooms:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['booked_rooms']." Room(s)
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class='booking-td' style='width: 50%;'>
                                                <h5
                                                    style='margin: 0 0 6px 0; font-size: 18px; border-bottom: 1px solid #dddddd; padding: 0 10px 10px 10px;'>
                                                    Guest & Payment Details</h5>
                                                <table style='padding-left: 10px; color: #616161; padding-bottom: 10px;
                                                padding-top: 5px;'>
                                                    <tbody style='font-size: 16px; line-height: 1.5;'>
                                                        <tr>
                                                            <td>Name:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['name']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>mobile</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>+91 ".$data[0]['phoneNumber']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td style='font-weight: 700; color: #3c3c3c;'>Payment Details:-</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hotel Charge:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".($data[0]['initial_booking_price']>999?ceil($data[0]['initial_booking_price']/1.12):$data[0]['initial_booking_price'])."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hotel Tax:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".($data[0]['initial_booking_price']>999?($data[0]['initial_booking_price']-ceil($data[0]['initial_booking_price']/1.12)):'0')."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Service Tax:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Payable Amount:</td>
                                                            <td style='font-weight: 650; color: #3c3c3c;'>₹".$data[0]['initial_booking_price']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Paid Amount:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".$data[0]['booking_price']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dues Amount:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".($data[0]['initial_booking_price']-$data[0]['booking_price'])."</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 style='font-size: 18px; padding-right: 24px; margin-bottom: 10px; float: right;'>Final Payable Amount: ₹".($data[0]['initial_booking_price']-$data[0]['booking_price'])."</h5>
                            </td>
                        </tr>
                        ".($data[0]['policies']!=null?"<tr style='color: #616161;'><td style='padding: 0 24px 50px;'><div style='border: 1px solid #dddddd; color:#000000; padding: 0px 24px;'><h3>Hotel Policy:</h3><p>".$data[0]['policies']."</p></div></td></tr>":'')."
                    </tbody>
                </table>
            </body>
            
            </html>
        ";
        
        echo $eml; 
    }
    
    function emailTest($uId)
    {
        $this->load->model('EmailModel');
        $this->load->model('bookingModel');
        $data = $this->bookingModel->getBookingData($uId);
        $fromEmail = "admin@checkinandcheckout.com";
        $toEmail = "tankit5210@gmail.com";
        $subject = "Test Mail";
        $message = "
                
            <!DOCTYPE html>
            <html lang='en'>
            
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>CheckIn And CheckOut | Booking</title>
                <link
                    href='https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap'
                    rel='stylesheet'>
                <style type='text/css'>
                    body {
                        font-family: Nunito, sans-serif;
                        position: relative;
                        background: white;
                        font-size: 14px;
                        color: black;
                    }
            
                    ul {
                        margin: 0;
                        padding: 0;
                    }
            
                    li {
                        display: inline-block;
                        text-decoration: unset;
                    }
            
                    a {
                        text-decoration: none;
                    }
            
                    .btn {
                        background-color: #292929;
                        border-color: transparent;
                        -webkit-print-color-adjust: exact;
                        letter-spacing: 0.4px;
                        border-radius: 4px;
                        font-weight: 800;
                        font-size: 14px;
                        line-height: 19px;
                        color: #FFFFFF;
                        cursor: pointer;
                        padding: 7px 13px;
                        -webkit-box-shadow: 1px 11px 20px 0px rgba(233, 179, 14, 0.12);
                        box-shadow: 1px 11px 20px 0px rgba(233, 179, 14, 0.12);
                        text-transform: capitalize;
            
                    }
            
                    .btn:focus {
                        outline: none;
                    }
            
                    .text-center {
                        text-align: center
                    }
            
                    .template-width {
                        width: 724px;
                    }
            
                    .success-img img {
                        width: 10%;
                        margin: 10px 0 10px;
                    }
            
                    .booking-table {
                        width: 100%;
                        border: 1px solid #dddddd;
                        margin-top: 40px;
                    }
            
                    @media (max-width: 767px) {
                        .template-width {
                            width: 550px;
                        }
            
                        .booking-table .booking-td {
                            width: 100% !important;
                            display: block;
                        }
            
                        .booking-table tr .booking-td:first-child {
                            border-right: none !important;
                        }
            
                    }
            
                    @media (max-width: 576px) {
                        .template-width {
                            width: 420px;
                        }
            
                        .success-img h3 {
                            width: 90% !important;
                        }
                    }
            
                    @media (max-width: 480px) {
                        .template-width {
                            width: 300px;
                        }
                    }
                </style>
            </head>
            
            <body style='margin: 80px auto;'>
                <table class='template-width' align='center' border='0' cellpadding='0' cellspacing='0'
                    style='background-color: #fff;  box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);'>
                    <tbody>
                        <tr>
                            <td style='padding: 10px 20px;'>
                                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tbody>
                                        <tr class='header'>
                                            <td align='left' valign='top'>
                                                <a href='https://checkinandcheckout.com'>
                                                    <img src='https://checkinandcheckout.com/assets/images/icon/logo.png' style='width: 100px;' class='main-logo'>
                                                </a>
                                            </td>
                                            <td class='menu' align='right'>
                                                <ul>
                                                    <li>+91-9153900180<br> support@checkinandcheckout.Com</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class='success-img' style='text-align: center;'>
                                <img src='https://checkinandcheckout.com/assets/images/check.png'>
                                 <h2
                                    style='margin: 0 auto; width: 90%;  font-size:calc(18px + (22 - 18) * ((100vw - 320px) / (1920 - 320)));'>
                                    Booking Successful ! Get Ready For Enjoy Your Booking</h2>
                                <h3 style='width: 70%;margin: 5px auto 28px;line-height: 1.4;color: #9a9a9a;font-weight: 400;'>
                                    At <br><b style='color: #747474'>".$data[0]['hotel_name']."</b> <br>".$data[0]['hotel_location']."
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td style='padding: 0 20px;margin-bottom:-100px;'>
                                <table class='booking-table'>
                                    <tbody>
                                        <tr>
                                            <td class='booking-td' style='border-right: 1px solid #dddddd; width: 50%;'>
                                                <h5
                                                    style='margin: 0 0 6px 0; font-size: 18px; border-bottom: 1px solid #dddddd; padding: 10px;'>
                                                    Booking Details</h5>
                                                <table style='padding-left: 10px; color: #616161; padding-bottom: 10px;
                                                padding-top: 5px;'>
                                                    <tbody style='font-size: 16px; line-height: 1.5;'>
                                                        <tr>
                                                            <td>Booking No:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>CICO".$data[0]['id']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Booking Status:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>Confirmed</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Booking Date:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data[0]['created_at']))."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Check In:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data[0]['checkInDate']))."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Check Out:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data[0]['checkOutDate']))."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rooms Type:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['room_title']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stay Type:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['stay_type']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guest:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['guests']." Adults
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rooms:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['booked_rooms']." Room(s)
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class='booking-td' style='width: 50%;'>
                                                <h5
                                                    style='margin: 0 0 6px 0; font-size: 18px; border-bottom: 1px solid #dddddd; padding: 0 10px 10px 10px;'>
                                                    Guest & Payment Details</h5>
                                                <table style='padding-left: 10px; color: #616161; padding-bottom: 10px;
                                                padding-top: 5px;'>
                                                    <tbody style='font-size: 16px; line-height: 1.5;'>
                                                        <tr>
                                                            <td>Name:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>".$data[0]['name']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>mobile</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>+91 ".$data[0]['phoneNumber']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td style='font-weight: 700; color: #3c3c3c;'>Payment Details:-</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hotel Charge:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".($data[0]['initial_booking_price']>999?ceil($data[0]['initial_booking_price']/1.12):$data[0]['initial_booking_price'])."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hotel Tax:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".($data[0]['initial_booking_price']>999?($data[0]['initial_booking_price']-ceil($data[0]['initial_booking_price']/1.12)):'0')."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Service Tax:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Payable Amount:</td>
                                                            <td style='font-weight: 650; color: #3c3c3c;'>₹".$data[0]['initial_booking_price']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Paid Amount:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".$data[0]['booking_price']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dues Amount:</td>
                                                            <td style='font-weight: 600; color: #3c3c3c;'>₹".($data[0]['initial_booking_price']-$data[0]['booking_price'])."</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 style='font-size: 18px; padding-right: 24px; margin-bottom: 10px; float: right;'>Final Payable Amount: ₹".($data[0]['initial_booking_price']-$data[0]['booking_price'])."</h5>
                            </td>
                        </tr>
                        ".($data[0]['policies']!=null?"<tr style='color: #616161;'><td style='padding: 0 24px 50px;'><div style='border: 1px solid #dddddd; color:#000000; padding: 0px 24px;'><h3>Hotel Policy:</h3><p>".$data[0]['policies']."</p></div></td></tr>":'')."
                    </tbody>
                </table>
            </body>
            
            </html>
        ";
        
        echo $this->EmailModel->send_contact_mail($fromEmail,$toEmail,$subject,$message);
        
        
    }*/
}
