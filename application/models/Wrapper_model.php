<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wrapper_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get all active wrappers
    public function get_all_wrappers() {
        $this->db->where('status', 'active');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('wrappers');
        return $query->result_array();
    }

    // Get single wrapper
    public function get_wrapper($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('wrappers');
        return $query->row_array();
    }

    // Admin: Get all wrappers
    public function admin_get_all() {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('wrappers');
        return $query->result_array();
    }

    // Admin: Add wrapper
    public function add_wrapper($data) {
        return $this->db->insert('wrappers', $data);
    }

    // Admin: Update wrapper
    public function update_wrapper($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('wrappers', $data);
    }

    // Admin: Delete wrapper
    public function delete_wrapper($id) {
        $this->db->where('id', $id);
        return $this->db->delete('wrappers');
    }

    // Get wrapper by ID
    public function get_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('wrappers');
        return $query->row_array();
    }
}