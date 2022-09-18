<?php

/* ******* Email Model ********** */
class EmailModel extends CI_Model{
    
        //Send email Function
        
        function send_mail($to_email,$subject,$message) { 
            $from_email = "admin@checkinandcheckout.com"; 
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://mail.checkinandcheckout.com';
            $config['smtp_port'] = '465';
            $config['smtp_timeout'] = '60';
        
            $config['smtp_user'] = 'admin@checkinandcheckout.com';    //Important
            $config['smtp_pass'] = 'Admin@CICO321#@';  //Important
        
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not 
            
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
       
            $this->email->from($from_email, "CheckInandCheckOut.com"); 
            $this->email->to($to_email);
            $this->email->subject($subject); 
            $this->email->message($message); 

            //Send mail 
            return $this->email->send()?true:false;
        } 
        
        //Send contact email function
        
        function send_contact_mail($fromEmail,$to_email,$subject,$message) { 
            $from_email = $fromEmail; 
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://mail.checkinandcheckout.com';
            $config['smtp_port'] = '465';
            $config['smtp_timeout'] = '60';
        
             $config['smtp_user'] = 'admin@checkinandcheckout.com';    //Important
            $config['smtp_pass'] = 'Admin@CICO321#@';  //Important
        
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not 
            
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
       
             $this->email->from($from_email, "CheckInandCheckOut.com"); 
             $this->email->to($to_email);
             $this->email->subject($subject); 
             $this->email->message($message); 
       
             //Send Mail
             return $this->email->send()?true:false;
        } 

}
?>