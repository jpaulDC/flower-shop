<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Order_model');
        $this->load->model('Product_model');
        
        // Check if admin is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['page_title'] = 'Admin Dashboard';
        
        // Get statistics
        $data['total_orders'] = count($this->Order_model->admin_get_all_orders());
        $data['pending_orders'] = count($this->Order_model->get_orders_by_status('pending'));
        $data['confirmed_orders'] = count($this->Order_model->get_orders_by_status('confirmed'));
        $data['delivered_orders'] = count($this->Order_model->get_orders_by_status('delivered'));
        
        // Recent orders
        $data['recent_orders'] = array_slice($this->Order_model->admin_get_all_orders(), 0, 10);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }
}