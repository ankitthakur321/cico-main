<?php

/***** Agreement Model *****/
class AgreementModel extends CI_Model
{
    
    //Fetching Hotel Agreements with agreement Id
    
    function getAgreement($aId)
    {
        $this->db->select('*');
        $this->db->from('hotel_agreement');
        $this->db->where('id',$aId);
        $query= $this->db->get();
        return $query->result_array();
    }
    
    //Updating Hotel Agreements with agreement Id and data
    
    function updateAgreement($data,$aId)
    {
        $this->db->where('id', $aId);
        return $this->db->update('hotel_agreement', $data);
    }
}
?>