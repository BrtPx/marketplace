<?php
defined('BASEPATH') or exit('N diresct script access allowed');
    class Auth_model extends CI_Model {

         // Login Function
         public function get_user_details($email, $password){
             $this->db->where('email', $email);
             $query = $this->db->get('ptz_customers');
             // Check if query return true.
             if ($query->num_rows() > 0) {
                 foreach ($query->result() as $row) {
                     // Check password is correct or not
                     if ($password == $this->encrypt->decode($row->password)) {
                         // Set user session data.
                         $this->session->set_userdata('user_login', 1);
                         $this->session->set_userdata('user_id', $row->id);
                         $this->session->set_userdata('f_name', $row->firstname);
                         $this->session->set_userdata('l_name', $row->lastname);
                         $this->session->set_userdata('email', $row->email);
                         $this->session->set_userdata('phone', $row->phone);
                         $this->session->set_userdata('date', $row->date_created);
                         $this->session->set_userdata('last_seen', $row->last_login);
                         $this->session->set_userdata('password_update', $row->last_login);
 
                             
                         // Update current login time.
                         $this->db->where('id', $this->session->userdata('user_id'));
                         $this->db->update('ptz_customers', array('last_login' => date("Y-m-d h:i:sa")));
 
                         // Success login message
                         $data = array('response' => 'success', 'message' => 'Login Successfull welcome back '.$this->session->userdata('f_name').' '.$this->session->userdata('l_name'));
                         return $data;
                    } else {
                         // Password error message
                         $data = array('response' => 'error', 'message' => '❌ Invalid login credentials | try again');
                         return $data;
                    }
                 }
            } else {
                 // Wrong email error message
                 $data = array('response' => 'error', 'message' => '❌ Invalid Email Address');
                 return $data;
             }
        }
      
		  // Function for creating new customers email addresses
        public function save_new_customer_email($table, $data)
        {
            return $this->db->insert($table, $data);
        }
        // Function for saving emails sent from the website
        public function save_customer_emailMessage($table, $data)
        {
            return $this->db->insert($table, $data);
        }
        
        public function check_user_email_exists($table, $email)
        {
            $this->db->where('email', $email);
            $query = $this->db->get($table);
            $row = $query->row();
            if ($query->num_rows() === 1 && $row->email) {
                return $row->firstname.' '.$row->lastname;
            } else {
                return false;
            }
        }

         public function addNewCustomer(string $table, array $data){
             $message = '';
             if($table != null && !empty($data)){
                $this->db->insert('ptz_customers', $data);
                $insert_id = $this->db->insert_id();
                if($insert_id){
                    $this->db->where('id', $insert_id);
                    $result = $this->db->get('ptz_customers');
                    if($result->num_rows()>0){
                        foreach($result->result() as $row){
                            $this->session->set_userdata('user_login', 1);
                             $this->session->set_userdata('user_id', $row->id);
                             $this->session->set_userdata('f_name', $row->firstname);
                             $this->session->set_userdata('l_name', $row->lastname);
                             $this->session->set_userdata('email', $row->email);
                             $this->session->set_userdata('phone', $row->phone);
                             $this->session->set_userdata('date', $row->date_created);
                             $this->session->set_userdata('last_seen', $row->last_login);
                             $this->session->set_userdata('password_update', $row->last_login);
                        }
                        $message = array('response' => 'success', 'message' => 'Registration successful.');
                    }else{
                        $message = array('response' => 'error', 'message' => 'Something went wrong |Please try again later.');
                    }
                }else{
                    $message = array('response' => 'error', 'message' => 'Something went wrong |Please try again later.'); 
                }  
             }
             return $message;
         }

         public function getUserAddress($userid){
             if($userid != null){
                $this->db->where('user_id', $userid);
                $query = $this->db->get('ptz_address');
                if($query->num_rows() > 0){
                    return $query->row();
                }else{
                    return '';
                }
             }
         }

         public function changePassword($table, $password, $user_id)
        {
            $data = array( 'password' => $password, 'date_updated' => date("Y-m-d h:i:sa"));
            $this->db->where('id', $user_id);
            return $this->db->update($table, $data);
        }
 
    }