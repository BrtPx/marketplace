<?php

use Google\Service\Analytics\Resource\Data;
use phpDocumentor\Reflection\PseudoTypes\False_;

defined('BASEPATH') or exit('No redirect script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        require_once('application/libraries/vendor/wasksofts/mpesa-library/src/TransactionCallbacks.php');
    }

    public function CheckoutPage()
    {
        if($this->cart->total() > 0){
        $this->session->set_userdata('redirect-url', base_url('checkout'));
        $data['title'] = "Guest Checkout";
        $data['categories'] = $this->product_model->getCategories();
        $data['cart']= $this->product_model->getCartContents();
        $data['counties'] = $this->checkout_model->getCounties();
        $data['address'] = $this->auth_model->getUserAddress($this->session->userdata('user_id'));
        $this->load->view('common/header2',$data);
        $this->load->view('checkout/guest_checkout');
        
        }else{
            $this->session->set_flashdata('warning','Your shipping cart is empty.');
            redirect('');
        }
        
    }

    public function checkOut()
    {
        if ($this->session->userdata('user_login') != 1) {
            $this->session->set_userdata('redirect-url', base_url('checkout'));
            redirect('account-login');
        }else{
            if($this->cart->total() > 0){
                $mpesa = new Mpesa();
                $data['title'] = "Checkout Page";
                $data['categories'] = $this->product_model->getCategories();
                $data['cart']= $this->product_model->getCartContents();
                $data['address'] = $this->auth_model->getUserAddress($this->session->userdata('user_id'));
                $data['counties'] = $this->checkout_model->getCounties();
                $this->load->view('common/header2',$data);
                $this->load->view('checkout/index');
                $this->load->view('common/footer');
            }else{
                $this->session->set_flashdata('warning','Your shipping cart is empty.');
                redirect('');
            }
        }
    }

    public function guestPayments()
    {
        $mpesa =new Mpesa();
        $amount = $this->cart->total();
        $phone_number = $this->input->post('mpesaphone_number');
        $paymentMode = $this->input->post('payment_mode');
        $firstname = $this->input->post('firstname');
        $lastName = $this->input->post('lastName');
        $emailAddress = $this->input->post('emailAddress');
        $phoneNumber = $this->input->post('shippingphoneNumber');
        $pickupnotes = $this->input->post('pickupnotes');
        $terms = $this->input->post('terms');

        $this->session->set_userdata('email', $emailAddress);

        if ($amount > 0) {
            $this->form_validation->set_rules('emailAddress', 'Email', 'trim|required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastName', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('shippingphoneNumber', 'shipping number', 'trim|required|min_length[10]|max_length[12]');
            $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');

            if ($this->form_validation->run() == false) {
                $message = array(
                    'email_error' => form_error('emailAddress'),
                    'firstname_error' => form_error('firstname'),
                    'lastname_error' => form_error('lastName'),
                    'phonenumber_error' => form_error('shippingphoneNumber'),
                    'payment_mode' => form_error('payment_mode')
                );
            } else {
                $this->db->where('email', $emailAddress);
                $query = $this->db->get('ptz_customers');

                if ($query->num_rows() > 0) {
                    $message = array('response' => 'warning', 'message' => 'The email provided already exist, please login to continue with checkout');
                } else {
                    $guest= rand(9999, 100000);
                    $guest_id = ('PTZGUEST'.$guest);
                    $this->session->set_userdata('guest_id', $guest_id);
                    $user_id = $this->session->userdata('guest_id');

                    $guestData = array(
                        'guest_id'       => $this->session->userdata('guest_id'),
                        'firstname'      => $firstname,
                        'lastname'       => $lastName,
                        'email'          => $emailAddress,
                        'phone'          => $phoneNumber,
                        'location'       => $pickupnotes
                        );

                    $this->checkout_model->addAddress('ptz_guests', $guestData);
                    if ($paymentMode == 1) {
                            $phone = $mpesa->validate_phone($phoneNumber);
                            $this->session->set_userdata('phone', $phone);
                            $mpesa->STKPushSimulation($amount, $phone, 'Patazon marketplace', 'test');
                            $message = array('response' => 'success', 'message' => 'Payment sent successfully');
                        
                    } elseif ($paymentMode == 2) {
                        $order = rand(9999, 100000);
                        $orderId = ('PTZORD'.$order);
                        $this->session->set_userdata('orderid', $orderId);
                        $user_order = $this->session->userdata('orderid');
                        // $customerPhone = ['254'.substr($phoneNumber, 1)];
                        $customerPhone = '+254'.substr($phoneNumber, 1);

                        $id = rand(9999, 100000);
                        $POD = ('POD'.$id);

                        $cart = $this->cart->contents();


                        $orderData = array(
                            'order_id' => $user_order,
                            'user_id' => $user_id,
                            'payment_id' => $POD,
                            'amount_paid' => $amount,
                            'discount' => '',
                            'is_paid' =>0,
                            'order_notes' => $pickupnotes,
                            'payment_mode' => 'Payment on delivery',
                            'order_status' => 'Pending',
                            'user_type'    => 'Guest Customer'
                        );

                        $order_id = $this->checkout_model->insertOrders('ptz_orders', $orderData);

                        if ($cart) {
                            foreach ($cart as $cartItems):
                                $checkCartData = $this->checkout_model->getCart('ptz_cart', $user_id, $cartItems['id'], 0);
                            $product_quantity = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->product_qty;
                            $vendor_id = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->vendor_id;
                            $data = array(
                                        'user_id' => $user_id,
                                        'order_id' => $user_order,
                                        'product_id' => $cartItems['id'],
                                        'product_qty' => $cartItems['qty'],
                                        'product_name' => $cartItems['name'],
                                        'product_price' => $cartItems['price'],
                                        'product_size' => $cartItems['options']['Size'],
                                        'product_color'=> $cartItems['options']['Color'],
                                        'ordered' => 1,
                                        'product_image' => $cartItems['options']['Image'],
                                        'product_material'=> $cartItems['options']['Marerial'],
                                        'product_number' => $cartItems['options']['Number'],
                                        'product_sku' => $cartItems['options']['Sku'],
                                        'product_slug' => $cartItems['options']['Slug']

                                    );
                            $productQTY = ($product_quantity - $cartItems['qty']);
                            $notificationData = array(
                                        'vendor_id' => $vendor_id,
                                        'message' => 'You have a new order',
                                    );
                            $this->checkout_model->insertNotification('ptz_notifications', $notificationData);
                            $this->checkout_model->updateProductQTY('ptz_products', $cartItems['id'], $productQTY);

                            $this->checkout_model->order_items('ptz_cart', $data);

                            $this->cart->destroy();
                            $this->session->unset_userdata('order_id');

                            endforeach;
                        }


                        if ($order_id) {
                            $product_id = $this->db->get_where('ptz_cart', array('order_id' => $order_id));

                            $datanotification = $this->checkout_model->getNotifications('ptz_cart', $order_id);

                            foreach ($product_id->result() as $result) {
                                $vendor_id = $this->db->get_where('ptz_products', array('product_id' => $result->product_id))->row()->vendor_id;

                                $notificationData = array(
                                    'vendor_id' => $vendor_id,
                                    'message' => 'You have a new order',
                                );
                                $this->checkout_model->insertNotification('ptz_notifications', $notificationData);
                            }
                        } else {
                            $message = array('response' => 'success', 'message' => 'error');
                        }
                        $subject = 'Order Confirmation';
                        $data = array(
                            'customername' => $firstname.' '. $lastName,
                            'order_id' => $orderId
                        );
                        $body = $this->load->view('common/email_templates/mail', $data, true);
                        $e_msg = "Hello ".$lastName.", \nthank you for your order. \nWe have received your order ".$this->session->userdata('orderid'). " and will contact you as soon as your package is shipped. \nYou can find your purchase information below. Regards, Patazone Team.";
                        $config['protocol'] = 'smtp';
                        $config['smtp_host'] = 'smtp.ionos.com';
                        $config['smtp_port'] = 587;
                        $config['smtp_user'] = 'info@patazone.co.ke';
                        $config['smtp_pass'] = 'Tawafaq@2022..';
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'iso-8859-1';
                        $config['wordwrap'] = true;
                        $config['newline'] = "\r\n"; //use double quotes

                        $this->email->initialize($config);
                        $this->email->from('info@patazone.co.ke', 'Patazon Marketplace');
                        $this->email->to($emailAddress);
                        $this->email->subject($subject);
                        $this->email->message($body);

                        $this->sendMessage($customerPhone,$e_msg);
                        if ($this->email->send()) {
                            $message = array('response' => 'success', 'message' => $orderId.' '.'Placed successfully, check your email to get your order information');
                        } else {
                            $message = array('response' => 'error', 'message' => 'Network error');
                        }
                    } elseif ($paymentMode == 3) {
                        require_once('application/libraries/stripe/stripe-php/init.php');

                        try {
                            $stripe_secret = $this->config->item('stripe_secrete_key');
                            \Stripe\Stripe::setApiKey($stripe_secret);

                            $stripe = \Stripe\Charge::create([
                                    'amount' => $this->cart->total(),
                                    'currency' => 'usd',
                                    'source'=>$this->input->post('token'),
                                    'description' => 'stripe payment test'
                                ]);

                            if ($stripe) {
                                $stripedata = json_encode($stripe);
                                $order = rand(9999, 100000);
                                $orderId = ('PTZORD'.$order);
                                $this->session->set_userdata('orderid', $orderId);
                                $user_order = $this->session->userdata('orderid');
                                // $customerPhone = ['254'.substr($phoneNumber, 1)];
                                $customerPhone = '+254'.substr($phoneNumber, 1);
                                
                                // ["254790232329"];

                                $id = rand(9999, 100000);
                                $POD = ('CDP'.$id);

                                $cart = $this->cart->contents();

                                $orderData = array(
                                    'order_id' => $user_order,
                                    'user_id' => $user_id,
                                    'payment_id' => $POD,
                                    'amount_paid' => $amount,
                                    'discount' => '',
                                    'is_paid' =>1,
                                    'order_notes' => $pickupnotes,
                                    'payment_mode' => 'Online Card Payment',
                                    'order_status' => 'Pending',
                                    'user_type'    => 'Guest Customer'
                                );

                                $order_id = $this->checkout_model->insertOrders('ptz_orders', $orderData);

                                if ($cart) {
                                    foreach ($cart as $cartItems):
                                            $checkCartData = $this->checkout_model->getCart('ptz_cart', $user_id, $cartItems['id'], 0);
                                    $product_quantity = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->product_qty;
                                    $vendor_id = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->vendor_id;
                                    $data = array(
                                                    'user_id' => $user_id,
                                                    'order_id' => $user_order,
                                                    'product_id' => $cartItems['id'],
                                                    'product_qty' => $cartItems['qty'],
                                                    'product_name' => $cartItems['name'],
                                                    'product_price' => $cartItems['price'],
                                                    'product_size' => $cartItems['options']['Size'],
                                                    'product_color'=> $cartItems['options']['Color'],
                                                    'ordered' => 1,
                                                    'product_image' => $cartItems['options']['Image'],
                                                    'product_material'=> $cartItems['options']['Marerial'],
                                                    'product_number' => $cartItems['options']['Number'],
                                                    'product_sku' => $cartItems['options']['Sku'],
                                                    'product_slug' => $cartItems['options']['Slug']

                                                );
                                    $productQTY = ($product_quantity - $cartItems['qty']);
                                    $notificationData = array(
                                                    'vendor_id' => $vendor_id,
                                                    'message' => 'You have a new order',
                                                );
                                    $this->checkout_model->insertNotification('ptz_notifications', $notificationData);
                                    $this->checkout_model->updateProductQTY('ptz_products', $cartItems['id'], $productQTY);

                                    $this->checkout_model->order_items('ptz_cart', $data);

                                    $this->cart->destroy();
                                    $this->session->unset_userdata('order_id');
                                    endforeach;
                                }
                                if ($order_id) {
                                    $product_id = $this->db->get_where('ptz_cart', array('order_id' => $order_id));

                                    $datanotification = $this->checkout_model->getNotifications('ptz_cart', $order_id);

                                    foreach ($product_id->result() as $result) {
                                        $vendor_id = $this->db->get_where('ptz_products', array('product_id' => $result->product_id))->row()->vendor_id;

                                        $notificationData = array(
                                                'vendor_id' => $vendor_id,
                                                'message' => 'You have a new order',
                                            );
                                        $this->checkout_model->insertNotification('ptz_notifications', $notificationData);
                                    }
                                } else {
                                    $message = array('response' => 'success', 'message' => 'error');
                                }

                                $subject = 'Order Confirmation';
                                $data = array(
                                    'customername' => $firstname.' '. $lastName,
                                    'order_id' => $orderId
                                );
                                $body = $this->load->view('common/email_templates/mail', $data, true);
                                $e_msg = "Hello ".$lastName.", \nthank you for your order. \nWe have received your order ".$this->session->userdata('orderid'). " and will contact you as soon as your package is shipped. \nYou can find your purchase information below. Regards, Patazone Team.";
                                $config['protocol'] = 'smtp';
                                $config['smtp_host'] = 'smtp.ionos.com';
                                $config['smtp_port'] = 587;
                                $config['smtp_user'] = 'info@patazone.co.ke';
                                $config['smtp_pass'] = 'Tawafaq@2022..';
                                $config['mailtype'] = 'html';
                                $config['charset'] = 'iso-8859-1';
                                $config['wordwrap'] = true;
                                $config['newline'] = "\r\n"; //use double quotes

                                $this->email->initialize($config);
                                $this->email->from('info@patazone.co.ke', 'Patazon Marketplace');
                                $this->email->to($emailAddress);
                                $this->email->subject($subject);
                                $this->email->message($body);

                                $this->sendMessage($customerPhone,$e_msg);
                                if ($this->email->send()) {
                                    $message = array('response' => 'success', 'message' => $orderId.' '.'Placed successfully, check your email to get your order information');
                                } else {
                                    $message = array('response' => 'error', 'message' => 'Network error');
                                }
                            }

                            $message = array('success' => true, 'data' => $stripe);
                        } catch (\Stripe\Exception\CardException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\RateLimitException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\InvalidRequestException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\AuthenticationException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\ApiConnectionException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (Exception $error) {
                            $message = array('success' => false, 'data' => 'Something went wrong. Please try  again later.');
                        }
                    }
                }
            }
        } else {
            $this->session->set_flashdata('warning', 'Your cart is empty');
        }

        echo json_encode($message);
    }

    public function mpesaPayment()
    {
        // if($this->session->userdata('user_login') !=1) redirect('account_login');

        $mpesa = new Mpesa();

        $callback = new TransactionCallbacks();

        $data['title'] = 'Payments';
        $mpesaphone_number = $this->input->post('mpesaphone_number');
        $paymentMode = $this->input->post('payment_mode');
        $firstname = $this->input->post('firstname');
        $lastName = $this->input->post('lastName');
        $companyName = $this->input->post('companyName');
        $county = $this->input->post('county');
        $checkoutRegion = $this->input->post('checkoutRegion');
        $checkoutStreetNames = $this->input->post('delivery_address');
        $emailAddress = $this->input->post('emailAddress');
        $phoneNumber = $this->input->post('shippingphoneNumber');
        $pickupnotes = $this->input->post('pickupnotes');

        // $this->session->set_userdata('checkoutlastname', $lastName);
        $userId = $this->session->userdata('user_id');
        $address = $this->checkout_model->getAddress('ptz_address', $userId);
        $message= [];

            $this->form_validation->set_rules('emailAddress', 'Email', 'trim|required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastName', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('shippingphoneNumber', 'shipping number', 'trim|required|min_length[10]|max_length[12]');
            $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
            $this->form_validation->set_rules('county', 'Shipping county', 'trim|required');
            $this->form_validation->set_rules('checkoutRegion', 'Shipping region', 'trim|required');
            // $message= [];
            if($this->form_validation->run() == false){
                $message = array(
                    'firstename_error' => form_error('firstname'),
                    'lastname_error' => form_error('lastName'),
                    'shippingphoneNumber' => form_error('shippingphoneNumber'),
                    'emailAddress' => form_error('emailAddress'),
                    'payment_mode' => form_error('payment_mode'),
                    'county' => form_error('county'),
                    'checkoutRegion' => form_error('checkoutRegion')
                );
            }else{
                $amount = $this->cart->total();
                
                if ($amount > 0) {
        
                    if ($paymentMode == 1) {
                        
                            if ($address->num_rows() > 0) {
                                $id = $address->row()->id;
                                $addressData = array(
                                        'user_id'        => $userId,
                                        'firstname'      => $firstname,
                                        'lastname'       => $lastName,
                                        'email'          => $emailAddress,
                                        'phone'          => $phoneNumber,
                                        'county'         => $county,
                                        'region'         => $checkoutRegion,
                                        'street'         => $checkoutStreetNames,
                                        'company_name'   => $companyName,
                                        'address_type'   => 'Shipping'
                                        );
                                $this->checkout_model->UpdateShippingAddress('ptz_address', $id, $userId, $addressData);
                                $phone = $mpesa->validate_phone($phoneNumber);
                                $this->session->set_userdata('phone', $phone);
                                $mpesa->STKPushSimulation($amount, $phone, 'Patazon marketplace', 'test');
                                $message = array('response' => 'success', 'message' => 'Address present');
                                $this->session->set_userdata('address', $id);
                            } else {
                                $addressData = array(
                                        'user_id'        => $userId,
                                        'firstname'      => $firstname,
                                        'lastname'       => $lastName,
                                        'email'          => $emailAddress,
                                        'phone'          => $phoneNumber,
                                        'county'         => $county,
                                        'region'         => $checkoutRegion,
                                        'street'         => $checkoutStreetNames,
                                        'company_name'   => $companyName,
                                        'address_type'   => 'Shipping'
                                    );
            
                                $phone = $mpesa->validate_phone($mpesaphone_number);
                                $this->session->set_userdata('phone', $phone);
                                $mpesa->STKPushSimulation($amount, $phone, 'Patazon marketplace', 'test');
            
                                $addres = $this->checkout_model->addAddress('ptz_address', $addressData);
                                if ($addres) {
                                    $addresss = $this->checkout_model->getAddress('ptz_address', $userId)->row()->id;
                                    $this->session->set_userdata('address', $addresss);
                                }
                                $message = array('response' => 'success', 'message' => 'Payment sent successfully');
                            }
                        
                    } elseif ($paymentMode == 2) {
                        $order = rand(9999, 100000);
                        $orderId = ('PTZORD'.$order);
                        $this->session->set_userdata('orderid', $orderId);
                        $user_order = $this->session->userdata('orderid');
                        // $customerPhone = ['254'.substr($phoneNumber, 1)];
                        $customerPhone = '+254'.substr($phoneNumber, 1);
        
                        $user = $this->session->userdata('user_id');
                        $id = rand(9999, 100000);
                        $POD = ('POD'.$id);
        
                        $cart = $this->cart->contents();
        
                        if ($address->num_rows() > 0) {
                            $id = $address->row()->id;
                            $addressData = array(
                                    'user_id'        => $userId,
                                    'firstname'      => $firstname,
                                    'lastname'       => $lastName,
                                    'email'          => $emailAddress,
                                    'phone'          => $phoneNumber,
                                    'county'         => $county,
                                    'region'         => $checkoutRegion,
                                    'street'         => $checkoutStreetNames,
                                    'company_name'   => $companyName,
                                    'address_type'   => 'Shipping'
                                    );
                            $this->checkout_model->UpdateShippingAddress('ptz_address', $id, $userId, $addressData);
                            // $message = array('response' => 'success', 'message' => 'Address present');
                            $this->session->set_userdata('address', $id);
                        } else {
                            $addressData = array(
                                    'user_id'        => $userId,
                                    'firstname'      => $firstname,
                                    'lastname'       => $lastName,
                                    'email'          => $emailAddress,
                                    'phone'          => $phoneNumber,
                                    'county'         => $county,
                                    'region'         => $checkoutRegion,
                                    'street'         => $checkoutStreetNames,
                                    'company_name'   => $companyName,
                                    'address_type'   => 'Shipping'
                                );
        
                            $addres = $this->checkout_model->addAddress('ptz_address', $addressData);
                            if ($addres) {
                                $addresss = $this->checkout_model->getAddress('ptz_address', $userId)->row()->id;
                                $this->session->set_userdata('address', $addresss);
                            }
                            
                        }
        
                        $orderData = array(
                            'order_id' => $user_order,
                            'user_id' => $user,
                            'payment_id' => $POD,
                            'amount_paid' => $amount,
                            'discount' => '',
                            'is_paid' =>0,
                            'order_notes' => $pickupnotes,
                            'payment_mode' => 'Payment on delivery',
                            'order_status' => 'Pending',
                            'user_type'    => 'Patazon Customer'
                        );
        
                        $this->checkout_model->insertMpesa_payments('ptz_orders', $orderData);
        
                        if ($cart) {
                            foreach ($cart as $cartItems):
                                    $checkCartData = $this->checkout_model->getCart('ptz_cart', $user, $cartItems['id'], 0);
                            $product_quantity = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->product_qty;
                            $data = array(
                                        'user_id' => $user,
                                        'order_id' => $user_order,
                                        'product_id' => $cartItems['id'],
                                        'product_qty' => $cartItems['qty'],
                                        'product_name' => $cartItems['name'],
                                        'product_price' => $cartItems['price'],
                                        'product_size' => $cartItems['options']['Size'],
                                        'product_color'=> $cartItems['options']['Color'],
                                        'ordered' => 1,
                                        'product_image' => $cartItems['options']['Image'],
                                        'product_material'=> $cartItems['options']['Marerial'],
                                        'product_number' => $cartItems['options']['Number'],
                                        'product_sku' => $cartItems['options']['Sku'],
                                        'product_slug' => $cartItems['options']['Slug']
        
                                    );
                            if ($checkCartData->num_rows() > 0) {
                                $this->checkout_model->updateCartItems('ptz_cart', $user, $cartItems['id'], 1);
                            } else {
                                $cartdata = array(
                                                'user_id' => $user,
                                                'order_id' => $user_order,
                                                'product_id' => $cartItems['id'],
                                                'product_qty' => $cartItems['qty'],
                                                'product_name' => $cartItems['name'],
                                                'product_price' => $cartItems['price'],
                                                'product_size' => $cartItems['options']['Size'],
                                                'product_color'=> $cartItems['options']['Color'],
                                                'ordered' => 1,
                                                'product_image' => $cartItems['options']['Image'],
                                                'product_material'=> $cartItems['options']['Marerial'],
                                                'product_number' => $cartItems['options']['Number'],
                                                'product_sku' => $cartItems['options']['Sku'],
                                                'product_slug' => $cartItems['options']['Slug']
        
                                            );
                                $productQTY = ($product_quantity - $cartItems['qty']);
                                $this->checkout_model->updateProductQTY('ptz_products', $cartItems['id'], $productQTY);
                                $this->checkout_model->order_items('ptz_cart', $cartdata);
                            }
                            // echo json_encode($cartItems);
                            // $message = array('response' => 'success', 'message' => 'Payment sent successfully');
                            // die;
                            $this->cart->destroy();
                            $this->session->unset_userdata('order_id');
        
                            endforeach;
                        }
                        
                        $subject = 'Order Confirmation';
                        $data = array(
                            'customername' => $firstname.' '. $lastName,
                            'order_id' => $orderId
                        );
                        $body = $this->load->view('common/email_templates/mail', $data, true);
                        $e_msg = "Hello ".$lastName.", \nthank you for your order. \nWe have received your order ".$this->session->userdata('orderid'). " and will contact you as soon as your package is shipped. \nYou can find your purchase information below. Regards, Patazone Team.";

                        $config['protocol'] = 'smtp';
                        $config['smtp_host'] = 'smtp.ionos.com';
                        $config['smtp_port'] = 587;
                        $config['smtp_user'] = 'info@patazone.co.ke';
                        $config['smtp_pass'] = 'Tawafaq@2022..';
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'iso-8859-1';
                        $config['wordwrap'] = true;
                        $config['newline'] = "\r\n"; //use double quotes

                        $this->email->initialize($config);
                        $this->email->from('info@patazone.co.ke', 'Patazon Marketplace');
                        $this->email->to($emailAddress);
                        $this->email->subject($subject);
                        $this->email->message($body);

                        $this->sendMessage($customerPhone,$e_msg);
                        if ($this->email->send()) {
                            $message = array('response' => 'success', 'message' => $orderId.' '.'Placed successfully, check your email to get your order information');
                        } else {
                            $message = array('response' => 'error', 'message' => 'Network error');
                        }       
                    }elseif ($paymentMode == 3) {
                        require_once('application/libraries/stripe/stripe-php/init.php');

                        try {
                            $stripe_secret = $this->config->item('stripe_secrete_key');
                            \Stripe\Stripe::setApiKey($stripe_secret);

                            $stripe = \Stripe\Charge::create([
                                    'amount' => $this->cart->total(),
                                    'currency' => 'usd',
                                    'source'=>$this->input->post('token'),
                                    'description' => 'stripe payment test'
                                ]);

                            if ($stripe) {
                                $stripedata = json_encode($stripe);
                                $order = rand(9999, 100000);
                                $orderId = ('PTZORD'.$order);
                                $this->session->set_userdata('orderid', $orderId);
                                $user_order = $this->session->userdata('orderid');
                                // $customerPhone = ['254'.substr($phoneNumber, 1)];
                                $customerPhone = '+254'.substr($phoneNumber, 1);
                                
                                // ["254790232329"];

                                $id = rand(9999, 100000);
                                $POD = ('CDP'.$id);

                                $cart = $this->cart->contents();

                                $orderData = array(
                                    'order_id' => $user_order,
                                    'user_id' => $userId,
                                    'payment_id' => $POD,
                                    'amount_paid' => $amount,
                                    'discount' => '',
                                    'is_paid' =>1,
                                    'order_notes' => $pickupnotes,
                                    'payment_mode' => 'Online Card Payment',
                                    'order_status' => 'Pending',
                                    'user_type'    => 'Guest Customer'
                                );

                                $order_id = $this->checkout_model->insertOrders('ptz_orders', $orderData);

                                if ($cart) {
                                    foreach ($cart as $cartItems):
                                            $checkCartData = $this->checkout_model->getCart('ptz_cart', $userId, $cartItems['id'], 0);
                                    $product_quantity = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->product_qty;
                                    $vendor_id = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->vendor_id;
                                    $data = array(
                                                    'user_id' => $userId,
                                                    'order_id' => $user_order,
                                                    'product_id' => $cartItems['id'],
                                                    'product_qty' => $cartItems['qty'],
                                                    'product_name' => $cartItems['name'],
                                                    'product_price' => $cartItems['price'],
                                                    'product_size' => $cartItems['options']['Size'],
                                                    'product_color'=> $cartItems['options']['Color'],
                                                    'ordered' => 1,
                                                    'product_image' => $cartItems['options']['Image'],
                                                    'product_material'=> $cartItems['options']['Marerial'],
                                                    'product_number' => $cartItems['options']['Number'],
                                                    'product_sku' => $cartItems['options']['Sku'],
                                                    'product_slug' => $cartItems['options']['Slug']

                                                );
                                    $productQTY = ($product_quantity - $cartItems['qty']);
                                    $notificationData = array(
                                                    'vendor_id' => $vendor_id,
                                                    'message' => 'You have a new order',
                                                );
                                    $this->checkout_model->insertNotification('ptz_notifications', $notificationData);
                                    $this->checkout_model->updateProductQTY('ptz_products', $cartItems['id'], $productQTY);

                                    $this->checkout_model->order_items('ptz_cart', $data);

                                    $this->cart->destroy();
                                    $this->session->unset_userdata('order_id');
                                    endforeach;
                                }
                                if ($order_id) {
                                    $product_id = $this->db->get_where('ptz_cart', array('order_id' => $order_id));

                                    $datanotification = $this->checkout_model->getNotifications('ptz_cart', $order_id);

                                    foreach ($product_id->result() as $result) {
                                        $vendor_id = $this->db->get_where('ptz_products', array('product_id' => $result->product_id))->row()->vendor_id;

                                        $notificationData = array(
                                                'vendor_id' => $vendor_id,
                                                'message' => 'You have a new order',
                                            );
                                        $this->checkout_model->insertNotification('ptz_notifications', $notificationData);
                                    }
                                } else {
                                    $message = array('response' => 'success', 'message' => 'error');
                                }

                                $subject = 'Order Confirmation';
                                $data = array(
                                    'customername' => $firstname.' '. $lastName,
                                    'order_id' => $orderId
                                );
                                $body = $this->load->view('common/email_templates/mail', $data, true);
                                $e_msg = "Hello ".$lastName.", \nthank you for your order. \nWe have received your order ".$this->session->userdata('orderid'). " and will contact you as soon as your package is shipped. \nYou can find your purchase information below. Regards, Patazone Team.";
                                $config['protocol'] = 'smtp';
                                $config['smtp_host'] = 'smtp.ionos.com';
                                $config['smtp_port'] = 587;
                                $config['smtp_user'] = 'info@patazone.co.ke';
                                $config['smtp_pass'] = 'Tawafaq@2022..';
                                $config['mailtype'] = 'html';
                                $config['charset'] = 'iso-8859-1';
                                $config['wordwrap'] = true;
                                $config['newline'] = "\r\n"; //use double quotes

                                $this->email->initialize($config);
                                $this->email->from('info@patazone.co.ke', 'Patazon Marketplace');
                                $this->email->to($emailAddress);
                                $this->email->subject($subject);
                                $this->email->message($body);

                                $this->sendMessage($customerPhone,$e_msg);
                                if ($this->email->send()) {
                                    $message = array('response' => 'success', 'message' => $orderId.' '.'Placed successfully, check your email to get your order information');
                                } else {
                                    $message = array('response' => 'error', 'message' => 'Network error');
                                }
                            }

                            $message = array('success' => true, 'data' => $stripe);
                        } catch (\Stripe\Exception\CardException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\RateLimitException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\InvalidRequestException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\AuthenticationException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (\Stripe\Exception\ApiConnectionException $error) {
                            $message = array('success' => false, 'data' => $error->getError()->message);
                        } catch (Exception $error) {
                            $message = array('success' => false, 'data' => 'Something went wrong. Please try  again later.');
                        }
                    }
                } else {
                    $this->session->set_flashdata('warning', 'Your cart is empty');
                }
                
            }
        
        echo json_encode($message);
    }

    public function stkCallback()
    {
        $callback =  new TransactionCallbacks();

        //Set the response content type to application/json
        header("Content-Type:application/json");

        //read incoming request
        // $callbackJSONData=file_get_contents('php://input');
        $result = json_decode($callback->processSTKPushRequestCallback());
        // $result =['post'=> $callbackJSONData,'type'=> 'post'];

        if ($result) {
            $this->checkout_model->insertMpesa_payments('ptz_mpesa', $result);
            $resp = '{"ResultCode":0,"ResultDesc":"Confirmation recieved successfully"}';
        } else {
            $resp = '{"ResultCode":1, "ResultDesc":"Confirmation failure due to internal service error"}';
        }
    }


    public function confirmation_url()
    {
        $callback =  new TransactionCallbacks();

        header("Content-Type:application/json");
        //read incoming request
        $postData = file_get_contents('php://input');
        $dataresult = json_decode($postData);

        $result = ['type'=>"result" ,'post'=>$postData ];

        if ($dataresult->resultCode != null) {
            echo 'good work done here';
        } else {
            echo 'an error occured';
        }



        if ($result) {
            $resp = '{"ResultCode":0,"ResultDesc":"Confirmation recieved successfully"}';
        } else {
            $resp = '{"ResultCode": 1, "ResultDesc":"Confirmation failure due to internal service error"}';
        }
        echo $resp;
    }

    public function validation_url()
    {
        $callback =  new TransactionCallbacks();

        header("Content-Type:application/json");
        //read incoming request
        $postData = file_get_contents('php://input');

        $result = ['type'=>"result" ,'post'=>$postData ];

        if ($result) {
            $resp = '{"ResultCode":0,"ResultDesc":"Validation passed successfully"}';
        } else {
            $resp = '{"ResultCode": 1, "ResultDesc":"Validation failure due to internal service error"}';
        }

        echo $resp;
    }

    public function result_url()
    {
        $callback =  new TransactionCallbacks();

        header("Content-Type:application/json");
        //read incoming request
        $postData = file_get_contents('php://input');
        $result = ['type'=>"result" ,'post'=>$postData ];

        if ($result) {
            $resp = '{"ResultCode":00000000,"ResultDesc":"Success"}';
        } else {
            $resp = '{"ResultCode":1,"ResultDesc":" internal service error"}';
        }

        echo $resp;
    }

    public function timeout_url()
    {
        $callback =  new TransactionCallbacks();

        header("Content-Type:application/json");
        //read incoming request
        $postData = file_get_contents('php://input');

        if ($postData) {
            $resp = '{"ResultCode":00000000,"ResultDesc":"Success"}';
        } else {
            $resp = '{"ResultCode":1,"ResultDesc":" internal service error"}';
        }

        echo $resp;
    }

    public function getPayment()
    {
        $code = 0;
        $lastName = $this->session->userdata('checkoutlastname');
        $phoneData = $this->session->userdata('phone');
        $phoneNumber = $this->input->post('phonenumber');
        $msg = '';
        $payments = $this->db->get_where('ptz_mpesa', array('resultCode' => $code, 'phoneNumber' => $phoneNumber))->row();
        $payment = $this->checkout_model->getPaymetInformation('ptz_mpesa', $phoneNumber, $code);
        if ($payments) {
            $user = $this->session->userdata('user_id');
            $order = rand(9999, 100000);
            $orderId = ('PTZORD'.$order);
            $this->session->set_userdata('orderid', $orderId);
            $orderData = array(
                'order_id' => $orderId,
                'user_id' => $user,
                'payment_id' => $payment->mpesaReceiptNumber,
                'amount_paid' => $payment->amount,
                'discount' => '',
                'is_paid' =>1,
                'order_notes' => 'Mpesa payments',
                'order_status' => 'Shipping soon',
                'user_type'    => $user ? 'Patazon Customer' : 'Guest Customer'
            );

            $this->checkout_model->insertMpesa_payments('ptz_orders', $orderData);
            $this->checkout_model->UpdatePayment('ptz_mpesa', $phoneData);

            $cart = $this->cart->contents();
            if ($cart) {
                foreach ($cart as $cartItems):
                        $checkCartData = $this->checkout_model->getCart('ptz_cart', $user, $cartItems['id'], 0);
                $product_quantity = $this->db->get_where('ptz_products', array('id' => $cartItems['id']))->row()->product_qty;
                $data = array(
                            'user_id' => $user ? $this->session->userdata('user_id') : $this->session->userdata('guest_id'),
                            'order_id' => $orderId,
                            'product_id' => $cartItems['id'],
                            'product_qty' => $cartItems['qty'],
                            'product_name' => $cartItems['name'],
                            'product_price' => $cartItems['price'],
                            'product_size' => $cartItems['options']['Size'],
                            'product_color'=> $cartItems['options']['Color'],
                            'ordered' => 1,
                            'product_image' => $cartItems['options']['Image'],
                            'product_material'=> $cartItems['options']['Marerial'],
                            'product_number' => $cartItems['options']['Number'],
                            'product_sku' => $cartItems['options']['Sku'],
                            'product_slug' => $cartItems['options']['Slug']

                        );
                if ($checkCartData->num_rows() > 0) {
                    $this->checkout_model->updateCartItems('ptz_cart', $user, $cartItems['id'], 1);
                    $productQTY = ($product_quantity - $cartItems['qty']);
                    $this->checkout_model->updateProductQTY('ptz_products', $cartItems['id'], $productQTY);
                } else {
                    $data = array(
                                    'user_id' => $user ? $this->session->userdata('user_id') : $this->session->userdata('guest_id'),
                                    'order_id' => ($this->session->userdata('order_id')) ? $this->session->userdata('order_id') : $orderId,
                                    'product_id' => $cartItems['id'],
                                    'product_qty' => $cartItems['qty'],
                                    'product_name' => $cartItems['name'],
                                    'product_price' => $cartItems['price'],
                                    'product_size' => $cartItems['options']['Size'],
                                    'product_color'=> $cartItems['options']['Color'],
                                    'ordered' => 1,
                                    'product_image' => $cartItems['options']['Image'],
                                    'product_material'=> $cartItems['options']['Marerial'],
                                    'product_number' => $cartItems['options']['Number'],
                                    'product_sku' => $cartItems['options']['Sku'],
                                    'product_slug' => $cartItems['options']['Slug']

                                );
                    $productQTY = ($product_quantity - $cartItems['qty']);
                    $this->checkout_model->updateProductQTY('ptz_products', $cartItems['id'], $productQTY);
                    $this->checkout_model->order_items('ptz_cart', $data);
                }

                $this->cart->destroy();
                $this->session->unset_userdata('order_id');

                endforeach;
            }

            $subject = 'Order Confirmation';
            $data = array(
                'customername' => $lastName,
                'order_id' => $orderId
            );
            $e_msg = "Hello ".$lastName.", \nthank you for your order. \nWe have received your order ".$this->session->userdata('orderid'). " and will contact you as soon as your package is shipped. \nYou can find your purchase information below. Regards, Patazone Team.";

            $body = $this->load->view('common/email_templates/mail', $data, true);
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.ionos.com';
            $config['smtp_port'] = 587;
            $config['smtp_user'] = 'info@patazone.co.ke';
            $config['smtp_pass'] = 'Tawafaq@2022..';
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = true;
            $config['newline'] = "\r\n"; //use double quotes

            $this->email->initialize($config);
            $this->email->from('info@patazone.co.ke', 'Patazon Marketplace');
            $this->email->to($this->session->userdata('email'));
            $this->email->subject($subject);
            $this->email->message($body);

            $this->sendMessage($phoneNumber,$e_msg);
            if ($this->email->send()) {
            } else {
                $msg = array('response' => 'error', 'message' => 'Network error');
            }

            $msg = array('response' => 'success', 'message' => 'Thank you for shopping with Patazon','orderId' => $orderId);
        } else {
            $msg = array('response' => 'error', 'message' => 'Payment not received, please make sure you have entered correct mpesa details to complete transaction');
            $this->session->unset_userdata('phone');
        }
        echo json_encode($msg);
    }

    public function successOrder()
    {
        $data['title'] = "Order success Page";
        $data['categories'] = $this->product_model->getCategories();
        $data['cart']= $this->product_model->getCartContents();
        $this->load->view('common/header2',$data);
        $this->load->view('checkout/orders_success');
        $this->load->view('common/footer');
    }

    public function trackOrder()
    {
        $data['title'] = "Order tracking page";
        $data['categories'] = $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result();
        $this->load->view('orders/ordertracking', $data);
    }

    public function get_regiondata()
    {
        $countyCode = $this->input->get('county_code');
        $data = $this->checkout_model->get_dataForRelatedCounty('ptz_regions', $countyCode);
        echo json_encode($data);
    }

    public function getAuthTokens(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.emalify.com/v1/oauth/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "client_id": "kh9U4CmAbIx9GZTfm4zBdf82Ju2uQ3ff",
            "client_secret": "hc9USpavGnv4ca3LodGU8hdcnlITi2UqHggqb4K1",
            "grant_type": "client_credentials"
        }',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response)->access_token;
    }

    public function sendMessage(string $receipient, string $message)
    {
        # code...
        $url = 'https://vas.teleskytech.com/api/sendsms';
        $post = [
        "username"=>"patazoneinvestment", 
        "api"=>"f157ddfab568", 
        "phone"=> $receipient, 
        "from"=> 'Patazone', //replace with sender ID (Telesky)
        "message"=> $message
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($post),
    
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            return $response;
    }

    // public function sendMessage(array $receipient, string $message){
    //     $curl = curl_init();
    //     $messageData = array(
    //         'to' => $receipient,
    //         'message' => $message,
    //         'messageId' => "a-eunique-id",
    //         'callback' => "http://example.com/callback",
    //         'from' => "EMALIFY",
    //         'service' => "21026_News_5/sms"
    //     );
    //     $data = json_encode($messageData);
    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'https://api.emalify.com/v1/projects/5abp7lr60xrk0vxg/sms/simple/send',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'POST',
    //     CURLOPT_POSTFIELDS =>$data,

    //     CURLOPT_HTTPHEADER => array(
    //         'Accept: application/json',
    //         'Authorization:Bearer '.$this->getAuthTokens(), 
    //         'Content-Type: application/json'
    //     ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     return $response;
    // }

    public function sendBulksms(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.emalify.com/v1/projects/yourProjectId/sms/bulk',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "messages" : [
                {
                    "recipient": "2547xxxxxxxx",
                    "message": "A bulk Test in prod",
                    "messageId": "uniqueMessageIdForDlr"
                },
                {
                    "recipient": "2547xxxxxxxx",
                    "message": "A bulk Test in prod to parin",
                    "messageId": "uniqueMessageIdForDlr"
                }
            ],
            "from": "senderId"
        }',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
