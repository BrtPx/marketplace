<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function register()
	{	
		$data['title'] = 'Create Your Account & Shop With Confidence.';
		$data['categories'] = $this->product_model->getCategories();
		$this->load->view('common/header2',$data);
		$this->load->view('auth/account/register', $data);
		$this->load->view('common/footer',$data);
	}
    // function for registration of user
    public function register_user(){
        $this->form_validation->set_rules('firstname', 'First name','required|trim');
        $this->form_validation->set_rules('lastname', 'Last name','required|trim');
        $this->form_validation->set_rules('email', 'Email','required|is_unique[ptz_customers.email]|trim',array('is_unique' => 'The email address %s provided already exists in our system. Please signup.'));
        $this->form_validation->set_rules('phone', 'Phone','required|max_length[10]|min_length[10]|trim|is_unique[ptz_customers.phone]|numeric',array('is_unique' => 'The %s number provided already exists.'));
        $this->form_validation->set_rules('password', 'Password','required|trim|min_length[6]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm password','required|trim|min_length[6]|matches[password]');

        // $this->form_validation->set_error_delimiters('<div class="error">','</div>');    
        if ($this->form_validation->run() == false) {
            $message = array(
                'firstName_error' => form_error('firstname'),
                'lastName_error' => form_error('lastname'),
                'email_error' => form_error('email'),
                'phone_error' => form_error('phone'),
                'password_error' => form_error('password'),
                'confirmpassword_error' => form_error('confirmpassword'),
            );
        } else {
            $encrypted_password = $this->encrypt->encode($this->input->post('password'));

            $formData = array(
                'firstname' => html_escape($this->input->post('firstname')),
                'lastname' => html_escape($this->input->post('lastname')),
                'email' => html_escape($this->input->post('email')),
                'phone' => html_escape($this->input->post('phone')),
                'password' => $encrypted_password,
            );
            $result = $this->auth_model->addNewCustomer('ptz_customers', $formData);
            if($result){
                $message = $result;
            }
        }
        echo json_encode($message);    
    }

    public function login(){
        $data['title'] = 'Welcome Please Login';
        $data['categories'] = $this->product_model->getCategories();
        $this->load->view('common/header2',$data);
        $this->load->view('auth/account/login',$data);
        $this->load->view('common/footer',$data);
    }

     // function for login of user
    public function login_user(){
        $email = html_escape($this->input->post('email'));
        $password = html_escape($this->input->post('password'));
        $result = $this->auth_model->get_user_details($email, $password);
        echo json_encode($result);
    }

     // Function to logout any user
    public function user_logout()
    {
         // Destroy all sessions
        $this->session->unset_userdata('access_token');
        $this->session->sess_destroy();
        redirect(base_url(''));
    } 

    public function accounts(){
        if($this->session->userdata('user_login') != 1 ){
            $this->session->set_userdata('redirect-url', base_url('customer/account/index'));
            redirect('account-login');
        }
        $data['title'] = 'My Patazone Account';
        $data['categories'] = $this->product_model->getCategories();
        $data['userInfo'] = $this->product_model->getUserData();
        $data['address'] = $this->auth_model->getUserAddress($this->session->userdata('user_id'));
        $this->load->view('auth/account/account', $data);
    }

    public function customerOrders(){
        $data['title'] = 'My Orders';
        $data['categories'] = $this->product_model->getCategories();
        $data['orders'] = $this->product_model->getOrdersByCustomerId();
        $this->load->view('patazoneaccount/orders', $data);
    }

    public function getCustomerOrders($orderid){
        $orderID = base64_decode($orderid);
        $data['title'] = 'My Orders';
        $data['orderId'] = $orderID;
        $data['categories'] = $this->product_model->getCategories();
        $data['order'] = $this->product_model->getOrderDetails($orderID);
        $data['ordersItems'] = $this->product_model->getOrderItems($orderID);
        $data['address'] = $this->auth_model->getUserAddress($this->session->userdata('user_id'));
        $this->load->view('patazoneaccount/orderdetails', $data);
    }

    public function changeUserPassword(){
        $data['title'] = 'Change Password';
        $data['categories'] = $this->product_model->getCategories();
        $this->load->view('auth/account/changepassword', $data);
    }

    public function changePassword(){
        $this->form_validation->set_rules('currentpass', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('newpass', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirmpass', 'Confirm Password', 'trim|required|matches[newpass]');

        if($this->form_validation->run() == false){
            $message = array(
                'currentPass_error' => form_error('currentpass'),
                'newPass_error' => form_error('newpass'),
                'confPass_error' => form_error('confirmpass')
            );
        } else {
            $user_id = $this->session->userdata('user_id');
            $currentPassword = $this->db->get_where('ptz_customers', array('id' => $user_id))->row()->password;
            $oldPassword = $this->input->post('currentpass');
            $newPassword = $this->input->post('newpass');
            if($oldPassword === $this->encrypt->decode($currentPassword)){
                $correctPassword = $this->encrypt->encode($newPassword);
                if($this->auth_model->changePassword('ptz_customers', $correctPassword, $user_id)):
                    $message = array('response' => 'success', 'message' => 'Your password has been changed successfully.');
                endif;
            } else {
                $message = array('response' => 'error', 'message' => 'The Current password dose not match the existing password.');
            }
        }
        echo json_encode($message);
    }
}