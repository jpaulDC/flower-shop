<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['page_title'] = 'Shop - Flower Shop';
        $data['products'] = $this->Product_model->get_all_products();
        
        $this->load->view('templates/header', $data);
        $this->load->view('shop/index', $data);
        $this->load->view('templates/footer');
    }

    public function product($id) {
        $data['page_title'] = 'Product Details';
        $data['product'] = $this->Product_model->get_product($id);
        
        if (!$data['product']) {
            show_404();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('shop/product_detail', $data);
        $this->load->view('templates/footer');
    }
}