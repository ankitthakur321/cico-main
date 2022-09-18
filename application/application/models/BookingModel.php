<?php

class BookingModel extends CI_Model {
    
    function saveBookingRecords()
    {
        date_default_timezone_set('Asia/Kolkata');
        $data['user_id_fk'] = $this->session->userdata('userid');
        $data['hotel_id_fk'] = $this->session->userdata('hotelId');
        $data['room_id_fk'] = $this->session->userdata('bookingRoomType');
        $data['stay_type'] = $this->session->userdata('bookingStayType');
        $data['name'] = $this->session->userdata('uName');
        $data['phoneNumber'] = $this->session->userdata('phoneNumber');
        $data['emailAddress'] = $this->session->userdata('emailId');
        $data['checkInDate'] = date('Y-m-d h:i:s', strtotime($this->session->userdata('bookingCheckInDate')));
        $data['checkOutDate'] = date('Y-m-d h:i:s', strtotime($this->session->userdata('bookingCheckOutDate')));
        $data['checkInTime'] = date('h:i:s', strtotime($this->session->userdata('bookingCheckInTime')));
        $data['checkOutTime'] = date('h:i:s', strtotime($this->session->userdata('bookingCheckOutTime')));
        $data['guests'] = $this->session->userdata('guests');
        $data['total_rooms'] = $this->session->userdata('bookedRooms');
        $data['initial_booking_price'] = $this->session->userdata('initialbookingPrice');
        $data['booking_price'] = $this->session->userdata('finalbookingPrice');
        $data['payment_type'] = $this->session->userdata('paymentType');
        $data['payment_mode'] = "Online Mode";
        $data['status'] = 1;
        $data['cancelled_status'] = 0;
        $data['created_at'] = date('Y-m-d h:i:s');
        $ins = $this->db->insert('hotel_booking',$data);
        return $ins?true:false;
    }
    function getBookingData($uId)
    {
        $this->db->select('*');
        $this->db->where("(user_id_fk='$uId')");
        $this->db->from('hotel_booking');
        $this->db->order_by("id","desc");
        $this->db->limit(1);
        $query= $this->db->get();
        return $query->result_array();
    }
    
   function getTodayBooking($hId)
   {
       $this->db->select('*');
       $this->db->where("(hotel_id_fk='$hId')");
       $this->db->where("(checkInDate >= now())");
       $this->db->from('hotel_booking');
       $query= $this->db->get();
       return $query->result_array();
   }
   
   function getUpcomingBooking()
   {
       $uId= $this->session->userdata('userid');
        
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
        $this->db->select('*, hotel_booking.id as bookingid');
        $this->db->from('hotel_booking');
        $this->db->where("(user_id_fk='$uId')");
        $this->db->where('DATE(checkInDate)>=',$curr_date);
        $this->db->where('cancelled_status',0);
        $this->db->join('hotels', 'hotels.id = hotel_booking.hotel_id_fk');
        $this->db->join('hotel_rooms', 'hotel_rooms.id = hotel_booking.room_id_fk');
        $query= $this->db->get();
        return $query->result_array();
   }
   
   function getCompletedBooking()
   {
        $uId= $this->session->userdata('userid');
       
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
        $this->db->select('*, hotel_booking.id as bookingid');
        $this->db->from('hotel_booking');
        $this->db->where("(user_id_fk='$uId')");
        $this->db->where('DATE(checkInDate)<',$curr_date);
        $this->db->where('cancelled_status',0);
        $this->db->join('hotels', 'hotels.id = hotel_booking.hotel_id_fk');
        $this->db->join('hotel_rooms', 'hotel_rooms.id = hotel_booking.room_id_fk');
        $query= $this->db->get();
        return $query->result_array();
   }
   
   function getCancelledBooking()
   {
       $uId= $this->session->userdata('userid');
       
        $this->db->select('*, hotel_booking.id as bookingid');
        $this->db->from('hotel_booking');
        $this->db->where("(user_id_fk='$uId')");
        $this->db->where('cancelled_status',1);
        $this->db->join('hotels', 'hotels.id = hotel_booking.hotel_id_fk');
        $this->db->join('hotel_rooms', 'hotel_rooms.id = hotel_booking.room_id_fk');
        $query= $this->db->get();
        return $query->result_array();
   }
   
   function savePaymentSuccessRecords($data)
   {
       return $this->db->insert('payment_success',$data);
   }
   
   function savePaymentFailureRecords($data)
   {
       return $this->db->insert('payment_failure',$data);
   }

    function savepaymentRequestData($orderId)
    {
        $data['order_id'] = $orderId;
        $data['user_id_fk'] = $this->session->userdata('userid');
        $data['hotel_id_fk'] = $this->session->userdata('hotelId');
        $data['amount'] = $this->input->post('finalBookingPrice');
        $data['payment_date'] = date('Y-m-d h:i:s');
        return $this->db->insert('payment_request',$data);
    }
    
    function updateBooking($bId,$data)
    {    
        $this->db->where('id',$bId);
        return $this->db->update('hotel_booking',$data);
    }
    
    function saveCancelBookingReasonData($data)
    {
        return $this->db->insert('cancelled_bookings_reason',$data);
    }
    
    function bookingDetails($b_id)
    {
        $this->db->select('hotel_booking.*,hotel_booking.total_rooms as booked_rooms, hotels.*, hotel_rooms.room_title, hotel_address.*');
        $this->db->where('hotel_booking.id', $b_id);
        $this->db->from('hotel_booking');
        $this->db->join('hotels', 'hotels.id = hotel_booking.hotel_id_fk');
        $this->db->join('hotel_rooms', 'hotel_rooms.id = hotel_booking.room_id_fk');
        $this->db->join('hotel_address', 'hotel_address.hotel_id_fk = hotel_booking.hotel_id_fk');
        $query= $this->db->get();
        return $query->result_array();
    }
}
?>