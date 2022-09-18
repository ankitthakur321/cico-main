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
}
