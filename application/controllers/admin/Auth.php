<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
    }

    public function login() {

        // Already logged in? Go to dashboard
        if ($this->session->userdata('admin_logged_in') == TRUE) {
            redirect('admin/dashboard');
        }

        $data['page_title'] = 'Admin Login';
        $data['error']      = '';

        // Form submitted
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $email    = trim($this->input->post('email'));
            $password = trim($this->input->post('password'));

            // Basic validation
            if (empty($email) || empty($password)) {
                $data['error'] = 'Please enter your email and password.';
                $this->load->view('admin/auth/login', $data);
                return;
            }

            // Look up user by email
            $user = $this->User_model->get_by_email($email);

            if (!$user) {
                $data['error'] = 'No account found with that email.';
                $this->load->view('admin/auth/login', $data);
                return;
            }

            // Check password
            if ($user['password'] !== md5($password)) {
                $data['error'] = 'Incorrect password. Please try again.';
                $this->load->view('admin/auth/login', $data);
                return;
            }

            // Check admin role
            if ($user['role'] !== 'admin') {
                $data['error'] = 'You do not have admin access.';
                $this->load->view('admin/auth/login', $data);
                return;
            }

            // Login successful - set session
            $this->session->set_userdata(array(
                'admin_logged_in' => TRUE,
                'admin_id'        => $user['id'],
                'admin_name'      => $user['name'],
                'admin_email'     => $user['email'],
            ));

            redirect('admin/dashboard');

        } else {
            // Show login page
            $this->load->view('admin/auth/login', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/auth/login');
    }
}