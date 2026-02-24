<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get user by email (used for login)
    public function get_by_email($email) {
        $this->db->where('email', trim($email));
        $query = $this->db->get('users');
        return $query->row_array();
    }

    // Login check (email + password)
    public function login($email, $password) {
        $this->db->where('email', trim($email));
        $this->db->where('password', md5($password));
        $query = $this->db->get('users');
        return $query->row_array();
    }

    // Register new user
    public function register($data) {
        $data['password'] = md5($data['password']);
        return $this->db->insert('users', $data);
    }

    // Get user by ID
    public function get_user($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    // Update user
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Check if email exists
    public function email_exists($email) {
        $this->db->where('email', trim($email));
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    // Check if admin
    public function is_admin($id) {
        $this->db->where('id', $id);
        $this->db->where('role', 'admin');
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }
}