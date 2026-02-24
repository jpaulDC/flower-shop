<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get all active products
    public function get_all_products($limit = NULL, $offset = NULL) {
        $this->db->where('status', 'active');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // Get featured products
    public function get_featured_products($limit = 6) {
        $this->db->where('status', 'active');
        $this->db->where('featured', 1);
        $this->db->limit($limit);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // Get single product by ID
    public function get_product($id) {
        $this->db->where('id', $id);
        $this->db->where('status', 'active');
        $query = $this->db->get('products');
        return $query->row_array();
    }

    // Admin: Get all products including inactive
    public function admin_get_all() {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // Admin: Add new product
    public function add_product($data) {
        return $this->db->insert('products', $data);
    }

    // Admin: Update product
    public function update_product($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    // Admin: Delete product
    public function delete_product($id) {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    // Get product by ID (admin)
    public function get_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->row_array();
    }
}