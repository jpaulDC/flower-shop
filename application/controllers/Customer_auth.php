<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
    }

    // Customer Registration
    public function register() {
        // Already logged in? Go to home
        if ($this->session->userdata('customer_logged_in')) {
            redirect('home');
        }

        $data['page_title'] = 'Customer Registration';
        $data['error'] = '';

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            
            $name     = trim($this->input->post('name'));
            $email    = trim($this->input->post('email'));
            $password = trim($this->input->post('password'));
            $confirm  = trim($this->input->post('confirm_password'));

            // Validation
            if (empty($name) || empty($email) || empty($password)) {
                $data['error'] = 'All fields are required.';
                $this->load->view('templates/header');
                $this->load->view('customer/register', $data);
                $this->load->view('templates/footer');
                return;
            }

            if ($password !== $confirm) {
                $data['error'] = 'Passwords do not match.';
                $this->load->view('templates/header');
                $this->load->view('customer/register', $data);
                $this->load->view('templates/footer');
                return;
            }

            if (strlen($password) < 6) {
                $data['error'] = 'Password must be at least 6 characters.';
                $this->load->view('templates/header');
                $this->load->view('customer/register', $data);
                $this->load->view('templates/footer');
                return;
            }

            // Check if email exists
            if ($this->User_model->email_exists($email)) {
                $data['error'] = 'Email already registered. Please login.';
                $this->load->view('templates/header');
                $this->load->view('customer/register', $data);
                $this->load->view('templates/footer');
                return;
            }

            // Register user
            $user_data = array(
                'name'     => $name,
                'email'    => $email,
                'password' => md5($password),
                'role'     => 'customer'
            );

            if ($this->User_model->register($user_data)) {
                $this->session->set_flashdata('success', 'Registration successful! Please login.');
                redirect('customer_auth/login');
            } else {
                $data['error'] = 'Registration failed. Please try again.';
            }
        }

        $this->load->view('templates/header');
        $this->load->view('customer/register', $data);
        $this->load->view('templates/footer');
    }

    // Customer Login
    public function login() {
        // Already logged in?
        if ($this->session->userdata('customer_logged_in')) {
            redirect('home');
        }

        $data['page_title'] = 'Customer Login';
        $data['error'] = '';

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $email    = trim($this->input->post('email'));
            $password = trim($this->input->post('password'));

            if (empty($email) || empty($password)) {
                $data['error'] = 'Please enter email and password.';
                $this->load->view('templates/header');
                $this->load->view('customer/login', $data);
                $this->load->view('templates/footer');
                return;
            }

            $user = $this->User_model->get_by_email($email);

            if (!$user) {
                $data['error'] = 'No account found with that email.';
                $this->load->view('templates/header');
                $this->load->view('customer/login', $data);
                $this->load->view('templates/footer');
                return;
            }

            if ($user['password'] !== md5($password)) {
                $data['error'] = 'Incorrect password.';
                $this->load->view('templates/header');
                $this->load->view('customer/login', $data);
                $this->load->view('templates/footer');
                return;
            }

            if ($user['role'] !== 'customer') {
                $data['error'] = 'Please use customer login.';
                $this->load->view('templates/header');
                $this->load->view('customer/login', $data);
                $this->load->view('templates/footer');
                return;
            }

            // Login successful
            $this->session->set_userdata(array(
                'customer_logged_in' => TRUE,
                'customer_id'        => $user['id'],
                'customer_name'      => $user['name'],
                'customer_email'     => $user['email'],
            ));

            redirect('home');
        }

        $this->load->view('templates/header');
        $this->load->view('customer/login', $data);
        $this->load->view('templates/footer');
    }

    // Customer Logout
    public function logout() {
        $this->session->unset_userdata('customer_logged_in');
        $this->session->unset_userdata('customer_id');
        $this->session->unset_userdata('customer_name');
        $this->session->unset_userdata('customer_email');
        
        $this->session->set_flashdata('success', 'Logged out successfully.');
        redirect('home');
    }
}