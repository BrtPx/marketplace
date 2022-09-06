<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    private $perPage = 8;
    public function getCategories(): array
    {
        $this->db->where('is_topcategory', 1);
        return $this->db->get('ptz_categories')->result();
    }

    public function getSubcategories(string $table, string $id, string $data)
    {
        if ($table != null && $id != null) {
            $this->db->where($data, $id);
            return $this->db->get($table)->result();
        }
    }

    public function subcategoryProducts(string $name, string $id, $page = null)
    {
        if (!empty($page)) {
            $start = ceil($page * $this->perPage);
            $this->db->where('sub_subcategory_id', $id);
            $this->db->where('is_varified', 'yes');
            $this->db->order_by('rand()');
            $this->db->limit(20, $page);
            $query = $this->db->get('ptz_products');
            if ($query->num_rows() > 0) {
                $data['title'] = 'shop';
                $data['subsubcategory'] = $name;
                $data['categories'] = $this->product_model->getCategories();
                $data['products'] = $query->result();
                $results = $this->load->view('products/results/category_results', $data);
                return json_encode($results);
            } else {
                return array();
            }
        } else {
            $this->db->where('sub_subcategory_id', $id);
            $this->db->where('is_varified', 'yes');
            $this->db->order_by('rand()');
            $query = $this->db->limit(20, 0)->get("ptz_products");
            $data['title'] = 'shop';
            $data['subsubcategory'] = $this->db->get_where('ptz_subsubcategories', array('id' => $id))->row()->sub_subcategory_name;
            $data['categories'] = $this->product_model->getCategories();
            $data['products'] = $query->result();
            $data['produstsoffer'] = $this->product_model->productOffer($id, 'sub_subcategory_id');
            $this->load->view('products/products', $data);
        }
    }

    public function getProductByCategories($id)
    {
        $result = array(
            'firstdiv' => $this->getProductByCategor($id),

        );
        return $result;
    }

    public function viewCategoryByname($name, $page)
    {
        $display = 0;
        if (!empty($page)) {
            $this->db->where('category_name', $name);
            $query = $this->db->get('ptz_categories');

            if ($query->num_rows > 0) {
                $category_id =  $query->row()->id;
                $this->db->where('category_id', $category_id);
                $this->db->where('is_varified', 'yes');
                $this->db->order_by('rand()');
                $this->db->limit(20, $page);
                $query = $this->db->get('ptz_products');
                if ($query->num_rows() > 0) {
                    $data['title'] = 'shop';
                    $data['categories'] = $this->product_model->getCategories();
                    $data['products'] = $query->result();
                    $data['display'] = $display;
                    $data['subcategories'] = $this->product_model->getSubcatgoryByCateId($category_id, 'ptz_subcategories');
                    $data['sliders'] =  $this->getCategorySliders($category_id);
                    $data['subcategory'] = $this->product_model->getSubcatgoryByCateId($category_id, 'ptz_subsubcategories');
                    $data['produstsoffer'] = $this->product_model->productOffer($this->product_model->getCategoryId($name), 'category_id');
                    $result = $this->load->view('products/results/category_results', $data);

                    return json_encode($result);
                } else {
                    return array();
                }
            }
        } else {
            $this->db->where('category_name', $name);
            $query = $this->db->get('ptz_categories');
            if ($query->num_rows() > 0) {
                $category_id =  $query->row()->id;
                $this->db->where('category_id', $category_id);
                $this->db->where('is_varified', 'yes');
                $this->db->order_by('rand()');
                $this->db->limit(20, 0);
                $query = $this->db->get('ptz_products');
                $data['title'] = 'Products';
                $data['categories'] = $this->product_model->getCategories();
                $data['products'] = $query->result();
                $data['display'] = $display;
                $data['subcategories'] = $this->product_model->getSubcatgoryByCateId($category_id, 'ptz_subcategories');
                $data['sliders'] =  $this->getCategorySliders($category_id);
                $data['subcategory'] = $this->product_model->getSubcatgoryByCateId($category_id, 'ptz_subsubcategories');
                $data['produstsoffer'] = $this->product_model->productOffer($this->product_model->getCategoryId($name), 'category_id');
                $this->load->view('products/category', $data);
            }
        }
    }

    private function getProductCategoryID(string $table, string $name, int $limit, int $offsetlimit)
    {
        $result = array();
        if ($name != null) {
            $this->db->where('category_name', $name);
            $query = $this->db->get('ptz_categories');

            if ($query) {
                $category_id =  $query->row()->id;
                $this->db->where('category_id', $category_id);
                $this->db->where('is_varified', 'yes');
                $this->db->order_by('rand()');
                $this->db->limit($limit, $offsetlimit);
                $query = $this->db->get($table);
                if ($query->num_rows() > 0) {
                    $result = $query->result();
                }
            }
            return $result;
        }
    }

    public function getProductByCategor(string $id, $page = null)
    {
        if ($id != null) {
            if (!empty($page)) {
                $start = ceil($page * $this->perPage);
                $this->db->where('category_id', $id);
                $this->db->where('is_varified', 'yes');
                $this->db->order_by('rand()');
                $this->db->limit($start, $this->perPage);
                $query = $this->db->get('ptz_products');
                if ($query->num_rows() > 0) {
                    $data['title'] = 'Search results';
                    $data['searchword'] = $search_word;
                    $data['categories'] = $this->product_model->getCategories();
                    $data['products'] = $query->result();
                    $results = $this->load->view('products/results/category_results', $data);
                    return json_encode($results);
                } else {
                    return array();
                }
            } else {
                $query = $this->db->limit(20, $this->perPage)->get("ptz_products");
                $data['title'] = 'Search results';

                $data['categories'] = $this->product_model->getCategories();
                $data['products'] = $query->result();
                $this->load->view('products/category', $data);
            }
        }
    }

    private function getProductsBysubsubcate(string $table, string $field, string $id, int $limit, int $offsetlimit): array
    {
        $result = array();
        if ($table != null && $id != null) {
            $this->db->where($field, $id);
            $this->db->where('is_varified', 'yes');
            $this->db->order_by('rand()');
            $this->db->limit($limit, $offsetlimit);
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                $result = $query->result();
            } else {
                $result = array();
            }
        }
        return $result;
    }

    public function productOffer($id, $field)
    {
        $query = $this->db->query("SELECT * FROM ptz_products WHERE $field = $id AND  special_offer = 1 AND is_varified = 'yes' ORDER BY RAND() ");
        if ($query) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function getAllProductsOffer($field)
    {
        $this->db->where($field, 1);
        $this->db->where('is_varified', 'yes');
        $this->db->order_by('rand()');
        $this->db->limit(15, 0);
        return $this->db->get('ptz_products')->result();
    }

    public function getAllOffer($field, int $limit, int $offsetlimit)
    {
        $this->db->where($field, 1);
        $this->db->where('is_varified', 'yes');
        $this->db->order_by('rand()');
        $this->db->limit($limit, $offsetlimit);
        return $this->db->get('ptz_products')->result();
    }

    public function viewOffers($offer, $page)
    {
        if (!empty($page)) {
            $this->db->where($offer, 1);
            $this->db->where('is_varified', 'yes');
            $this->db->order_by('rand()');
            $this->db->limit(20, $page);
            $query = $this->db->get('ptz_products');
            $count = $query->num_rows();
            if ($count > 0) {
                $data['products'] = $query->result();
                $data['title'] = 'shop';
                $data['offer'] = $offer;
                $data['categories'] = $this->product_model->getCategories();
                $result = $this->load->view('products/results/offers', $data);

                return json_encode($result);
            } else {
                return array();
            }
        } else {
            $this->db->where($offer, 1);
            $this->db->where('is_varified', 'yes');
            $this->db->order_by('rand()');
            $this->db->limit(20, 0);
            $query = $this->db->get('ptz_products');
            $data['title'] = 'shop';
            $data['products'] = $query->result();
            $data['offer'] = $offer;
            $data['categories'] = $this->product_model->getCategories();

            $this->load->view('products/offers', $data);
        }
    }

    private function getEssentialProducts(string $table, string $name)
    {
        $result = array();
        if ($name != null) {
            $this->db->where('category_name', $name);
            $query = $this->db->get('ptz_categories');

            if ($query) {
                $category_id =  $query->row()->id;
                $this->db->where('category_id', $category_id);
                $this->db->where('is_varified', 'yes');
                $this->db->limit(8);
                $this->db->order_by('rand()');
                $query = $this->db->get($table);
                if ($query->num_rows() > 0) {
                    $result = $query->result();
                }
            }
            return $result;
        }
    }
    public function getCategoryId($name)
    {
        $result = '';
        if ($name != null) {
            $this->db->where('category_name', $name);
            $query = $this->db->get('ptz_categories');

            if ($query) {
                return $query->row()->id;
            } else {
                return '';
            }
        }
    }

    private function getCategoryProduct(string $table, string $name, int $limit, int $offsetlimit)
    {
        $result = array();
        if ($name != null) {
            $this->db->where('category_name', $name);
            $query = $this->db->get('ptz_categories');

            if ($query) {
                $category_id =  $query->row()->id;
                $this->db->where('category_id', $category_id);
                $this->db->where('is_varified', 'yes');
                $this->db->order_by('rand()');
                $query = $this->db->get($table);
                if ($query->num_rows() > 0) {
                    $result = $query->result();
                }
            }
            return $result;
        }
    }


    public function getProductCategory(string $category_name)
    {
        $result = array(
            'essensials' => $this->getEssentialProducts('ptz_products', $category_name),
            'offer_products' => $this->getAllProductsOffer('special_offer'),
            'flashsale'   => $this->getAllProductsOffer('flash_sale'),
            'best_sale'   => $this->getAllProductsOffer('best_sale'),
            'subcategoryProducts'   => $this->getSubcategoriesname(1),
        );

        return $result;
    }

    public function get_search_results($table, $searchField)
    {
        $this->db->like('product_title', $searchField);
        $this->db->or_like('product_tags', $searchField);
        $this->db->or_like('discount_price', $searchField);
        $this->db->or_like('short_description', $searchField);

        $query = $this->db->get($table);

        // $this->db->select('*');
        // $this->db->like('discount_price', $searchField);
        // $query = $this->db->get($table)->row();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            $data = array('response' => 'error', 'message' => 'No products found for search result "<b>' . $searchField . '</b>"');
            return $data;
        }
    }

    public function getProductDetails(string $id, string $field)
    {
        if ($id != null) {
            $this->db->where($field, $id);
            $result = $this->db->get('ptz_products');
            if ($result->num_rows() > 0) {
                return $result->row();
            } else {
                return '';
            }
        }
    }

    public function getCartContents(): array
    {
        $cart = $this->cart->contents();
        $cartCount = count($this->cart->contents());
        $cartTotal = $this->cart->total();
        $result =  array(
            'cart' => $cart,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal
        );
        return $result;
    }

    public function getSubcategoriesname(int $categoryiD)
    {
        $this->db->where('category_id', $categoryiD);
        return $this->db->get('ptz_subcategories')->result();
    }

    public function getBunners()
    {
        $result = array(
            'sliderImages' => $this->getSliderImages(),
            'bunners' => $this->getBannerImages()
        );

        return $result;
    }

    protected function getSliderImages(): array
    {
        $this->db->where('main_slider', 1);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get('ptz_mainslidersettings');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    protected function getBannerImages()
    {
        $this->db->where('status', 1);
        $this->db->order_by('rand()');
        $this->db->limit(2);
        $query = $this->db->get('ptz_advert');

        return $query->result();
    }

    public function searchData(string $keyword): array
    {
        $result = array(
            'search' => $this->getSearchLimit($keyword),
        );

        return $result;
    }


    public function getSearchLimit(string $keyword, $page = null)
    {
        $result = array();
        if (!empty($page)) {
            $start = ceil($this->input->get("page") * $this->perPage);
            if ($keyword != null) {
                $this->db->like('product_title', $keyword);
                $this->db->or_like('product_tags', $keyword);
                $this->db->where('is_varified', 'yes');
                $this->db->order_by('rand()');
                $this->db->limit($start, $this->perPage);
                $query = $this->db->get('ptz_products');
                $count = $query->num_rows();

                if ($count > 0) {
                    $result = $query->result();
                } else {
                    $result = array();
                }
            } else {
                $this->db->where('is_varified', 'yes');
                $this->db->order_by('rand()');
                $this->db->limit($start, $this->perPage);
                $result = $this->db->get('ptz_products')->result();
                $data['title'] = 'Search results';
                $data['searchword'] = $search_word;
                $data['categories'] = $this->product_model->getCategories();
                $data['products'] = $result->result();
                $results = $this->load->view('products/search', $data);
                return json_encode($results);
            }
        } else {
            $query = $this->db->limit(8, $this->perPage)->get("ptz_products");
            $data['title'] = 'Search results';
            $search_word = $keyword;
            $data['searchword'] = $search_word;
            $data['categories'] = $this->product_model->getCategories();
            $data['products'] = $query->result();
            $this->load->view('products/search', $data);
        }
        return $result;
    }

    public function getFeaturedBrands()
    {
        $this->db->where('is_major', 1);
        $query = $this->db->get('ptz_brands');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getReview($table, $product_id, $userid)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('user_id', $userid);
        $query = $this->db->get($table);
        return $query;
    }

    // inserting reviews in  database
    public function insertReviews($table, $data)
    {
        $this->db->insert($table, $data);
        return true;
    }

    public function getCategorySliders($categoryId): array
    {
        $result = array();
        if ($categoryId != null) {
            $this->db->where('category_id', $categoryId);
            $this->db->where('soft_delete', 0);
            $query = $this->db->get('ptz_mainslidersettings');
            if ($query->num_rows() > 0) {
                $result = $query->result();
            } else {
                $result = array();
            }
        }
        return $result;
    }

    public function showFationCate(string $catedoryId)
    {
        $result = array(
            'menDiv' => $this->getFashion($catedoryId, 'Gents'),
            'kidsDiv' => $this->getFashion($catedoryId, 'Kids'),
            'ladiesDiv' => $this->getFashion($catedoryId, 'Ladies'),
            'menDivProducts' => $this->getFashionProducts($catedoryId, 18, 21),
            'ladiesDivProducts' => $this->getFashionProducts($catedoryId, 17, 22),
            'kidsDivProducts' => $this->getFashionKids($catedoryId, 19),
        );

        return $result;
    }
    public function getSubcatgoryByCateId($cateID, string $table): array
    {
        if ($cateID != null) {
            $this->db->where('category_id', $cateID);
            $this->db->limit(3);
            $this->db->order_by('rand()');
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }
    }

    public function getFashion(string $category_id, string $field): array
    {
        $this->db->where('category_id', $category_id);
        $this->db->where('ftype', $field);
        $this->db->limit(6);
        $this->db->order_by('rand()');
        $query = $this->db->get('ptz_subsubcategories');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getFashionProducts(string $catedoryId, string $input, string $input2)
    {
        $query = $this->db->query("SELECT * FROM ptz_products WHERE subcategory_id=$input OR subcategory_id=$input2 AND  special_offer = 1 AND is_varified = 'yes' AND category_id=$catedoryId  ORDER BY RAND() ");

        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }
    public function getFashionKids($catedoryId, string $input)
    {
        $where = "subcategory_id=$input";
        $this->db->where('category_id', $catedoryId);
        $this->db->where($where);
        $this->db->where('special_offer', 1);
        $query = $this->db->get('ptz_products');

        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    public function getUserData()
    {
        $userid = $this->session->userdata('user_id');
        if ($userid) {
            $this->db->where('id', $userid);
            $query = $this->db->get('ptz_customers');
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return '';
            }
        }
    }

    public function getOrdersByCustomerId(): array
    {
        $userid = $this->session->userdata('user_id');
        if ($userid) {
            $this->db->where('user_id', $userid);
            $query = $this->db->get('ptz_orders');

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }
    }

    public function getOrderItems($orderid): array
    {
        if ($orderid != null) {
            $this->db->where('order_id', $orderid);
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $query = $this->db->get('ptz_cart');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }
    }

    public function getOrderDetails($orderID)
    {
        if ($orderID != null) {
            $this->db->where('order_id', $orderID);
            $query = $this->db->get('ptz_orders');

            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return '';
            }
        }
    }
    public function getProductPrice($search)
    {
        $this->db->like('discount_price', $search);
        return $this->db->get('ptz_products')->result();
    }
}
