<?php
class LoginModel extends CI_Model{

    function login($data)
    {
        $this->db->select('*');
        $this->db->where("(phone = '$data' OR email = '$data')", NULL, FALSE);
        $this->db->where("(userStatus = 1)");
        $this->db->from('users');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getUserData($uId)
    {
        $this->db->select('*');
        $this->db->where("(id='$uId')");
        $this->db->from('users');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function getAdmins()
    {
        $this->db->select('*');
        $this->db->from('admin_details');
        $query= $this->db->get();
        return $query->result_array();
    }
    
    function saveUser($data)
	{
        $this->db->insert('users',$data);
        return true;
	}
	
	function updateRecords($data,$uId)
    {
      $this->db->where('id', $uId);
      $upd = $this->db->update('users', $data);
      return $upd?true:false;
    }
    
    function saveNewPassword($phone)
    {
        $data['password'] = password_hash($this->input->post('passwordNew'), PASSWORD_DEFAULT);
        $this->db->where('phone', $phone);
        $upd = $this->db->update('users',$data);
        return $upd?true:false;
    }
    
}
?>