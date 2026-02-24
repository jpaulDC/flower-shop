<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wrappers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('Wrapper_model');
        
        // Check if admin is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['page_title'] = 'Manage Wrappers';
        $data['wrappers'] = $this->Wrapper_model->admin_get_all();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/wrappers/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        $data['page_title'] = 'Add Wrapper';
        
        $this->form_validation->set_rules('name', 'Wrapper Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/wrappers/add', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $wrapper_data = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'status' => $this->input->post('status') ? $this->input->post('status') : 'active'
            );
            
            if ($this->Wrapper_model->add_wrapper($wrapper_data)) {
                $this->session->set_flashdata('success', 'Wrapper added successfully');
                redirect('admin/wrappers');
            } else {
                $this->session->set_flashdata('error', 'Failed to add wrapper');
                redirect('admin/wrappers/add');
            }
        }
    }

    public function edit($id) {
        $data['page_title'] = 'Edit Wrapper';
        $data['wrapper'] = $this->Wrapper_model->get_by_id($id);
        
        if (!$data['wrapper']) {
            $this->session->set_flashdata('error', 'Wrapper not found');
            redirect('admin/wrappers');
        }
        
        $this->form_validation->set_rules('name', 'Wrapper Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/wrappers/edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $wrapper_data = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'status' => $this->input->post('status')
            );
            
            if ($this->Wrapper_model->update_wrapper($id, $wrapper_data)) {
                $this->session->set_flashdata('success', 'Wrapper updated successfully');
                redirect('admin/wrappers');
            } else {
                $this->session->set_flashdata('error', 'Failed to update wrapper');
                redirect('admin/wrappers/edit/' . $id);
            }
        }
    }

    public function delete($id) {
        if ($this->Wrapper_model->delete_wrapper($id)) {
            $this->session->set_flashdata('success', 'Wrapper deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete wrapper');
        }
        
        redirect('admin/wrappers');
    }
}