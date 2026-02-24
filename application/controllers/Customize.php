<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customize extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Flower_model');
        $this->load->model('Wrapper_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $data['page_title'] = 'Build Your Bouquet - Flower Shop';
        $data['flowers'] = $this->Flower_model->get_flowers_grouped();
        $data['wrappers'] = $this->Wrapper_model->get_all_wrappers();
        
        $this->load->view('templates/header', $data);
        $this->load->view('customize/index', $data);
        $this->load->view('templates/footer');
    }

    // AJAX: Get flower price
    public function get_flower_price() {
        $flower_id = $this->input->post('flower_id');
        $flower = $this->Flower_model->get_flower($flower_id);
        
        if ($flower) {
            echo json_encode(array('success' => true, 'price' => $flower['price']));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    // AJAX: Get wrapper price
    public function get_wrapper_price() {
        $wrapper_id = $this->input->post('wrapper_id');
        $wrapper = $this->Wrapper_model->get_wrapper($wrapper_id);
        
        if ($wrapper) {
            echo json_encode(array('success' => true, 'price' => $wrapper['price']));
        } else {
            echo json_encode(array('success' => false));
        }
    }
}