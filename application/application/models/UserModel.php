<?php
class UserModel extends CI_Model
{
    function getUser()
    {
        $id= $this->session->userdata('userid');
        
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('users');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function updateUser($userdata)
    {
        $id= $this->session->userdata('userid');
        
        $this->db->where('id',$id);
        return $this->db->update('users',$userdata);
    }
}
?>