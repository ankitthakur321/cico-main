<?php

/********* Cart Model ******/
class CartModel extends CI_Model
{
    //Save to cart function
    
    function savetoCart($hId)
    {
        $data['user_id_fk'] = $this->session->userdata('userid');
        $data['hotel_id_fk'] = $hId;
        return $this->db->insert('cart',$data);
    }
    
    // fetching Cart Items data with userid and hotel id function
    
    function getCartItems($uId,$hId)
    {
         $this->db->select('*');
        $this->db->from('cart');
        $this->db->where('user_id_fk',$uId);
        $this->db->where('hotel_id_fk',$hId);
        $query= $this->db->get();
        return $query->result_array();
    }
    
    // fetching Cart Items data with userid only function
    
    function getCartItem($uId)
    {
         $this->db->select('*');
        $this->db->from('cart');
        $this->db->where('user_id_fk',$uId);
        $query= $this->db->get();
        return $query->result_array();
    }
    
    // fetching Cart Items data with hotel data using userid only function
    
    function cart()
    {
        $id= $this->session->userdata('userid');
        
        $this->db->select('*,hotels.id as hid,cart.id as cid');
        $this->db->where('cart.user_id_fk',$id);
        $this->db->from('cart');
        $this->db->join('hotels', 'hotels.id=cart.hotel_id_fk');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    // Removing Cart Items function
    
    function removehotels($cartid)
    {
        $this->db->where('id',$cartid);
        return $this->db->delete('cart');
    }
}
?>