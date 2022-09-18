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
    
    function deactivateUser($u_id, $data)
    {
        $this->db->where('id',$u_id);
        return $this->db->update('users',$data);
    }
}
?>