<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flower_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get all active flowers
    public function get_all_flowers() {
        $this->db->where('status', 'active');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('flowers');
        return $query->result_array();
    }

    // Get flowers grouped by name
    public function get_flowers_grouped() {
        $this->db->where('status', 'active');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('flowers');
        $flowers = $query->result_array();
        
        $grouped = array();
        foreach ($flowers as $flower) {
            $grouped[$flower['name']][] = $flower;
        }
        return $grouped;
    }

    // Get single flower
    public function get_flower($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('flowers');
        return $query->row_array();
    }

    // Admin: Get all flowers
    public function admin_get_all() {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('flowers');
        return $query->result_array();
    }

    // Admin: Add flower
    public function add_flower($data) {
        return $this->db->insert('flowers', $data);
    }

    // Admin: Update flower
    public function update_flower($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('flowers', $data);
    }

    // Admin: Delete flower
    public function delete_flower($id) {
        $this->db->where('id', $id);
        return $this->db->delete('flowers');
    }

    // Get flower by ID
    public function get_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('flowers');
        return $query->row_array();
    }
}