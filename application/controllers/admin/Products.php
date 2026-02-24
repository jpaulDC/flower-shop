<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('Product_model');
        
        // Check if admin is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['page_title'] = 'Manage Products';
        $data['products'] = $this->Product_model->admin_get_all();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/products/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        $data['page_title'] = 'Add Product';
        
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/products/add', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $product_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'featured' => $this->input->post('featured') ? 1 : 0,
                'status' => $this->input->post('status') ? $this->input->post('status') : 'active'
            );
            
            // Handle image upload (optional for now)
            // You can add image upload functionality here
            
            if ($this->Product_model->add_product($product_data)) {
                $this->session->set_flashdata('success', 'Product added successfully');
                redirect('admin/products');
            } else {
                $this->session->set_flashdata('error', 'Failed to add product');
                redirect('admin/products/add');
            }
        }
    }

    public function edit($id) {
        $data['page_title'] = 'Edit Product';
        $data['product'] = $this->Product_model->get_by_id($id);
        
        if (!$data['product']) {
            $this->session->set_flashdata('error', 'Product not found');
            redirect('admin/products');
        }
        
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/products/edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $product_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'featured' => $this->input->post('featured') ? 1 : 0,
                'status' => $this->input->post('status')
            );
            
            if ($this->Product_model->update_product($id, $product_data)) {
                $this->session->set_flashdata('success', 'Product updated successfully');
                redirect('admin/products');
            } else {
                $this->session->set_flashdata('error', 'Failed to update product');
                redirect('admin/products/edit/' . $id);
            }
        }
    }

    public function delete($id) {
        if ($this->Product_model->delete_product($id)) {
            $this->session->set_flashdata('success', 'Product deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete product');
        }
        
        redirect('admin/products');
    }
}