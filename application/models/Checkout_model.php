<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends CI_Model{
	public function user_is_already_registered($id){
		$this->db->where('auth_id', $id);
		$query = $this->db->get('ptz_customers');
		if($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function update_google_userdata($table, $data_record, $id){
		if(empty($id)) return;

		$this->db->where('auth_id', $id);
		$query = $this->db->update($table, $data_record);
		return $query;
	}

	public function insert_google_userdata($table = false, $data_record = []){
		return $this->db->insert($table, $data_record);
	}
	
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        
    }

    public function insertMpesa_payments($table, $data){
        $this->db->insert($table, $data);
    }
	
	public function insertOrders($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
	
    public function order_items($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getPaymetInformation($table, $phone, $resultcode){
        $this->db->where('resultCode', $resultcode);
        $this->db->where('phoneNumber' ,$phone);
        return $this->db->get($table)->row();
    }
    
    public function UpdatePayment($table, $data){
        $this->db->where('phoneNumber', $data);
        return $this->db->update($table, array('resultCode' => 1));
    }

    public function UpdateCustomerID($table, $data, $id){
        $this->db->where('id', $id);
        return $this->db->update($table, array('customer_id' => $data));
    }

    public function addAddress($table, $data){
        $this->db->insert($table, $data);
        return true;
    }

    public function getAddress($table, $userId){
        $this->db->where('user_id', $userId);
        $query = $this->db->get($table);
        return $query;
    }

    public function UpdateShippingAddress($table, $id, $user_id, $data){
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->update($table, $data);
        return true;
    }

    public function getCart($table, $user_id, $product_id, $ordered){
        $this->db->where('user_id', $user_id);
        $this->db->where('ordered', $ordered);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get($table);
        return $query;
    }

    public function updateCartItems($table, $user_id, $product_id, $ordered){
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $this->db->update($table, array('ordered' =>$ordered));
        return true;
    }
	
	public function updateProductQTY($table, $product_id, $productQTY){
        $this->db->where('id', $product_id);
        $this->db->update($table, array('product_qty' => $productQTY));
    }
	
	public function getNotifications($table, $order_id){
        
        $this->db->where('ordered', 1);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }

    }

    public function getVendor($table, $product_id){
        $this->db->where('product_id', $product_id);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function insertNotification($table, $notificationData){
        $this->db->insert($table, $notificationData);
        return true;
    }

    public function get_dataForRelatedCounty($table, $county_code){
        $this->db->where('county_code', $county_code);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function getCounties(){
       return $this->db->get('ptz_counties')->result();
    }

    public function getBrandname($table1, $table2, $id)
    {
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get($table1);
            $brandname = '';
            $brandId = $query->row()->brand_id;
                
            $brandname = $this->db->get_where($table2, array('id' => $brandId))->row()->brand_title;
            return $brandname;
        }
    }
}