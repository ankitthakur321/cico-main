<?php

/***** Hotels Model *****/

class HotelsModel extends CI_Model {
    
    /*Fetching hotels data using location*/
    
    function getCity($location)
    {
        $this->db->select('*, hotels.id as hotelId');
        $this->db->like('hotel_location', $location);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    
    /**** Filtering functions *****/
    
    
    /*Fetching hotels with location and amenity*/
    
    function getLocationwithAmenity($location,$amenity)
    {
        $this->db->select('*, hotels.id as hotelId');
        $this->db->like('hotel_address.hotel_location', $location);
        $this->db->where('hotels_amenities.amenity_id_fk', $amenity);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->join('hotels_amenities', "hotels_amenities.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    /*Fetching hotels with location and ratings*/
    
    function getLocationwithRatings($location,$ratings)
    {
        $this->db->select('*, hotels.id as hotelId');
        $this->db->like('hotel_address.hotel_location', $location);
        $this->db->where('hotels.rating', $ratings);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    /*Fetching hotels with location and amenity and ratings */
    
    function getLocationwithRatingsandAmenity($location,$amenity,$ratings)
    {
        $this->db->select('*, hotels.id as hotelId');
        $this->db->like('hotel_address.hotel_location', $location);
        $this->db->where('hotels_amenities.amenity_id_fk', $amenity);
        $this->db->where('hotels.rating', $ratings);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->join('hotels_amenities', "hotels_amenities.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    /*Fetching hotels with location and minprice and maxprice*/
    
    function getLocationwithPrice($location,$minprice,$maxprice)
    {
        $this->db->select('*, hotels.id as hotelId, hotel_rooms.id as roomid');
        $this->db->like('hotel_address.hotel_location', $location);
        $this->db->where('hotel_rooms.price>=', $minprice);
        $this->db->where('hotel_rooms.price<=', $maxprice+1);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->join('hotel_rooms', "hotel_rooms.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    /*Fetching hotels with location and minprice and maxprice and ratings*/
    
    function getLocationwithPriceandRatings($location,$minprice,$maxprice, $ratings)
    {
        $this->db->select('*, hotels.id as hotelId, hotel_rooms.id as roomid');
        $this->db->like('hotel_address.hotel_location', $location);
        $this->db->where('hotel_rooms.price>=', $minprice);
        $this->db->where('hotel_rooms.price<=', $maxprice+1);
        $this->db->where('hotels.rating', $ratings);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->join('hotel_rooms', "hotel_rooms.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    /*Fetching hotels with location and minprice and maxprice and amenity*/
    
    function getLocationwithPriceandAmenity($location,$minprice,$maxprice, $amenity)
    {
        $this->db->select('*, hotels.id as hotelId, hotel_rooms.id as roomid');
        $this->db->like('hotel_address.hotel_location', $location);
        $this->db->where('hotel_rooms.price>=', $minprice);
        $this->db->where('hotel_rooms.price<=', $maxprice+1);
        $this->db->where('hotels_amenities.amenity_id_fk', $amenity);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->join('hotel_rooms', "hotel_rooms.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->join('hotels_amenities', "hotels_amenities.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    /*Fetching hotels with location and amenity and ratings and minprice and maxprice */
    
    function getLocationwithFilter($location,$amenity,$ratings,$minprice,$maxprice)
    {
        $this->db->select('*, hotels.id as hotelId');
        $this->db->like('hotel_address.hotel_location', $location);
        $this->db->where('hotels_amenities.amenity_id_fk', $amenity);
        $this->db->where('hotels.rating', $ratings);
        $this->db->where('hotel_rooms.price>=', $minprice);
        $this->db->where('hotel_rooms.price<=', $maxprice+1);
        $this->db->from('hotel_address');
        $this->db->join('hotels', 'hotels.id = hotel_address.hotel_id_fk');
        $this->db->join('hotels_amenities', "hotels_amenities.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->join('hotel_rooms', "hotel_rooms.hotel_id_fk = hotel_address.hotel_id_fk");
        $this->db->order_by('hotels.priority', 'desc');
        $this->db->order_by('hotels.id', 'desc');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    /* Fetching All Amenities */
    
    function getAminities()
    {
        $this->db->select('*');
        $this->db->from('amenities');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getHotels($hotelPolicy, $policyVal)
    {
        $this->db->select('*');
        $this->db->from('hotel_policies');
        $this->db->where($hotelPolicy, $policyVal);
        $query= $this->db->get();
        return $query->result_array();
    }
    
    
    
    function getHotelData($hId)
    {
        $this->db->select('*');
        $this->db->where("(id='$hId')");
        $this->db->where("(status='1')");
        $this->db->from('hotels');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    
    
    function getHotelRoomDetails($rId)
    {
        $this->db->select('*');
        $this->db->where("(id='$rId')");
        $this->db->from('hotel_rooms');
        $query= $this->db->get();
        return $query->result_array();
         
    }
    
    function getRecomendedHotels()
    {
        $this->db->select('*');
        $this->db->from('hotels');
        $this->db->where("(priority=1)");
        $this->db->order_by("id", "desc");
        $this->db->limit(3);
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getTopHotels()
    {
        $this->db->select('*');
        $this->db->from('hotels');
        $this->db->where("(rating>=3)");
        $this->db->order_by("id", "desc");
        $this->db->limit(3);
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getHotelAmenities($hId)
    {
        $this->db->select('*');
        $this->db->where("(hotel_id_fk='$hId')");
        $this->db->from('hotels_amenities');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getHotelGallery($hId)
    {
        $this->db->select('*');
        $this->db->where("(hotel_id_fk='$hId')");
        $this->db->from('media');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getAmenities($aId)
    {
        $this->db->select('*');
        $this->db->where("(id='$aId')");
        $this->db->from('amenities');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    
    function getFullHotelData($hId)
    {
        $this->db->select('*, hotels.id as hotel_id');
        $this->db->where("(hotels.id=$hId)");
        $this->db->from('hotels');
        $this->db->join('hotel_address', 'hotel_address.hotel_id_fk = hotels.id');
        $this->db->join('hotel_contacts', 'hotel_contacts.hotel_id_fk = hotels.id');
        $this->db->join('hotel_policies', 'hotel_policies.hotel_id_fk = hotels.id');
        $this->db->join('hotel_owners_details', 'hotel_owners_details.hotel_id_fk = hotels.id');
        $query= $this->db->get();
        return $query->result_array();
    }
    function getDetailAmenities($hId)
    {
        $this->db->select('*');
        $this->db->where("(hotels_amenities.hotel_id_fk=$hId)");
        $this->db->from('hotels_amenities');
        $this->db->join('amenities', 'amenities.id = hotels_amenities.amenity_id_fk');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getHotelRoomData($hId)
    {
        $this->db->select('*, hotel_rooms.id as room_id');
        $this->db->where("(hotel_rooms.hotel_id_fk='$hId')");
        $this->db->from('hotel_rooms');
        $this->db->join('room_pricing', 'room_pricing.room_id_fk=hotel_rooms.id');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getHotelRoomFullDetails($rId)
    {
        $this->db->select('*, hotel_rooms.id as room_id');
        $this->db->where("(hotel_rooms.id='$rId')");
        $this->db->from('hotel_rooms');
        $this->db->join('room_pricing', 'room_pricing.room_id_fk=hotel_rooms.id');
        $query= $this->db->get();
        return $query->result_array();
    }
    
}
?>