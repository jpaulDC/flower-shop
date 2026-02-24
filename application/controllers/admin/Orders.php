<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->model('Order_model');
        $this->load->model('Product_model');
        
        // Check if admin is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['page_title'] = 'Manage Orders';
        $data['orders'] = $this->Order_model->admin_get_all_orders();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function view($order_id) {
        $data['page_title'] = 'Order Details';
        $data['order'] = $this->Order_model->get_order($order_id);
        $data['order_items'] = $this->Order_model->get_order_items($order_id);
        
        if (!$data['order']) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('admin/orders');
        }
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/view', $data);
        $this->load->view('admin/templates/footer');
    }

    public function update_status() {
        $order_id = $this->input->post('order_id');
        $status = $this->input->post('status');
        
        if ($this->Order_model->update_order_status($order_id, $status)) {
            $this->session->set_flashdata('success', 'Order status updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update order status');
        }
        
        redirect('admin/orders/view/' . $order_id);
    }
}