<?php

class Payment extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('HotelsModel');
        $this->load->model('userModel');
        $this->load->model('cartModel');
        $this->load->model('bookingModel');
        $this->load->model('EmailModel');
    }
    
    function paymentSuccessInfo()
    {
        date_default_timezone_set('Asia/Kolkata');
        $uId = $this->session->userdata('userid');
        
        //Saving Booking Records
        $response1 = $this->bookingModel->saveBookingRecords();
        
        $data1 = $this->bookingModel->getBookingData($uId);
        $data['payment_id'] = $this->input->post('paymentId');
        $data['order_id'] = $this->input->post('orderId');
        $data['checksum'] = $this->input->post('checksum');
        $data['booking_id_fk'] = $data1[0]['id'];
        $data['user_id_fk'] = $this->input->post('uId');
        $data['hotel_id_fk'] = $this->input->post('hotelId');
        $data['payment_date'] = date('Y-m-d h:i:s');
        $data['amount'] = $this->input->post('amount');
        
        // echo "<pre>";
        // print_r($data);
        //Saving Booking Records
        $response2 = $this->bookingModel->savePaymentSuccessRecords($data);
        if($response1 && $response2){
            $data2 = $this->HotelsModel->getFullHotelData($this->session->userdata('hotelId'));
            $fromEmail="admin@checkinandcheckout.com";
            $userEmail = $this->session->userdata('emailId');
            $subject="Hotel Booking Confirmation";
            
            //this message is for user, admin and supply
            
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
                                            At <br><b style='color: #747474'>".$data1[0]['hotel_name']."</b> <br>".$data1[0]['hotel_location']."
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
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>CICO".$data1[0]['id']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Booking Status:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>Confirmed</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Booking Date:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data1[0]['created_at']))."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Check In:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data1[0]['checkInDate']))."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Check Out:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data1[0]['checkOutDate']))."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Rooms Type:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['room_title']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stay Type:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['stay_type']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Guest:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['guests']." Adults
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Rooms:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['booked_rooms']." Room(s)
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
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['name']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>mobile</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>+91 ".$data1[0]['phoneNumber']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style='font-weight: 700; color: #3c3c3c;'>Payment Details:-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hotel Charge:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".($data1[0]['initial_booking_price']>999?ceil($data1[0]['initial_booking_price']/1.12):$data1[0]['initial_booking_price'])."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hotel Tax:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".($data1[0]['initial_booking_price']>999?($data1[0]['initial_booking_price']-ceil($data1[0]['initial_booking_price']/1.12)):'0')."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Service Tax:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Total Payable Amount:</td>
                                                                    <td style='font-weight: 650; color: #3c3c3c;'>₹".$data1[0]['initial_booking_price']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Paid Amount:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".$data1[0]['booking_price']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Dues Amount:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".($data1[0]['initial_booking_price']-$data1[0]['booking_price'])."</td>
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
                                        <h5 style='font-size: 18px; padding-right: 24px; margin-bottom: 10px; float: right;'>Final Payable Amount: ₹".($data1[0]['initial_booking_price']-$data1[0]['booking_price'])."</h5>
                                    </td>
                                </tr>
                                ".($data1[0]['policies']!=null?"<tr style='color: #616161;'><td style='padding: 0 24px 50px;'><div style='border: 1px solid #dddddd; color:#000000; padding: 0px 24px;'><h3>Hotel Policy:</h3><p>".$data1[0]['policies']."</p></div></td></tr>":'')."
                            </tbody>
                        </table>
                    </body>
                    
                    </html>
                ";
                
                // Message for Hotel owner
                
        $message2 = "
                
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
                                            At <br><b style='color: #747474'>".$data1[0]['hotel_name']."</b> <br>".$data1[0]['hotel_location']."
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
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>CICO".$data1[0]['id']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Booking Status:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>Confirmed</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Booking Date:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data1[0]['created_at']))."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Check In:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data1[0]['checkInDate']))."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Check Out:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".date('d F, Y', strtotime($data1[0]['checkOutDate']))."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Rooms Type:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['room_title']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stay Type:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['stay_type']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Guest:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['guests']." Adults
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Rooms:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['booked_rooms']." Room(s)
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
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>".$data1[0]['name']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>mobile</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>+91 ".$data1[0]['phoneNumber']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style='font-weight: 700; color: #3c3c3c;'>Payment Details:-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hotel Charge:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".($data1[0]['initial_booking_price']>999?ceil($data1[0]['initial_booking_price']/1.12):$data1[0]['initial_booking_price'])."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hotel Tax:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".($data1[0]['initial_booking_price']>999?($data1[0]['initial_booking_price']-ceil($data1[0]['initial_booking_price']/1.12)):'0')."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Service Tax:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Total Payable Amount:</td>
                                                                    <td style='font-weight: 650; color: #3c3c3c;'>₹".$data1[0]['initial_booking_price']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Paid Amount:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".$data1[0]['booking_price']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Dues Amount:</td>
                                                                    <td style='font-weight: 600; color: #3c3c3c;'>₹".($data1[0]['initial_booking_price']-$data1[0]['booking_price'])."</td>
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
                                        <h5 style='font-size: 18px; padding-right: 24px; margin-bottom: 10px; float: right;'>Final Payable Amount: ₹".($data1[0]['initial_booking_price']-$data1[0]['booking_price'])."</h5>
                                    </td>
                                </tr>
                                ".($data1[0]['policies']!=null?"<tr style='color: #616161;'><td style='padding: 0 24px 50px;'><div style='border: 1px solid #dddddd; color:#000000; padding: 0px 24px;'><h3>Hotel Policy:</h3><p>".$data1[0]['policies']."</p></div></td></tr>":'')."
                            </tbody>
                        </table>
                        <p><strong>Note:</strong> You will have to issue invoice at the time of checkout.</p>
                    </body>
                    
                    </html>
                ";
                
		 $mailSend = $this->EmailModel->send_contact_mail($fromEmail,$userEmail,$subject,$message);
			if($mailSend==true){
			    
			    //this message is for hotel owner
			    $mailSend2 = $this->EmailModel->send_contact_mail($fromEmail,$data2[0]['owner_email'],$subject,$message2);
		        if($mailSend2==true){
		            $toMail = "supply@checkinandcheckout.com";
		            
		            //This mail is for supply 
		            $mailSend3 = $this->EmailModel->send_contact_mail($fromEmail,$toMail,$subject,$message);
		            if($mailSend3 == true)
		            {
		                $toMail = "booking@checkinandcheckout.com";
		                
		                //this message is for admin
    		            $mailSend4 = $this->EmailModel->send_contact_mail($fromEmail,$toMail,$subject,$message);
		                if($mailSend4){
    		                $messge = array('message' => "Congratulations! The hotel has been successfully booked. Please open the booking tab to see the bookings.",'class' => 'alert alert-success');
                            $this->session->set_flashdata('status',$messge);
                            return redirect('user/profile');
		                }
		                else{
    		                $messge = array('message' => 'Congratulations! Your hotel has been booked, but mail is not sent to admin.','class' => 'alert alert-warning');
                            $this->session->set_flashdata('status',$messge);
                            redirect('users/profile');
		                }
		            }
		            else{
		                $messge = array('message' => 'Congratulations! Your hotel has been booked, but mail is not sent to admin.','class' => 'alert alert-warning');
                        $this->session->set_flashdata('status',$messge);
                        redirect('users/profile');
		            }
		        }
		        else {
    		        $messge = array('message' => 'Your hotel has been booked, but mail is not sent to hotel owner.','class' => 'alert alert-warning');
                    $this->session->set_flashdata('status',$messge);
                    redirect('users/profile');
		        }
			}
			else {
		        $messge = array('message' => 'Your hotel has been booked, but mail is not sent to user.','class' => 'alert alert-warning');
                $this->session->set_flashdata('status',$messge);
                redirect('users/profile');
	        }
        }
        else{
            $messge = array('message' => 'Sorry! The hotel cannot be booked, due to technical error.','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
            return redirect('user/profile');
        }
        
    }
    
    function paymentFailureInfo()
    {
        date_default_timezone_set('Asia/Kolkata');
        $uId = $this->session->userdata('userid');
        $data['payment_id'] = $this->input->post('paymentfailureId');
        $data['order_id'] = $this->input->post('orderfailureId');
        $data['user_id_fk'] = $this->input->post('failureuId');
        $data['hotel_id_fk'] = $this->input->post('failurehotelId');
        $data['payment_date'] = date('Y-m-d h:i:s');
        $data['amount'] = $this->input->post('failureAmount');
        $data['reason'] = $this->input->post('failureReason');
        $data['error_code'] = $this->input->post('errorcode');
        $data['error_description'] = $this->input->post('errorDescription');
        $data['error_source'] = $this->input->post('errorSource');
        
        // echo "<pre>";
        // print_r($data);
        
        // //Saving Booking Records
        $response = $this->bookingModel->savePaymentFailureRecords($data);
        if($response)
        {
            $messge = array('message' => "Payment request failed due to ".$this->input->post('failureReason'),'class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
            return redirect('user/hotelbooking');
        }
        else{
            $messge = array('message' => 'Sorry! The hotel cannot be booked, due to technical error.','class' => 'alert alert-danger');
            $this->session->set_flashdata('status',$messge);
            return redirect('user/hotelbooking');
        }
    }
    
    
}

?>