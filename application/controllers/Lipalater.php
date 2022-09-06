<?php

use Google\Service\Docs\Response;

class Lipalater extends CI_Controller
{
    private $client_id;
    private $client_secrete;
    private $token;
    private $base_endpoint;
    private $test_endpoint;
    private $live_endpoint; 

    public function __construct()
    {
        parent::__construct();
        $this->client_id = $this->config->item('lipalater_client_key');
        $this->client_secrete = $this->config->item('lipalater_secrete');
        $this->test_endpoint = $this->config->item('lipalaterTestURL');
        $this->live_endpoint = $this->config->item('lipalaterLiveURL');
        $this->base_endpoint = $this->live_endpoint;
        // $this->token = $this->getAccessToken();
    }

    public function view_lipalater_checkout() // lipalater-checkout
    {
        if ($this->cart->total() < 1) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $data = array(
                    'categories' => $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result(),
                    'title' => 'Buy with lipalater option',
                );
            $this->load->view('checkout/lipalater/lipalaterNewCustomer', $data);
        }
    }

    public function view_lipalater_registration()
    {
        if ($this->cart->total() < 1) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $data = array(
                    'categories' => $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result(),
                    'title' => 'Register as new customer',
                );
            $this->load->view('checkout/lipalater/lipalater', $data);
        }
    }
    
    public function submitLipalaterCustomerPersonalData() // lipalater personal data
    {
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required', array('required' => 'The %s field can not be blank'));
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required', array('required' => 'The %s field can not be blank'));
        $this->form_validation->set_rules('phone', 'phone number', 'trim|required|max_length[10]|min_length[9]', array('required' => 'The %s field can not be blank', 'max_length' => 'Please provide a valid %s', 'min_length' => 'Please provide a valid %s'));
        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[8]|min_length[6]', array('required' => 'The %s field can not be blank', 'max_length' => 'Please provide a valid Identification Number', 'min_length' => 'Please provide a valid Identification Number'));
        $this->form_validation->set_rules('user_dob', 'date of birth', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('marital_status', 'marital status', 'trim|required', array('required' => 'The %s field can not be blank'));
        $this->form_validation->set_rules('gender', 'gender', 'trim|required', array('required' => 'The %s field can not be blank'));
    
        if ($this->form_validation->run() === false) {
            $message = array(
                    'firstNameError' => form_error('first_name'),
                    'lastNameError' => form_error('last_name'),
                    'phoneError' => form_error('phone'),
                    'nationalIdError' => form_error('id'),
                    'dobError' => form_error('user_dob'),
                    'maritalError' => form_error('marital_status'),
                    'genderError' => form_error('gender'),
                );
        } else {
            $firstname = html_escape($this->input->post('first_name'));
            $lastname = html_escape($this->input->post('last_name'));
            $phonenumber = html_escape($this->input->post('phone'));
            $nationalId = html_escape($this->input->post('id'));
            $dateofbirth = html_escape($this->input->post('dob'));
            $maritalstatus = html_escape($this->input->post('marital_status'));
            $gender = html_escape($this->input->post('gender'));
            $view_dob = html_escape($this->input->post('user_dob'));

            $customerPhone = '+254'.substr($phonenumber, 1);
    
            $personalDetails = array(
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'phone_number' => $customerPhone,
                    'id_number' => $nationalId,
                    'date_of_birth' => $dateofbirth,
                    'marital_status' => $maritalstatus,
                    'view_dob' => $view_dob,
                    'gender' => $gender
                );
    
            $this->session->set_userdata($personalDetails);
            $message = array('response' => 'success', 'message' => 'Data saved in session');
        }
        echo json_encode($message);
    }
    
    public function validate_occupation_government_profile()
    {
        $this->form_validation->set_rules('employer', 'employer', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('payment_mode', 'payment mode', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('net_income', 'net income', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('monthly_expense', 'monthly expenses', 'trim|required', array('required' => 'The %s field cannot be blank'));
    
        if ($this->form_validation->run() === false) {
            $message = array(
                    'employer_error' => form_error('employer'),
                    'payment_error' => form_error('payment_mode'),
                    'netIncome_error' => form_error('net_income'),
                    'monthlyExpenses_error' => form_error('monthly_expense')
                );
        } else {
            $employerName = html_escape($this->input->post('employer'));
            $jobGroup = html_escape($this->input->post('job_group'));
            $paymentMethode = html_escape($this->input->post('payment_mode'));
            $netMonthlyIncome = html_escape($this->input->post('net_income'));
            $monthlyExpenses = html_escape($this->input->post('monthly_expense'));
            $is_employed = 'true';
            $employment_sector = 'government_sector';
    
            $formData = array(
                    'employer_g' => $employerName,
                    'job_group_g' => $jobGroup,
                    'payment_mode_g' => $paymentMethode,
                    'net_income_g' => $netMonthlyIncome,
                    'monthly_expenses_g' => $monthlyExpenses,
                    'employed' => $is_employed,
                    'government_sector' => $employment_sector,
                    'employed' => $is_employed
                );
            $this->session->set_userdata($formData);
            $message = array('response' => 'success', 'message' => 'Details saved in session');
        }
        echo json_encode($message);
    }
    
    public function load_payment_page() // lipalater-occupation-data
    {
        if ($this->cart->total() < 1) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $data = array(
                    'categories' => $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result(),
                    'title' => 'Fill employment details'
                );
            $this->load->view('checkout/lipalater/lipalaterEmployment', $data);
        }
    }
    
    public function validate_occupation_private_profile() //validate and save data into session
    {
        $this->form_validation->set_rules('employer', 'employer', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('job_function', 'job function', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('job_level', 'job level', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('payment_mode', 'payment methode', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('net_income', 'net income', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('monthly_expenses', 'monthly expenses', 'trim|required', array('required' => 'The %s field cannot be blank'));
        
    
        if ($this->form_validation->run() === false) { //Error in form fields
            $message = array(
                    'employmentError_msg' => form_error('employer'),
                    'jobFunctionError_msg' => form_error('job_function'),
                    'jobLevalError_msg' => form_error('job_level'),
                    'paymentModeError_msg' => form_error('payment_mode'),
                    'netIncomeError_msg' => form_error('net_income'),
                    'monthlyExpensesError_msg' => form_error('monthly_expenses')

                );
        } else { //No errors found in form fields
            $employer = html_escape($this->input->post('employer'));
            $jobFunction = html_escape($this->input->post('job_function'));
            $jobLevel = html_escape($this->input->post('job_level'));
            $paymenMode = html_escape($this->input->post('payment_mode'));
            $netIncome = html_escape($this->input->post('net_income'));
            $monthlyExpenses = html_escape($this->input->post('monthly_expenses'));
            $is_employed = 'true';
            $employment_sector = 'private_sector';
    
            // Set session data
            $fromData = array(
                    'employer' => $employer,
                    'job_function' => $jobFunction,
                    'job_level' => $jobLevel,
                    'payment_mode' => $paymenMode,
                    'net_income' => $netIncome,
                    'monthly_expenses' => $monthlyExpenses,
                    'employed' => $is_employed,
                    'private_sector' => $employment_sector,
                    'employed' => $is_employed
                );
            $this->session->set_userdata($fromData);
            $message = array('response' => 'success', 'message' => 'Data saved to session');
        }
        echo json_encode($message);
    }
    
    public function more_business_info_page_one()
    {
        if ($this->cart->total() < 1) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $data = array(
                    'categories' => $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result(),
                    'title' => 'Enter your company business information'
                );
            $this->load->view('checkout/lipalater/businessinfo1', $data);
        }
    }
    
    public function submit_self_employed_details()
    {
        $this->form_validation->set_rules('business_type', 'business type', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('payment_mode', 'payment method', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('monthly_personal_expenses', 'monthly personal expense', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('gross_monthly_revenue', 'gross monthly revenue', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('average_business_expenses', 'average business expense', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('business_industry', 'business industry', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('business_name', 'business Name', 'trim|required', array('required' => 'Please provide a %s to continue'));
        $this->form_validation->set_rules('bussiness_location', 'business Location', 'trim|required', array('required' => 'Please provide a %s to continue'));
        $this->form_validation->set_rules('business_registration', 'business registration', 'trim|required', array('required' => 'Please provide a %s to continue'));
    
        if ($this->form_validation->run() === false) {
            $message = array(
                    'businessTypeError' => form_error('business_type'),
                    'paymentError' => form_error('payment_mode'),
                    'personalExpensesError' => form_error('monthly_personal_expenses'),
                    'grossRevenueError' => form_error('gross_monthly_revenue'),
                    'businessIndustryError' => form_error('business_industry'),
                    'businessExpenseError' => form_error('average_business_expenses'),
                    'businessName_error' => form_error('business_name'),
                    'businessLocationError' => form_error('bussiness_location'),
                    'isRegisteredError' => form_error('business_registration')
                );
        } else {
            $businessType = html_escape($this->input->post('business_type'));
            $paymentMethod = html_escape($this->input->post('payment_mode'));
            $businessIndustry = html_escape($this->input->post('business_industry'));
            $monthlyPersonalExpense = html_escape($this->input->post('monthly_personal_expenses'));
            $grossMonthlyRevenue = html_escape($this->input->post('gross_monthly_revenue'));
            $averageBusinessExpense = html_escape($this->input->post('average_business_expenses'));
            $businessName = html_escape($this->input->post('business_name'));
            $businessLocation = html_escape($this->input->post('bussiness_location'));
            $isBusinessRegistered = html_escape($this->input->post('business_registration'));
            $is_employed = "false";
    
            $selfEmployedDetails = array(
                    'business_type' => $businessType,
                    'payment_method' => $paymentMethod,
                    'monthly_personal_expense' => $monthlyPersonalExpense,
                    'gross_monthly_revenue' => $grossMonthlyRevenue,
                    'business_industry' => $businessIndustry,
                    'average_business_expense' => $averageBusinessExpense,
                    'un_employed'=> $is_employed,
                    'business_name' => $businessName,
                    'bussiness_location' => $businessLocation,
                    'business_registration' => $isBusinessRegistered,
                    'not_employes' => $is_employed
                );
            $this->session->set_userdata($selfEmployedDetails);
            $message = array('response' => 'success', 'message' => 'Self employed details added to session');
        }
        echo json_encode($message);
    }
    
    public function view_lipalater_auth() // lipalater-auth
    {
        if ($this->cart->total() < 1) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $data = array(
                    'categories' => $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result(),
                    'title' => 'Lipalater complete registration'
                );
            $this->load->view('checkout/lipalater/lipalaterAuthentication', $data);
        }
    }
    
    public function submit_lipalater_data()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email', array('required' => 'The %s field can not be blank', 'valid_email' => 'Please enter a valid %s address like something@gmail.com'));
        $this->form_validation->set_rules('password', 'password', 'trim|required|callback_valid_password', array('required' => 'The %s field can not be blank'));
        $this->form_validation->set_rules('conf_password', 'confirm password', 'trim|required|matches[password]', array('required' => 'The %s field is required', 'matches' => 'The %s dose not match the password provided'));
    
        if ($this->form_validation->run() === false) {
            $message = array(
                    'emailError_msg' => form_error('email'),
                    'passwordError_msg' => form_error('password'),
                    'confPasswordError_msg' => form_error('conf_password')
                );
        } else {
            $email = html_escape($this->input->post('email'));
            $password = html_escape($this->input->post('password'));
            $firstName = $this->session->userdata('first_name');
            $lastName = $this->session->userdata('last_name');
            $phoneNumber = $this->session->userdata('phone_number');
            $IDNumber = $this->session->userdata('id_number');
            $dateOfBirth = $this->session->userdata('date_of_birth');
            $maritalStatus = $this->session->userdata('marital_status');
            $gender = $this->session->userdata('gender');
    
            if ($this->session->userdata('employer')) {
                $employer = $this->session->userdata('employer');
            } elseif ($this->session->userdata('employer_g')) {
                $employer = $this->session->userdata('employer_g');
            } else {
                $employer = null;
            }
    
            if ($this->session->userdata('job_group_g')) {
                $jobGroup = $this->session->userdata('job_group_g');
            } else {
                $jobGroup = null;
            }
    
            if ($this->session->userdata('job_function')) {
                $jobFunction = $this->session->userdata('job_function');
            } else {
                $jobFunction = null;
            }
    
            if ($this->session->userdata('job_level')) {
                $jobLevel = $this->session->userdata('job_level');
            } else {
                $jobLevel = null;
            }
    
            if ($this->session->userdata('payment_mode')) {
                $paymentMethod = $this->session->userdata('payment_mode');
            } elseif ($this->session->userdata('payment_mode_g')) {
                $paymentMethod = $this->session->userdata('payment_mode_g');
            } elseif ($this->session->userdata('payment_method')) {
                $paymentMethod = $this->session->userdata('payment_method');
            }
    
            if ($this->session->userdata('net_income_g')) {
                $netIncome = $this->session->userdata('net_income_g');
            } elseif ($this->session->userdata('net_income')) {
                $netIncome = $this->session->userdata('net_income');
            } else {
                $netIncome = null;
            }
    
            if ($this->session->userdata('monthly_expenses')) {
                $monthlyExpenses = $this->session->userdata('monthly_expenses');
            } elseif ($this->session->userdata('monthly_expenses_g')) {
                $monthlyExpenses = $this->session->userdata('monthly_expenses_g');
            } else {
                $monthlyExpenses = null;
            }

            if ($this->session->userdata("employed")) {
                $employed = $this->session->userdata("employed");
            } elseif ($this->session->userdata("un_employed")) {
                $employed = $this->session->userdata("un_employed");
            } else {
                $employed = '';
            }

            if ($this->session->userdata("private_sector")) {
                $employement_sector = $this->session->userdata("private_sector");
            } elseif ($this->session->userdata("government_sector")) {
                $employement_sector = $this->session->userdata("government_sector");
            } else {
                $employement_sector = '';
            }

            // Business Name check
            if ($this->session->userdata('business_name')) {
                $businessName = $this->session->userdata('business_name');
            } else {
                $businessName = null;
            }

            // Business Location check
            if ($this->session->userdata('business_location')) {
                $businessLocation = $this->session->userdata('business_location');
            } else {
                $businessLocation = null;
            }

            // Bussiness registration check
            if ($this->session->userdata('business_registration')) {
                $businessRegistration = $this->session->userdata('business_registration');
            } else {
                $businessRegistration = null;
            }
    
            $businessIndustry = $this->session->userdata('business_industry');
            $businessType = $this->session->userdata('business_type');
            $monthlyPersonalExpense = $this->session->userdata('monthly_personal_expense');
            $grossMonthlyRevenue = $this->session->userdata('gross_monthly_revenue');
            $averageBusinessExpense = $this->session->userdata('average_business_expense');
            $country_code = $this->session->userdata('countryCode');
            $cartTotal = $this->cart->total();
    
            $lipalaterDetails = array();
            $lipalaterDetails['email'] = $email;
            $lipalaterDetails['gender'] = $gender;
            $lipalaterDetails['amount'] = $cartTotal;
            $lipalaterDetails['last_name'] = $lastName;
            $lipalaterDetails['first_name'] = $firstName;
            $lipalaterDetails['phone_number'] = $phoneNumber;
            // $lipalaterDetails['marital_status'] = $maritalStatus;
            // $lipalaterDetails['date_of_birth'] = $dateOfBirth;
            // $lipalaterDetails['id_number'] = $IDNumber;
            // $lipalaterDetails['country_code'] = $country_code;
            // $lipalaterDetails['employer'] = $employer;
            // $lipalaterDetails['job_group'] = $jobGroup;
            // $lipalaterDetails['job_function'] = $jobFunction;
            // $lipalaterDetails['job_level'] = $jobLevel;
            // $lipalaterDetails['payment_mode'] = $paymentMethod;
            // $lipalaterDetails['net_income'] = $netIncome;
            // $lipalaterDetails['Monthly_expenses'] = $monthlyExpenses;
            // $lipalaterDetails['business_type'] = $businessType;
            // $lipalaterDetails['monthly_personal_expense'] = $monthlyPersonalExpense;
            // $lipalaterDetails['business_industry'] = $businessIndustry;
            // $lipalaterDetails['average_business_expense'] = $averageBusinessExpense;
            // $lipalaterDetails['gross_monthly_revenue'] = $grossMonthlyRevenue;
            // $lipalaterDetails['password'] = $password;
            // $lipalaterDetails['employement_sector'] = $employement_sector;
            // $lipalaterDetails['employed'] = $employed;
            
            // echo json_encode($lipalaterDetails);
            // die;
            $user_id = $this->settings_model->insertLipalaterData('ptz_lipalatercustomers', $lipalaterDetails);
            $this->session->set_userdata('ll_customerID', $user_id);

            if($employed == "false"){
                $response = json_decode($this->CreateSelfEmployedLimit($firstName, $lastName, $IDNumber, $country_code, $phoneNumber, $employed, $gender, $dateOfBirth, $maritalStatus, $email, $password, $cartTotal, $businessType, $businessName, $paymentMethod, $businessLocation, $grossMonthlyRevenue, $averageBusinessExpense, $monthlyPersonalExpense, $businessIndustry,$businessRegistration));
                if ($response->response != "error") {
                    if ($response->data->data->status == 201 || $response->data->data->status == 200) {
                        if ($response->data->data->data->credit_limit_details->available_limit >= $cartTotal) {
                            $data = $response;
                            $message = array(
                                    "response" => "success",
                                    "status_code" => $response->data->data->status,
                                    "data_updated" => $response->data->data->data->updated,
                                    "firstname" =>strtoupper($response->data->data->data->customer_details->first_name),
                                    "lastname" =>strtoupper($response->data->data->data->customer_details->last_name),
                                    "email" =>$response->data->data->data->customer_details->email,
                                    "id_number" =>$response->data->data->data->customer_details->id_number,
                                    "mobile_number" =>$response->data->data->data->customer_details->mobile_number,
                                    "creditLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->credit_limit, 2),
                                    "availableLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->available_limit, 2),
                                    "credit_status" => $response->data->data->data->credit_limit_details->credit_limit_status,
                                    "upfront_fee" => 'Ksh. '.number_format($response->data->data->data->payment_terms->upfront_fees, 2),
                                    "first_installment" => 'Ksh. '.number_format($response->data->data->data->payment_terms->first_installment, 2),
                                    "minimum_payment" => 'Ksh. '.number_format($response->data->data->data->payment_terms->minimum_payment, 2)
                                );
                            $this->session->set_userdata('lipalater_customer_id', $response->data->data->data->customer_details->id);
                        } elseif ($response->data->data->data->credit_limit_details->available_limit  == 0) {
                            $message = array(
                                    "response" => "zero_limit",
                                    "status_code" => $response->data->data->status,
                                    "message" => '<p>Hello '.strtoupper($response->data->data->data->customer_details->first_name). ' ' .strtoupper($response->data->data->data->customer_details->last_name).'. You do not qualify for a credit limit. You can use other available payment options to complete your order.<a href="'.base_url('checkout').'" >Checkout here.</a></p>'
                                );
                        } elseif ($response->data->data->data->credit_limit_details->available_limit > 0 && $response->data->data->data->credit_limit_details->available_limit < $cartTotal) {
                            $message = array(
                                    "response" => "low_limit",
                                    "status_code" => $response->data->data->status,
                                    "firstname" =>strtoupper($response->data->data->data->customer_details->first_name),
                                    "lastname" =>strtoupper($response->data->data->data->customer_details->last_name),
                                    "creditLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->credit_limit, 2),
                                    "availableLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->available_limit, 2),
                                    "credit_status" => $response->data->data->data->credit_limit_details->credit_limit_status,
                                    "message" => '<p class="text-danger">You have insuficient credit balance to purchse this item(s).<a style="color: blue;" href="'.base_url('checkout').'" >Checkout here.</a></p>'
                                );
                        } else {
                            $message = array(
                                    "response" => "error",
                                    "message" => $response->data->data->title
                                );
                        }    
                        $this->clearLipalaterFormFields();
                    } else {
                        $message = array(
                                "response" => "error",
                                "request_id" => $response->data->data->request_id,
                                "status_code" => $response->data->data->status,
                                "title" => $response->data->data->title,
                                "message" => $response->data->data->details,
                                "data" => $response
                            );
                    }
                } else {
                    $mess = array(
                            "response" => "error",
                            "message"  => "An error has occured please contact the system administrator for help."
                        );
                    $message = json_encode($mess);
                }
            }elseif($employed == "true"){
                $response = json_decode($this->CreateLimit($firstName, $lastName, $IDNumber, $country_code, $phoneNumber, $employed, $gender, $dateOfBirth, $maritalStatus, $email, $password, $cartTotal, $employer, $netIncome, $monthlyExpenses, $jobFunction, $jobLevel, $employement_sector, $jobGroup, $paymentMethod));
                if ($response->response != "error") {
                    if ($response->data->data->status == 201 || $response->data->data->status == 200) {
                        if ($response->data->data->data->credit_limit_details->available_limit >= $cartTotal) {
                            $data = $response;
                            $message = array(
                                    "response" => "success",
                                    "status_code" => $response->data->data->status,
                                    "data_updated" => $response->data->data->data->updated,
                                    "firstname" =>strtoupper($response->data->data->data->customer_details->first_name),
                                    "lastname" =>strtoupper($response->data->data->data->customer_details->last_name),
                                    "email" =>$response->data->data->data->customer_details->email,
                                    "id_number" =>$response->data->data->data->customer_details->id_number,
                                    "mobile_number" =>$response->data->data->data->customer_details->mobile_number,
                                    "creditLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->credit_limit, 2),
                                    "availableLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->available_limit, 2),
                                    "credit_status" => $response->data->data->data->credit_limit_details->credit_limit_status,
                                    "upfront_fee" => 'Ksh. '.number_format($response->data->data->data->payment_terms->upfront_fees, 2),
                                    "first_installment" => 'Ksh. '.number_format($response->data->data->data->payment_terms->first_installment, 2),
                                    "minimum_payment" => 'Ksh. '.number_format($response->data->data->data->payment_terms->minimum_payment, 2)
                                );
                            $this->session->set_userdata('lipalater_customer_id', $response->data->data->data->customer_details->id);
                        } elseif ($response->data->data->data->credit_limit_details->available_limit  == 0) {
                            $message = array(
                                    "response" => "zero_limit",
                                    "status_code" => $response->data->data->status,
                                    "message" => '<p>Hello '.strtoupper($response->data->data->data->customer_details->first_name). ' ' .strtoupper($response->data->data->data->customer_details->last_name).'. You do not qualify for a credit limit. You can use other available payment options to complete your order.<a href="'.base_url('checkout').'" >Checkout here.</a></p>'
                                );
                        } elseif ($response->data->data->data->credit_limit_details->available_limit > 0 && $response->data->data->data->credit_limit_details->available_limit < $cartTotal) {
                            $message = array(
                                    "response" => "low_limit",
                                    "status_code" => $response->data->data->status,
                                    "firstname" =>strtoupper($response->data->data->data->customer_details->first_name),
                                    "lastname" =>strtoupper($response->data->data->data->customer_details->last_name),
                                    "creditLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->credit_limit, 2),
                                    "availableLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit_details->available_limit, 2),
                                    "credit_status" => $response->data->data->data->credit_limit_details->credit_limit_status,
                                    "message" => '<p class="text-danger">You have insuficient credit balance to purchse this item(s).<a style="color: blue;" href="'.base_url('checkout').'" >Checkout here.</a></p>'
                                );
                        } else {
                            $message = array(
                                    "response" => "error",
                                    "message" => $response->data->data->title
                                );
                        }
        
                            
                        $this->clearLipalaterFormFields();
                    } else {
                        $message = array(
                                "response" => "error",
                                "request_id" => $response->data->data->request_id,
                                "status_code" => $response->data->data->status,
                                "title" => $response->data->data->title,
                                "message" => $response->data->data->details
                            );
                    }
                } else {
                    $mess = array(
                            "response" => "error",
                            "message"  => "An error has occured please contact the system administrator for help."
                        );
                    $message = json_encode($mess);
                }
            }else{
                $message = array(
                    "response" => "error",
                    "message" => "Employment type cannot be Null"
                );
            }    
        }
            
        echo json_encode($message);
    }
    
    public function clearLipalaterFormFields():void
    {
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('last_name');
        $this->session->unset_userdata('phone_number');
        $this->session->unset_userdata('id_number');
        $this->session->unset_userdata('date_of_birth');
        $this->session->unset_userdata('marital_status');
        $this->session->unset_userdata('gender');
        $this->session->unset_userdata('employer');
        $this->session->unset_userdata('job_function');
        $this->session->unset_userdata('job_level');
        $this->session->unset_userdata('payment_mode');
        $this->session->unset_userdata('net_income');
        $this->session->unset_userdata('monthly_expenses');
        $this->session->unset_userdata('employer_g');
        $this->session->unset_userdata('job_group_g');
        $this->session->unset_userdata('payment_mode_g');
        $this->session->unset_userdata('payment_method');
        $this->session->unset_userdata('net_income_g');
        $this->session->unset_userdata('monthly_expenses_g');
        $this->session->unset_userdata('business_type');
        $this->session->unset_userdata('monthly_personal_expense');
        $this->session->unset_userdata('business_industry');
        $this->session->unset_userdata('average_business_expense');
        $this->session->unset_userdata('gross_monthly_revenue');
        $this->session->unset_userdata('average_business_expense');
        $this->session->unset_userdata('view_dob');
        $this->session->unset_userdata('user_phone');
        $this->session->unset_userdata('customerNationalId');
        $this->session->unset_userdata('customer_ID'); //New
        $this->session->unset_userdata('countryCode'); //New
        $this->session->unset_userdata('employed'); //New
        $this->session->unset_userdata('un_employed'); //New
        $this->session->unset_userdata('government_sector'); //New
        $this->session->unset_userdata('private_sector'); //New
        // $this->session->unset_userdata('ll_customerID'); //New
        $this->session->unset_userdata('order_id'); //New
        $this->session->unset_userdata('national_id'); //New
        $this->session->unset_userdata('phoneNumber'); //New
        $this->session->unset_userdata('customerName'); //New
        $this->session->unset_userdata('orderId'); //New
        $this->session->unset_userdata('employed'); //New
        $this->session->unset_userdata('not_employed'); //New
    }

    public function clearLipalaterInputs()
    {
        $this->clearLipalaterFormFields();
        echo json_encode(array('response' => 'success', 'message' => 'All form inputs are cleared successfully.'));
    }
    
    /**
     * Validate the password
     *
     * @param string $password
     *
     * @return bool
     */
    public function valid_password($password = '')
    {
        $password = trim($password);
    
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
    
        if (empty($password)) {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
    
            return false;
        }
    
        if (preg_match_all($regex_lowercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must contain at least one lowercase letter.');
    
            return false;
        }
    
        if (preg_match_all($regex_uppercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must contain at least one uppercase letter.');
    
            return false;
        }
    
        if (preg_match_all($regex_number, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
    
            return false;
        }
    
        if (preg_match_all($regex_special, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
    
            return false;
        }
    
        if (strlen($password) < 5) {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
    
            return false;
        }
    
        if (strlen($password) > 20) {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 20 characters in length.');
    
            return false;
        }
    
        return true;
    }

    public function validateExistingCustomer() //Send OTP
    {
        $this->form_validation->set_rules('ll_id', 'national ID', 'trim|required|max_length[8]|min_length[6]', array('required' => 'The %s field can not be blank', 'max_length' => 'Please provide a valid Identification Number', 'min_length' => 'Please provide a valid Identification Number'));
        $this->form_validation->set_rules('ll_Phone_number', 'phone number', 'trim|required|max_length[10]|min_length[10]', array('required' => 'The %s field can not be blank', 'max_length' => 'Please provide %s format as 07*********', 'min_length' => 'Please provide %s format as 07*********'));

        if ($this->form_validation->run() === false) {
            $res = array(
                    'nationalId_error' => form_error('ll_id'),
                    'phone_error' => form_error('ll_Phone_number'),
                );
        } else {
            $nationalID = html_escape($this->input->post('ll_id'));
            $phoneNumber = html_escape($this->input->post('ll_Phone_number'));
            $phone_number = '+254'.substr($phoneNumber, 1);
            $existingCustomerData = array(
                    'phoneNumber' => $phone_number,
                    'national_id' => $nationalID
                );
                
            $this->session->set_userdata($existingCustomerData);
                
            $response = json_decode($this->sendOTP($nationalID, $phone_number));
                
                
            if ($response->data != null) {
                if ($response->response == "success") {
                    if ($response->data->status == 200 || $response->data->status == 201) {
                        $res = array(
                                "response" => "success",
                                "message" => $response->data->data->message,
                                "otp"=>''
                            );
                    } else {
                        $res = array(
                                "response" => "error",
                                "request_id"=>$response->data->request_id,
                                "status"=>$response->data->status,
                                "title"=>$response->data->title,
                                "details"=>$response->data->details,
                                
                            );
                    }
                } else {
                    $res = array(
                            "response" => "error",
                            "message" => "Unable to process request.. please try again"
                        );
                }
            } else {
                $res = array("message"=>"Network Error occured");
            }
        }
        echo json_encode($res);
    }

    public function verifyOTPMessage() //validate OTP code
    {
        $this->form_validation->set_rules('otpSMS', 'OTP', 'trim|required|min_length[6]|max_length[6]', array('required' => 'Please provide %s to continue', 'min_length' => 'Invalid %s code', 'max_length' => 'Invalid %s code'));

        if ($this->form_validation->run() === false) {
            $message = array(
                    'otp_errorMessage' => form_error('otpSMS')
                );
        } else {
            $cartAmount = $this->cart->total();
            if ($cartAmount > 0) {
                $id_number = $this->session->userdata('national_id');

                if ($this->session->userdata('user_phone')) {
                    $phoneNumber = $this->session->userdata('user_phone');
                } elseif ($this->session->userdata('phoneNumber')) {
                    $phoneNumber = $this->session->userdata('phoneNumber');
                }

                $otp = html_escape($this->input->post('otpSMS'));
                $messageData = array( 'otp_code' => $otp );
                $response = json_decode($this->verifyUserOTP($id_number, $cartAmount, $otp, $phoneNumber));

                if ($response->response != "error") {
                    if ($response->data->data->status == 200 || $response->data->data->status == 201) {
                        if ($this->session->userdata('customerNationalId')) {
                            $url = base_url('registration-details');
                            $message = array(
                                    "response" => "newUser",
                                    "url"=>$url,
                                    "details" => $response,
                                    "message" => 'Phone number verified successfully. Now proceed to registration to get a credit limit.'
                                );
                        } else {
                            // Check if customer is blocked or rejected
                            $objectArr = (array)$response->data->data->data;
                            if (!$objectArr) { // Customer dose not exist
                                $message = array(
                                    "response" => "rejected",
                                    "data" => $response,
                                    "message" => '<p>Dear, customer your phone number is now verified kindly proceed to registration. For more information on why you are getting this message contact <a href="https://lipalater.co.ke/" target="_blank">Lipalater</a> for further assistance</p>',
                                    "url" => base_url('registration-details')
                                );
                            } else { // Customer exists
                                if ($response->data->data->data->available_limit >= $cartAmount) { // Available limit is greater than the cart amount
                                    $message = array(
                                            "response" => "success",
                                            "data" => $response,
                                            "status_code" => $response->data->data->status,
                                            "creditLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit, 2),
                                            "availableLimit" => 'Ksh. '.number_format($response->data->data->data->available_limit, 2),
                                            "credit_status" => $response->data->data->data->credit_limit_status,
                                            "upfront_fee" => 'Ksh. '.number_format($response->data->data->data->payment_terms->upfront_fees, 2),
                                            "first_installment" => 'Ksh. '.number_format($response->data->data->data->payment_terms->first_installment, 2),
                                            "minimum_payment" => 'Ksh. '.number_format($response->data->data->data->payment_terms->minimum_payment, 2),
                                            "loanamount" => 'Ksh. '.number_format($response->data->data->data->payment_terms->principal_amount, 2)
                                        );
                                    $this->session->set_userdata('lipalater_customer_id', $response->data->data->data->customer_id);
                                } elseif ($response->data->data->data->available_limit == 0) { // Customer dose not have a limit for purchase
                                    $message = array(
                                            "response" => "zero_limit",
                                            "status_code" => $response->data->data->status,
                                            "data" => $response,
                                            "message" => '<p>Sorry!! Your credit limit is zero. Kindly contact Lipalater for further assistance or <a href="https://app.lipalater.com/ke/customer/login">login here</a>. You can use other available payment options provided to complete your order.<a href="'.base_url('checkout').'" >Checkout here.</a></p>'
                                        );
                                } elseif ($response->data->data->data->available_limit > 0 && $response->data->data->data->available_limit < $cartAmount) { //Customer has a limit but is less than cart amount.
                                    $message = array(
                                            "response" => "low_limit",
                                            "status_code" => $response->data->data->status,
                                            "creditLimit" => 'Ksh. '.number_format($response->data->data->data->credit_limit, 2),
                                            "availableLimit" => 'Ksh. '.number_format($response->data->data->data->available_limit, 2),
                                            "credit_status" => $response->data->data->data->credit_limit_status,
                                            "data" => $response,
                                            "message" => '<p class="text-danger">You have insuficient credit balance to purchse this item(s).<a style="color: blue;" href="'.base_url('checkout').'" >Checkout here.</a></p>'
                                        );
                                } else { // Get any other error related to the request
                                    $message = array(
                                            "response" => "error",
                                            "message" => $response->data->data->title
                                        );
                                }
                            } //end of response data check (Rejection)
                        }
                    } else { // Verify phone number request error
                        $message = array(
                            "response" => "error",
                            "status_code" => $response->data->data->status,
                            "request_id" => $response->data->data->request_id,
                            "title" => $response->data->data->title,
                            "message" => $response->data->data->details,
                            "phone" => $phoneNumber,
                            'customer_message' => 'Phone number '.$phoneNumber.' is already verified'
                        );
                    }
                } else {
                    $message = array(
                        "response" => "error",
                        "message" => "Network error occured!, Please try again."
                    );
                }
            }
        }
        echo json_encode($message);
    }

    public function firstTimeCustomerVerification() //done
    {
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required', array('required' => 'The %s field can not be blank'));
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required', array('required' => 'The %s field can not be blank'));
        $this->form_validation->set_rules('phone_number', 'phone number', 'trim|required|max_length[10]|min_length[9]', array('required' => 'The %s field can not be blank', 'max_length' => 'Please provide a valid %s example 07********', 'min_length' => 'Please provide a valid %s example 07********'));
        $this->form_validation->set_rules('id_number', 'national ID', 'trim|required|max_length[8]|min_length[6]', array('required' => 'The %s field can not be blank', 'max_length' => 'Please provide a valid Identification Number', 'min_length' => 'Please provide a valid Identification Number'));
        $this->form_validation->set_rules('date_of_birth', 'date of birth', 'trim|required', array('required' => 'The %s field cannot be blank'));
        $this->form_validation->set_rules('country_code', 'country code', 'trim|required', array('required' => 'The %s field cannot be blank'));

        if ($this->form_validation->run() === false) {
            $data = array(
                    'phone_error' => form_error('phone_number'),
                    'nationalId_error' => form_error('id_number'),
                    'firstName_error' => form_error('first_name'),
                    'lastName_error' => form_error('last_name'),
                    'countryCode_error' => form_error('country_code'),
                    'dob_error' => form_error('date_of_birth')
                );
        } else {
            $phoneNumber = html_escape($this->input->post('phone_number'));
            $nationalId = html_escape($this->input->post('id_number'));
            $firstName = html_escape($this->input->post('first_name'));
            $lastName = html_escape($this->input->post('last_name'));
            $countryCode = html_escape($this->input->post('country_code'));
            $dateOfBirth = html_escape($this->input->post('date_of_birth'));

            $year = substr($dateOfBirth, 0, 4);
            $month = substr($dateOfBirth, 5, -3);
            $day = substr($dateOfBirth, 8, 10);
            $customer_dob = $month.'/'.$day.'/'.$year;

            $customerPhone = '+254'.substr($phoneNumber, 1);

            $verificationDetails = array();
            $verificationDetails['phone_number'] = $customerPhone;
            $verificationDetails['id_number'] = $nationalId;
            $verificationDetails['first_name'] = $firstName;
            $verificationDetails['last_name'] = $lastName;
            $verificationDetails['country_code'] = $countryCode;
            $verificationDetails['date_of_birth'] = $customer_dob;
            $this->session->set_userdata('customerNationalId', $verificationDetails['id_number']);
            $this->session->set_userdata('user_phone', $verificationDetails['phone_number']);
            $this->session->set_userdata('countryCode', $verificationDetails['country_code']);

            // echo $this->generateNewUserOTP($verificationDetails['phone_number'],$verificationDetails['id_number'],$verificationDetails['first_name'],$verificationDetails['last_name'],$verificationDetails['country_code'],$verificationDetails['date_of_birth']);
            // die;
            $response = json_decode($this->generateNewUserOTP($verificationDetails['phone_number'], $verificationDetails['id_number'], $verificationDetails['first_name'], $verificationDetails['last_name'], $verificationDetails['country_code'], $verificationDetails['date_of_birth']));
            if ($response->response != "error") {
                if ($response->data->data->status == 200 || $response->data->data->status == 201) {
                    $dat = json_encode($response);
                    $data = array("response" => "success", "details" => $dat);
                } else {
                    $data = array(
                            "response" => "error",
                            "status" => $response->data->data->status,
                            "message" => $response->data->data->details,
                            "request_id" => $response->data->data->request_id                   );
                }
            } else {
                $data = array(
                        "response" => "error",
                        "message" => "An error has occured please contact the system administrator for more help."
                    );
            }
        }
        echo json_encode($data);
    }

    public function get_placeOrder_warning()
    {
        $message = array( 'response' => 'warning', 'message' => 'Score a credit limit first then place the order.');
        echo json_encode($message);
    }

    /**
     * =============================
     * Lipa later API call functions
     * =============================
     */

    public function getAccessToken()
    {
        $url = $this->base_endpoint.'oauth/token';
        
        $curl = curl_init();
            
        curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST =>false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id={$this->client_id}&client_secret={$this->client_secrete}&scope=read write",
                CURLOPT_HTTPHEADER => array(
                  "content-type: application/x-www-form-urlencoded"
                ),
              ));
    
        $response = curl_exec($curl);
        $error = curl_error($curl);
    
        return json_decode($response)->access_token;
    }
    //existing customers otp
    public function sendOTP($id, $phone)
    {
        $endpoint = $this->base_endpoint.'otp/send';
        $token = $this->getAccessToken();
        $national_id =$id;
        $phone_number = $phone;
    
        $payload = array(
                "id_number" => $national_id,
                "phone_number" => $phone_number,
            );
        $data = $this->getCurlSetting($endpoint, $payload, $token);
        $response = $data;
            
        return $response;
    }
    
    // new customer otp
    
    public function generateNewUserOTP($phone, $id, $first_name, $last_name, $dob, $county_code)
    {
        $endpoint = $this->base_endpoint.'otp/send';
        $token = $this->getAccessToken();
        $national_id = $id;
        $phone_number = $phone;
        $firstname = $first_name;
        $lastname = $last_name;
        $data_of_birth = $dob;
        $country_code = $county_code;
    
        $payload = array(
                "phone_number"=> $phone_number,
                "id_number"=> $national_id,
                "first_name"=> $firstname,
                "last_name"=> $lastname,
                "country_code"=> $country_code,
                "date_of_birth"=> $data_of_birth
            );
    
        $response = json_decode($this->getCurlSetting($endpoint, $payload, $token));
        if ($response->response == "error") {
            $response = array(
                    "response" => "error"
                );
        } else {
            $response = array(
                    "response" => "success",
                    "data"   => $response
                );
        }
            
        return json_encode($response);
    }
    
    public function verifyUserOTP($id, $itemValue, $otp, $phone)
    {
        $endpoint = $this->base_endpoint.'otp/verify';
        $token = $this->getAccessToken();
        $data = array(
                "id_number" => $id,
                "item_value"=> $itemValue,
                "otp"=> $otp,
                "phone_number"=> $phone
            );
    
        $response = json_decode($this->getCurlSetting($endpoint, $data, $token));

        if ($response->response == "error") {
            $res = array(
                    "response" => "error",
                    "Message"  => "An error has occured please contact the system adminstrator for help",
                );
        } else {
            $res = array(
                    "response" => "success",
                    "data"  => $response
                );
        }
            
        return json_encode($res);
    }
        
    
    //create lipalater credit limits
    public function CreateSelfEmployedLimit($firstName, $lastName, $id_number, $country_code, $phone_number, $employed, $gender, $date_of_birth, $marital_status, $email, $password, $loan_amount, $business_type, $business_name, $business_payment_type, $business_location, $gross_monthly_revenue, $average_monthly_expenses, $average_monthly_personal_expense, $business_industry,$business_registered)
    {
        $endpoint = $this->base_endpoint.'limits';
        $token = $this->getAccessToken();
        $data = array(
                "first_name"=> $firstName,
                "last_name"=> $lastName,
                "id_number"=> $id_number,
                "country_code"=> $country_code,
                "phone_number"=> $phone_number,
                "employed"=> $employed,
                "gender"=> $gender,
                "date_of_birth"=> $date_of_birth,
                "marital_status"=> $marital_status,
                "email"=> $email,
                "password"=> $password,
                "loan_amount"=> $loan_amount,
                "self_employed_occupational_detail"=> array(
                    "business_type"=> $business_type,
                    "business_name"=> $business_name,
                    "business_location"=> $business_location,
                    "business_payment_type"=> $business_payment_type,
                    "gross_monthly_revenue"=> $gross_monthly_revenue,
                    "average_monthly_expenses"=> $average_monthly_expenses,
                    "average_monthly_personal_expense"=> $average_monthly_personal_expense,
                    "business_registered"=> $business_registered,
                    "business_industry"=> $business_industry,
                )
            );
    
            
        $response = json_decode($this->getCurlSetting($endpoint, $data, $token));
        if ($response->response == "error") {
            $res = array(
                    "response" => "error",
                    "Message"  => "An error has occured please contact the system adminstrator for help",
                );
        } else {
            $res = array(
                    "response" => "success",
                    "data"  => $response
                );
        }
            
        return json_encode($res);
    }
    
    public function CreateLimit($firstName, $lastName, $id_number, $country_code, $phone_number, $employed, $gender, $date_of_birth, $marital_status, $email, $password, $loan_amount, $employer, $net_income, $expenses, $job_function, $job_level, $employer_sector, $job_group, $payment_type)
    {
        $endpoint = $this->base_endpoint.'limits';
        $token = $this->getAccessToken();
        $data = array(
                "first_name"=> $firstName,
                "last_name"=> $lastName,
                "id_number"=> $id_number,
                "country_code"=> $country_code,
                "phone_number"=> $phone_number,
                "employed"=> $employed,
                "gender"=> $gender,
                "date_of_birth"=> $date_of_birth,
                "marital_status"=> $marital_status,
                "email"=> $email,
                "password"=> $password,
                "loan_amount"=> $loan_amount,
                "employed_occupational_detail"=> array(
                    "employer"=> $employer,
                    "net_income"=> $net_income,
                    "expenses"=> $expenses,
                    "job_function"=> $job_function,
                    "job_level"=> $job_level,
                    "employer_sector"=> $employer_sector,
                    "job_group"=> $job_group,
                    "payment_type"=> $payment_type
                )
            );
    
            
        $response = json_decode($this->getCurlSetting($endpoint, $data, $token));
        if ($response->response == "error") {
            $res = array(
                    "response" => "error",
                    "Message"  => "An error has occured please contact the system adminstrator for help",
                );
        } else {
            $res = array(
                    "response" => "success",
                    "data"  => $response
                );
        }
            
        return json_encode($res);
    }
    //initializing curl
    public function getCurlSetting($url, $curldata, $token)
    {
        $url = $url;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token));
    
        $dataString = json_encode($curldata);
    
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    
        $response = curl_exec($curl);
        $error = curl_error($curl);
    
        if ($error) {
            $respons = array(
                    "response" => "error",
                );
            $res = json_encode($respons);
        } else {
            $respons = array(
                    "response" => "success",
                    "data" => json_decode($response)
                );
            $res = json_encode($respons);
        }
        return $res;
    }
    //create purches
    public function createPurches()
    {
        $endpoint = $this->base_endpoint.'purchases';
        $token = $this->getAccessToken();
    
        $cart = $this->cart->contents();
        $amount = $this->cart->total();
        $user_id = $this->session->userdata('lipalater_customer_id');
            
        $orderID = rand(10000, 99999);
        $order_id = 'ORD'.$orderID;
        $cartData[]= array();
        $SavecartData[] = array();
        foreach ($cart as $cart_content) {
            $item_brand = $this->checkout_model->getBrandname('ptz_products', 'ptz_brands', $cart_content['id']);
            $cartData[] = array(
                    "item_type"=> "other",
                    "item_brand"=> $item_brand,
                    "store_key"=> "patazone",
                    "delivery_option"=> "customer_store_pickup",
                    "preferred_option"=> "pick_up",
                    "item_description"=> $cart_content['name'],
                    "facility_plan"=> "lipalater_regular_plan",
                    "item_code"=> $cart_content['options']['Sku'],
                    "item_value"=> $cart_content['price'],
                    "item_topup"=> "",
                    "topup_ref"=> ""
                );
        }

        $payload = array(
                "customer_id"=> $user_id,
                "order_id"=> $orderID,
                "items"=> $cartData
            );
    
        $response_data = $this->getCurlSetting($endpoint, $payload, $token);
            
        $response = json_decode($response_data);
        if ($response->data != null) {
            if ($response->response == "success") {
                if ($response->data->status == 201 || $response->data->status == 200) {
                    $orderData = array(
                            'customer_id' => $user_id,
                            'order_id' => $orderID,
                            'payment_id' => "LIPA LATER",
                            'amount_paid' => $amount,
                            'payment_mode' => 'Lipa mdogo mdogo',
                            'order_status' => 'Pending',
                            'user_type'    => 'Lipa Later Customer'
                        );
                        
                    $order = $this->checkout_model->insertOrders('ptz_lipalater', $orderData);
                    $id = $this->session->userdata('ll_customerID');
                    $this->checkout_model->UpdateCustomerID('ptz_lipalatercustomers',$user_id, $id);

                        
                    foreach ($cart as $cart_content) {
                        $item_brand = $this->checkout_model->getBrandname('ptz_products', 'ptz_brands', $cart_content['id']);
                        $product_quantity = $this->db->get_where('ptz_products', array('id' => $cart_content['id']))->row()->product_qty;

                        $SavecartData = array(
                                    "order_id" => $order_id,
                                    "item_type"=> "other",
                                    "item_brand"=> $item_brand,
                                    "store_key"=> "patazone",
                                    "delivery_option"=> "customer_store_pickup",
                                    "preferred_option"=> "pick_up",
                                    "item_description"=> $cart_content['name'],
                                    "facility_plan"=> "lipalater_regular_plan",
                                    "item_code"=> $cart_content['options']['Sku'],
                                    "item_value"=> $cart_content['price'],
                                    "item_quantity" => $cart_content['qty'],
                                    "item_topup"=> "",
                                    "topup_ref"=> ""
                                );

                        $productQTY = ($product_quantity - $cart_content['qty']);
                        $this->checkout_model->updateProductQTY('ptz_products', $cart_content['id'], $productQTY);
                    }
                    
                    // ========== SEND EMAIL TO CUSTOMERS ===========
                    
                    // Get user from the database
                    if ($this->session->userdata('ll_customerID')) {
                        $user = $this->db->get_where('ptz_lipalatercustomers', array('id' => $this->session->userdata('ll_customerID')))->row();
                        // Prepare user data for email
                        $customerName = $user->firs_tname.' '.$user->last_name;
                        $customerEmail = $user->email;
                        $orderNumber = '#'.$order_id;
                        $emailData = array(
                                    'customerName' => $customerName,
                                    'orderId' => $orderNumber
                                );
                        $this->session->set_userdata($emailData);
                            
                        // Email subject
                        $subject = 'Order Confirmation';
                        $e_msg = $this->load->view('emailTemplates/lipalater_order', $emailData, true);
                                
                        $config['protocol'] = 'smtp';
                        $config['smtp_host'] = 'smtp.ionos.com';
                        $config['smtp_port'] = 587;
                        $config['smtp_user'] = 'info@patazone.co.ke';
                        $config['smtp_pass'] = 'Tawafaq@2022..';
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'iso-8859-1';
                        $config['wordwrap'] = true;
                        $config['newline'] = "\r\n"; //use double quotes
                                                            
                        // Message that is being sent to email
                        $this->email->subject($subject);
                        $this->email->initialize($config);
                        $this->email->from('info@patazone.co.ke', 'Patazon Marketplace');
                        $this->email->to($customerEmail);
                        $this->email->message($e_msg);
                        $purchase_id = $response->data->data->id;
                        $response = json_decode($this->getCustomerPurches($purchase_id));
                        if ($response->response == "success") {
                            if ($this->email->send()) {
                                $response = array(
                                    "response" => "success",
                                    "message" => $order_id.' Placed successfully, check your email to get your order information',
                                    "data" => $response
                                );
                                
                            } else {
                                $response = array('response' => 'error', 'message' => 'Network error');
                            }
                            $this->cart->destroy();
                            $this->session->unset_userdata('order_id');
                            $this->clearLipalaterFormFields();
                            $this->session->unset_userdata('ll_customerID');
                                
                        } else {
                            $response = array(
                                "response" => "error",
                                "message" => "Something went wrong, Please check your internet connection."
                            );
                        }

                        
                    } else {
                        // $this->crud_payments->order_items('ptz_lipalater_cart', $cartData);
                        
                        $purchase_id = $response->data->data[0]->id;
                        $response = json_decode($this->getCustomerPurches($purchase_id));
                        
                        if ($response->response == "success") {
                            $response = array(
                                "response" => "success",
                                "message" => $order_id.' Placed successfully, check your email to get your order information',
                                "data" => $response
                            );
                            $this->cart->destroy();
                            $this->session->unset_userdata('order_id');
                            // $this->clearLipalaterFormFields();
                            $this->session->unset_userdata('ll_customerID');
                        } else {
                            $response = array(
                                "response" => "error",
                                "message" => "Something went wrong, Please check your internet connection."
                            );
                        }
                    }
                } else {
                    $response = array(
                            "response" => "error",
                            "request_id"=>$response->data->request_id,
                            "status"=>$response->data->status,
                            "title"=>$response->data->title,
                            "details"=>$response->data->details
                        );
                }
            }
        } else {
            $response = array("message"=>"Network Error occured");
        }
        echo json_encode($response);
    }
        

    public function installments($itemValue)
    {
        $endpoint = $this->base_endpoint.'installments';
        $token = $this->getAccessToken();

        $data = array("item_value" => $itemValue);

        $response = json_decode($this->getCurlSetting($endpoint, $data, $token));
        if ($response->response == "success") {
            $res = array(
                    "response" => "success",
                    "data" => $response
                );
        } else {
            $res = array(
                    "response" => "error",
                    "message" => "Network error encountered"
                );
        }

        return json_encode($res);
    }

    public function getMonthlyInstallMents()
    {
        $product_id = html_escape($this->input->post('product_id'));
        $product = $this->db->get_where('ptz_products', array('id' => $product_id))->row();
        $costPrice = $product->cost_price;
        $percentage = $product->percentage/100;
        $lipalaterPrice = ($costPrice * $percentage) + $costPrice;

        $response = json_decode($this->installments($lipalaterPrice));

        if ($response->response == "success") {
            $message = array(
                    "response" => "monthlyInstallments",
                    "duration" => $response->data->data->data->duration,
                    "minimummonthly_installment" => 'Ksh. '.number_format($response->data->data->data->minimum_monthly_installment, 2)
                );
        } else {
            $message = array(
                    "response" => "error",
                    "message" => "Product installments not set"
                );
        }
        echo json_encode($message);
    }

    public function getCurlPurches($url, $token)
    {
        $url = $url;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST =>false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array('Content-Type:application/json','Authorization:Bearer '.$token),
          ));
    
        $response = curl_exec($curl);
        $error = curl_error($curl);
    
        if ($error) {
            $respons = array(
                    "response" => "error",
                );
            $res = json_encode($respons);
        } else {
            $respons = array(
                    "response" => "success",
                    "data" => json_decode($response)
                );
            $res = json_encode($respons);
        }
        return $res;
    }

    public function getCustomerPurches($purchase_id)
    {
        $endpoint = $this->base_endpoint.'purchases/'.$purchase_id;
        $token = $this->getAccessToken();
        $response = json_decode($this->getCurlPurches($endpoint, $token));
        
        if ($response->data->status == 200 || $response->data->status == 201) {
            //Get lipa later cart response details
            $cartData = array(
                "order_id" => $response->data->order_id,
                "loan_product_id" => $response->data->data->item_code,
                "loan_application_detail_id" => $response->data->data->loan_application_detail_id,
                "item_decription"=> $response->data->data->item_description,
                "item_code"=> $response->data->data->item_code,
                "item_value"=> $response->data->data->item_value,
                "purchase_id" => $response->data->data->id,
                "item_type"=> $response->data->data->item_type,
                "item_brand"=> $response->data->data->item_brand,
                "delivery_option"=> $response->data->data->delivery_option,
                "preferred_option" => $response->data->data->preferred_option,
                "source" => $response->data->data->source,
                "store_name" => $response->data->data->store_name,
                "facility_status"=> $response->data->data->facility_status,
                "facility_plan"=> $response->data->data->facility_plan,
                "partner_store_id" => $response->data->data->partner_store_id,
                "upfront_fees" => $response->data->data->upfront_fees,
                "loan_duration" => $response->data->data->loan_duration,
                "markup" => $response->data->data->markup,
                "item_topup"=> $response->data->data->item_topup,
                "topup_ref"=> $response->data->data->topup_ref,
                "invoice_amount" => $response->data->data->invoice_amount,
                "updated_at" => $response->data->data->updated_at,
                "last_modified_by" => $response->data->data->last_modified_by,
            );
            $this->checkout_model->order_items('ptz_lipalater_ordered_products', $cartData);
            $res = array(
                "response" => "success",
                "data" => $response
            );
        } else {
            $res = array(
                "response" => "error"
            );
        }
        return json_encode($res);
    }
    public function buyNow(){
        $data['title'] = 'Buy now Pay later';
        $data['categories'] = $this->product_model->getCategories();
        $this->load->view('common/header2',$data);
        $this->load->view('checkout/lipalater/lipalater');
        $this->load->view('common/footer');
    }

    public function account(){
        $data['title'] = 'Patazone|Lipalater Register';
        $data['categories'] = $this->product_model->getCategories();
        $this->load->view('common/header2',$data);
        $this->load->view('checkout/lipalater/lipalater_newCustomer');
        $this->load->view('common/footer');
    }
    public function loadLipa() //This method checks if products in cart are of lipalater or patazone
      {
          // Get cart products (loop through to get product IDs)
          $contentInCart = $this->cart->contents();
          $cartItemIds = array();
          $cartItemValue = array();
          $message = array();
          foreach ($contentInCart as $item) {
              $cartItemIds[] = $item['id'];
              if($item['price'] < 5000){
                  $message = array('response' => 'error', 'message' => 'Make sure your cart contains products with prices that equals 5000 and above');
              }else{
                $cartItemValue[] = array('price'=>$item['price']); 
              }          
          }    
          echo json_encode($message);
      }
}

