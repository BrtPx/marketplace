<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

    public function about_us(){
        $data['title'] = 'About Us Page';
        $data['categories'] = $this->product_model->getCategories();
		$this->load->view('common/header2',$data);
		$this->load->view('services/about_us', $data);
		$this->load->view('common/footer',$data);
    }

    public function returnPolicy(){
        $data['title'] = 'Return Policy Page';
        $data['categories'] = $this->product_model->getCategories();
		$this->load->view('common/header2',$data);
		$this->load->view('services/returns_policy', $data);
		$this->load->view('common/footer',$data);
    }

    public function storeLocation()
    {
        $data['title'] = 'Store Location Page';
        $data['categories'] = $this->product_model->getCategories();
		$this->load->view('common/header2',$data);
		$this->load->view('services/storelocation', $data);
		$this->load->view('common/footer',$data);
    }

    public function cookie_policy(){
        $data['title'] = 'Privacy & Cookies Page';
        $data['categories'] = $this->product_model->getCategories();
		$this->load->view('common/header2',$data);
		$this->load->view('services/cookies_policy', $data);
		$this->load->view('common/footer',$data);
    }

    public function help_center(){
        $data['title'] = 'Help Center Page';
        $data['categories'] = $this->product_model->getCategories();
		$this->load->view('common/header2',$data);
		$this->load->view('services/help-center', $data);
		$this->load->view('common/footer',$data);
    }

    public function faq(){
        $data['title'] = 'FAQ`s Page';
        $data['categories'] = $this->product_model->getCategories();
		$this->load->view('common/header2',$data);
		$this->load->view('services/faq', $data);
		$this->load->view('common/footer',$data);
    }

}