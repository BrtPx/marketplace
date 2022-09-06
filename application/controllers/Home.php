<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    private $perPage = 8;
    public function index()
    {
        $data['title'] = 'Welcome to patazone';
        $data['categories'] = $this->product_model->getCategories();
        $data['products'] = $this->product_model->getProductCategory('Phones & Tablets');
        $data['slidebunners'] = $this->product_model->getBunners();
        $data['brands'] = $this->product_model->getFeaturedBrands();
        $this->load->view('common/header', $data);
        $this->load->view('home', $data);
        $this->load->view('common/footer', $data);
    }

    public function getCategories()
    {
        $result = $this->product_model->getCategories();
        echo json_encode($result);
    }
    public function getSubcategories($id)
    {
        $result = $this->product_model->getSubcategories('ptz_subcategories', $id, 'category_id');
        echo json_encode($result);
    }

    public function getSubcategorie($id)
    {
        $result = $this->product_model->getSubcategories('ptz_subcategories', $id, 'category_id');
        echo json_encode($result);
    }

    public function getSubsubcategories($id)
    {
        $result = $this->product_model->getSubcategories('ptz_subsubcategories', $id, 'subcategory_id');
        echo json_encode($result);
    }

    public function view(string $name, string $id)
    {
        $view_id = base64_decode($id);
        $page = $this->input->get("page");
        $this->product_model->subcategoryProducts($name, $view_id, $page);
    }
    public function viewProduct(string $id)
    {
        $view_id = base64_decode($id);
        $data['title'] = 'Patazone shop';
        $data['categories'] = $this->product_model->getCategories();
        $data['products'] = $this->product_model->subcategoryProducts($view_id);
        $data['produstsoffer'] = $this->product_model->productOffer($view_id);
        $this->load->view('common/header2', $data);
        $this->load->view('products/products');
        $this->load->view('common/footer');
    }
    public function get_search_data()
    {
        $searchField = $this->input->get('searchKey');
        $data = $this->product_model->get_search_results('ptz_products', $searchField);
        echo json_encode($data);
    }

    public function getProductdetails(string $slug)
    {
        $data['title'] = 'View product';
        $data['categories'] = $this->product_model->getCategories();
        $output = $this->product_model->getProductDetails($slug, 'slug');
        if ($output) {
            $data['product'] = $output;
            $this->load->view('common/header2', $data);
            $this->load->view('products/viewproduct');
            $this->load->view('common/footer');
        } else {
            $data['heading'] = '404 Page Not Found';
            $data['message'] = 'The page you requested was not found.';
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function add_to_cart($id)
    {
        $product = $this->product_model->getProductDetails($id, 'id');

        $quantity = $this->input->post('p_qty');
        $material = $this->input->post('p_material');
        $color = $this->input->post('p_color');
        $sku = $product->product_sku;
        $productNumber = $product->product_id;
        $slug = $product->slug;

        if ($product->discount_price != null) {
            $discounted = ($product->selling_price - $product->discount_price);
            if ($product->product_qty > 0) {
                $data = array(
                    'id'      => $id,
                    'qty'     => $quantity,
                    'price'   => $product->discount_price,
                    'name'    => $product->product_title,
                    'options' => array(
                        'Size' => 'medium',
                        'Color' => $color,
                        'Image' => $product->product_thumbnail,
                        'Marerial' => $material,
                        'Number' => $productNumber,
                        'Discounted' => $discounted,
                        'Discount' => $product->selling_price,
                        'Shop' => $product->shop_name,
                        'Number' => $productNumber,
                        'Sku' => $sku,
                        'Slug' => $slug
                    )
                );

                if ($this->cart->insert($data)) {
                    $cartCount = count($this->cart->contents());
                    $cartTotal = $this->cart->total();
                    $message = array(
                        'response' => 'success',
                        'message' =>  $product->product_title . ' added to cart',
                        'image' => $product->product_thumbnail,
                        'cartCount' => $cartCount,
                        'cartTotal' => $cartTotal
                    );
                } else {
                    $message = array('response' => 'warning', 'message' => 'Something went | try again later');
                }
            } else {
                $message = array('response' => 'error', 'message' => 'This product is out of stock kindly purchase another.');
            }
        } else {
            if ($product->product_qty > 0) {
                $data = array(
                    'id'      => $id,
                    'qty'     => $quantity,
                    'price'   => $product->selling_price,
                    'name'    => $product->product_title,
                    'options' => array(
                        'Size' => 'medium',
                        'Color' => $color,
                        'Image' => $product->product_thumbnail,
                        'Marerial' => $material,
                        'Number' => $productNumber,
                        'Discounted' => '',
                        'Discount' => '',
                        'Shop' => $product->shop_name,
                        'Sku' => $sku,
                        'Slug' => $slug
                    )
                );
                if ($this->cart->insert($data)) {
                    $message = array('response' => 'success', 'message' => $product->product_title . ' added to cart');
                } else {
                    $message = array('response' => 'error', 'message' => 'Something went | try again later');
                }
            } else {
                $message = array('response' => 'error', 'message' => 'This product is out of stock kindly purchase another.');
            }
        }

        echo json_encode($message);
    }

    // Function for loading cart data.
    public function get_cart_details()
    {
        $cart = $this->cart->contents();
        $cartCount = count($this->cart->contents());
        $cartTotal = $this->cart->total();
        echo json_encode(array(
            'cart' => $cart,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal
        ));
    }


    // Function for loading cart page.
    public function view_cart_page()
    {
        if ($this->session->userdata('user_login') == 1) {
            $data['title'] = 'Welcome to cart Page';
            $data['brands'] = $this->crud_model->getBrands('ptz_brands');
            $data['categories'] = $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result();
            $id = $this->session->userdata('user_id');
            $data['oldImage'] = $this->db->get_where('ptz_customers', array('id' => $id))->row()->profile_image;
            $this->load->view('cart/index', $data);
        } else {
            $data['title'] = 'Welcome to cart Page';
            $data['brands'] = $this->crud_model->getBrands('ptz_brands');
            $data['categories'] = $this->db->select('*')->where('soft_delete', 0)->limit(8)->get('ptz_categories')->result();
            $this->load->view('cart/index', $data);
        }
    }

    // Function for removing item from cart
    public function remove_item_from_cart($row_id)
    {
        $row = $this->cart->get_item($row_id);
        $remove_item = array(
            'rowid' => $row_id,
            'qty' => 0
        );
        if ($this->cart->update($remove_item)) {
            $message = array('response' => 'success', 'message' => $row['name'] . ' removed from cart.');
        } else {
            $message = array('response' => 'error', 'message' => 'Something went wrong | try again later.');
        }
        echo json_encode($message);
    }

    // Function for reducing cart items.
    public function decrement_cart_items($rowid)
    {
        $row = $this->cart->get_item($rowid);
        $increment = array(
            'rowid' => $rowid,
            'qty' => $row['qty'] - 1
        );
        if ($this->cart->update($increment)) {
            $message = array('response' => 'success', 'message' => '' . $row['name'] . ' quantity has been updated');
        } else {
            $message = array('response' => 'error', 'message' => 'Something went wrong | try again later.');
        }
        echo json_encode($message);
    }

    // Function for increasing cart items
    public function increment_cart_items($rowid)
    {
        $row = $this->cart->get_item($rowid);
        $increment = array(
            'rowid' => $rowid,
            'qty' => $row['qty'] + 1
        );

        if ($this->cart->update($increment)) {
            $message = array('response' => 'success', 'message' => 'One item added to ' . $row['name']);
        } else {
            $message = array('response' => 'error', 'message' => 'Something went wrong | try again later.');
        }
        echo json_encode($message);
    }

    public function viewCart()
    {
        $data['title'] = 'My cart';
        $data['categories'] = $this->product_model->getCategories();
        $data['cartcontents'] = $this->product_model->getCartContents();
        $data['products'] = $this->product_model->getProductCategory('Phones & Tablets');
        $this->load->view('common/header2', $data);
        $this->load->view('cart/cart');
        $this->load->view('common/footer');
    }

    public function viewCategory(string $name, string $id)
    {
        $page = $this->input->get("page");
        $category_id = base64_decode($id);
        $displayDiv = '';
        $display = '';
        $subcates = '';
        $fashion = array();
        $fashionProducts = array();
        if ($category_id == 1 || $category_id == 4) {
            $display = 1;
            $fashion = array();
            $fashionProducts = array();
            $subcates = $this->product_model->getSubcatgoryByCateId($category_id, 'ptz_subcategories');
            $displayDiv = $this->db->get_where('ptz_subsubcategories', array('category_id' => $category_id, 'is_major' => 1))->result();
        } elseif ($category_id == 5) {
            $display = 2;
            $fashion = $this->product_model->showFationCate($category_id);
            $fashionProducts = $this->product_model->showFationCate($category_id);
            $subcates = $this->product_model->getSubcatgoryByCateId($category_id, 'ptz_subsubcategories');
            $displayDiv = $this->db->get_where('ptz_subcategories', array('category_id' => $category_id, 'is_major' => 1))->result();
        } else {
            $display = 0;
            $fashion = array();
            $fashionProducts = array();
            $subcates = $this->product_model->getSubcatgoryByCateId($category_id, 'ptz_subsubcategories');
            $displayDiv = $this->db->get_where('ptz_subcategories', array('category_id' => $category_id, 'is_major' => 1))->result();
        }

        if (!empty($page)) {
            $start = ceil($page * $this->perPage);
            $this->db->where('category_id', $category_id);
            $this->db->where('is_varified', 'yes');
            $this->db->limit(20, $page);
            $query = $this->db->get('ptz_products');
            if ($query->num_rows() > 0) {
                $data['categories'] = $this->product_model->getCategories();
                $data['products'] = $query->result();
                $data['sliders'] = $this->product_model->getCategorySliders($category_id);
                $data['subcategories'] = $displayDiv;
                $data['display'] = $display;
                $data['fashion'] = $fashion;
                $data['fashionProducts'] = $fashionProducts;
                $data['subcategory'] = $subcates;
                $results = $this->load->view('products/results/category_results', $data);
                return json_encode($results);
            } else {
                return array();
            }
        } else {
            $this->db->where('category_id', $category_id);
            $this->db->where('is_varified', 'yes');
            // $this->db->order_by('rand()');
            $query = $this->db->limit(20, 0)->get("ptz_products");
            $data['title'] = 'Products';
            $data['categories'] = $this->product_model->getCategories();
            $data['sliders'] = $this->product_model->getCategorySliders($category_id);
            $data['subcategories'] = $displayDiv;
            $data['display'] = $display;
            $data['fashion'] = $fashion;
            $data['fashionProducts'] = $fashionProducts;
            $data['subcategory'] = $subcates;
            $data['products'] = $query->result();
            $data['produstsoffer'] = $this->product_model->productOffer($category_id, 'category_id');
            $this->load->view('products/category', $data);
        }
    }

    public function viewBrands($brandname, $id)
    {
        $page = $this->input->get("page");
        $category_id = base64_decode($id);
        if (!empty($page)) {
            $start = ceil($page * $this->perPage);
            $this->db->where('brand_id', $category_id);
            $this->db->where('is_varified', 'yes');
            $this->db->limit(20, $page);
            $query = $this->db->get('ptz_products');
            if ($query->num_rows() > 0) {
                $data['categories'] = $this->product_model->getCategories();
                $data['products'] = $query->result();
                $results = $this->load->view('products/results/category_results', $data);
                return json_encode($results);
            } else {
                return array();
            }
        } else {
            $this->db->where('brand_id', $category_id);
            $this->db->where('is_varified', 'yes');
            $query = $this->db->limit(20, 0)->get("ptz_products");
            $data['title'] = 'Search results';
            $data['categories'] = $this->product_model->getCategories();
            $data['products'] = $query->result();
            $data['brandname'] = $this->db->get_where('ptz_brands', array('id' => $category_id))->row()->brand_title;
            $data['produstsoffer'] = $this->product_model->productOffer($category_id, 'brand_id');
            $this->load->view('products/brands', $data);
        }
    }

    public function viewCategoryByname($name)
    {
        $page = $this->input->get('page');
        $this->product_model->viewCategoryByname($name, $page);
    }

    public function getAllOffer($offer)
    {
        $page = $this->input->get('page');
        $this->product_model->viewOffers($offer, $page);
    }

    public function search()
    {
        $page = $this->input->get("page");
        $keyword = html_escape($this->input->get('searchProducts'));
        $this->session->set_userdata('searchword', $keyword);
        $search = $this->session->userdata('searchword');
        $start = ceil($page * $this->perPage);
        if ($search != null) {
            if (!empty($page)) {
                $this->db->like('product_title', $search);
                $this->db->or_like('product_tags', $search);
                $this->db->or_like('short_description', $search);
                $this->db->where('is_varified', 'no');
                $this->db->or_where('discount_price', $search);


                $this->db->order_by('rand()');
                $this->db->limit(20, $page);
                $query = $this->db->get('ptz_products');
                $count = $query->num_rows();

                if ($count > 0) {
                    $data['title'] = 'Search results';
                    $data['searchword'] = $search;
                    $data['categories'] = $this->product_model->getCategories();
                    $data['products'] = $query->result();
                    $results = $this->load->view('products/results/search_results', $data);
                    return json_encode($results);
                } else {
                    $result = array();
                    return $result;
                }
            } else {
                $this->db->like('product_title', $search);
                $this->db->or_like('product_tags', $search);
                $this->db->or_like('short_description', $search);

                $this->db->where('is_varified', 'yes');
                $this->db->or_where('discount_price', $search);

                $this->db->order_by('rand()');
                $query = $this->db->limit(20, 0)->get("ptz_products");
                $data['title'] = 'Search results';
                $search_word = $keyword;
                $data['searchword'] = $keyword;
                $data['categories'] = $this->product_model->getCategories();
                $data['products'] = $query->result();
                $this->load->view('products/search', $data);
            }
        } else {
            if (!empty($page)) {
                $this->db->like('short_description', $search);
                $this->db->where('is_varified', 'yes');
                $this->db->or_where('discount_price', $search);

                $this->db->order_by('rand()');
                $this->db->limit(20, $page);
                $result = $this->db->get('ptz_products')->result();
                $query = $this->db->get('ptz_products');
                $count = $query->num_rows();
                if ($count > 0) {
                    $data['title'] = 'Search results';
                    $data['searchword'] = $keyword;
                    $data['categories'] = $this->product_model->getCategories();
                    // $data['discount_price'] = $this->product_model->getProductPrice($search);
                    $data['products'] = $result;
                    $results = $this->load->view('products/results/search_results', $data);
                    return json_encode($results);
                } else {
                    $result = array();
                    return $result;
                }
            } else {
                $this->db->like('short_description', $search);
                $this->db->where('is_varified', 'yes');
                $this->db->or_where('discount_price', $search);


                $this->db->order_by('rand()');
                $this->db->limit(20, 0);
                $result = $this->db->get('ptz_products')->result();
                $data['title'] = 'Search results';
                $data['searchword'] = $keyword;
                $data['categories'] = $this->product_model->getCategories();
                // $data['discount_price'] = $this->product_model->getProductPrice($search);
                $data['products'] = $result;
                $this->load->view('products/search', $data);
            }
        }
    }

    public function reviews($id)
    {
        if ($this->session->userdata('user_login') == 1) {
            $customerId = $this->session->userdata('user_id');
            $review = $this->product_model->getReview('ptz_reviews', $id, $customerId);

            if ($review->num_rows() > 0) {
                $message = array('response' => 'error', 'message' => 'Product already reviewed');
            } else {
                $data = array(
                    'user_id' => $customerId,
                    'product_id' => $id,
                    'user_rating' => $this->input->post('user_rating'),
                    'user_review' => $this->input->post('user_review'),
                );
                if ($this->product_model->insertReviews('ptz_reviews', $data)) {
                    $message = array('response' => 'success', 'message' => 'Thank you for your Review.');
                } else {
                    $message = array('response' => 'info', 'message' => 'Something went wrong');
                }
            }
        } else {
            $message = array('response' => 'warning', 'message' => 'Please Loging first to review this product.');
        }

        echo json_encode($message);
    }

    public function get_review_data($id)
    {
        // Get reviews for specific productsubcategory
        $data = $this->db->get_where('ptz_reviews', array('product_id' => $id))->result();
        // Set retting variables to zero
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();

        // loop through recieved data and set new variables
        foreach ($data as $row) {
            $userName = $this->db->get_where('ptz_customers', array('id' => $row->user_id))->row();
            $review_content[] = array(
                'customerName' => $userName->firstname . ' ' . $userName->lastname,
                'product_id' => $row->product_id,
                'user_review' => $row->user_review,
                'rating' => $row->user_rating,
                'datetime' => $row->datetime,
            );

            if ($row->user_rating == 5) {
                $five_star_review++;
            }
            if ($row->user_rating == 4) {
                $four_star_review++;
            }
            if ($row->user_rating == 3) {
                $three_star_review++;
            }
            if ($row->user_rating == 2) {
                $two_star_review++;
            }
            if ($row->user_rating == 1) {
                $one_star_review++;
            }
            $total_review++;
            $total_user_rating += $row->user_rating;
        }
        $average_rating = ($total_user_rating) ? $total_user_rating / $total_review : 0;
        $output = array(
            'average_rating' => number_format($average_rating, 1),
            'total_review' => $total_review,
            'fiveStarReview' => $five_star_review,
            'fourStarReview' => $four_star_review,
            'threeStarReview' => $three_star_review,
            'twoStarReview' => $two_star_review,
            'oneStarReview' => $one_star_review,
            'reviewData' => $review_content
        );
        echo json_encode($output);
    }

    public function get_newsletter_emails()
    {
        $this->form_validation->set_rules(
            'new_user',
            'Email Address',
            'trim|required|valid_email|is_unique[ptz_newsletters.customer_email]',
            array('is_unique' => 'The %s you provided already exists. Try another one', 'required' => 'Please provide an email address to continue.')
        );

        if ($this->form_validation->run() == false) {
            $message = array(
                'emailValidation_error' => form_error('new_user')
            );
        } else {
            $customerEmail = $this->input->post('new_user');
            $formData = array(
                'customer_email' => $customerEmail
            );
            if ($this->auth_model->save_new_customer_email('ptz_newsletters', $formData)) :
                $message = array('response' => 'success', 'message' => 'Thank you for your Email you will recieve a 10% coupon discount in your account, sign up now');
            else :
                $message = array('response' => 'error', 'message' => 'Something went wrong | try again later');
            endif;
        }
        echo json_encode($message);
    }

    //Function for sending customer emails to patazon
    public function send_customer_email()
    {
        $this->form_validation->set_rules('f_name', 'first name', 'required');
        $this->form_validation->set_rules('l_name', 'last name', 'required');
        $this->form_validation->set_rules('email', 'email address', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');

        if ($this->form_validation->run() == false) {
            $message = array(
                'nameOne_error' => form_error('f_name'),
                'nameTwo_error' => form_error('l_name'),
                'email_error' => form_error('email'),
                'subject_error' => form_error('subject'),
                'message_error' => form_error('message')
            );
        } else {
            $formData = array();
            $formData['firstName'] = $this->input->post('f_name');
            $formData['lastName'] = $this->input->post('l_name');
            $formData['customer_email'] = $this->input->post('email');
            $formData['subject'] = $this->input->post('subject');
            $formData['message'] = $this->input->post('message');

            //Save customer message to the database.
            $this->auth_model->save_customer_emailMessage('ptz_customeremails', $formData);
            // Send email to info@patazone.co.ke
            $subject = $formData['subject'];
            $customerMessage = '<p>' . $formData['message'] . '</p>';

            // Email configuration.
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
            $this->email->from($formData['customer_email'], $formData['firstName'] . ' ' . $formData['lastName']);
            $this->email->to('info@patazone.co.ke');
            $this->email->subject($subject);
            $this->email->message($customerMessage);
            if ($this->email->send()) {
                $message = array('response' => 'success', 'message' => 'Thank you for your email ' . $formData['lastName'] . ' we will get back to you soon.');
            } else {
                $message = array('response' => 'success', 'message' => 'Network error!');
            };
        }
        echo json_encode($message);
    }
}
