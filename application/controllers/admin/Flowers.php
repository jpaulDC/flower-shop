<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flowers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('Flower_model');
        
        // Check if admin is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['page_title'] = 'Manage Flowers';
        $data['flowers'] = $this->Flower_model->admin_get_all();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/flowers/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        $data['page_title'] = 'Add Flower';
        
        $this->form_validation->set_rules('name', 'Flower Name', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/flowers/add', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $flower_data = array(
                'name' => $this->input->post('name'),
                'color' => $this->input->post('color'),
                'price' => $this->input->post('price'),
                'status' => $this->input->post('status') ? $this->input->post('status') : 'active'
            );
            
            if ($this->Flower_model->add_flower($flower_data)) {
                $this->session->set_flashdata('success', 'Flower added successfully');
                redirect('admin/flowers');
            } else {
                $this->session->set_flashdata('error', 'Failed to add flower');
                redirect('admin/flowers/add');
            }
        }
    }

    public function edit($id) {
        $data['page_title'] = 'Edit Flower';
        $data['flower'] = $this->Flower_model->get_by_id($id);
        
        if (!$data['flower']) {
            $this->session->set_flashdata('error', 'Flower not found');
            redirect('admin/flowers');
        }
        
        $this->form_validation->set_rules('name', 'Flower Name', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/flowers/edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $flower_data = array(
                'name' => $this->input->post('name'),
                'color' => $this->input->post('color'),
                'price' => $this->input->post('price'),
                'status' => $this->input->post('status')
            );
            
            if ($this->Flower_model->update_flower($id, $flower_data)) {
                $this->session->set_flashdata('success', 'Flower updated successfully');
                redirect('admin/flowers');
            } else {
                $this->session->set_flashdata('error', 'Failed to update flower');
                redirect('admin/flowers/edit/' . $id);
            }
        }
    }

    public function delete($id) {
        if ($this->Flower_model->delete_flower($id)) {
            $this->session->set_flashdata('success', 'Flower deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete flower');
        }
        
        redirect('admin/flowers');
    }
}