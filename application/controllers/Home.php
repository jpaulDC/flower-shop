<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['page_title'] = 'Home - Flower Shop';
        $data['featured_products'] = $this->Product_model->get_featured_products(6);
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
}