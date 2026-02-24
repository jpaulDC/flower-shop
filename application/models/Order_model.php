<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Create new order
    public function create_order($order_data)
    {
        $this->db->insert('orders', $order_data);
        return $this->db->insert_id();
    }

    // Add order items
    public function add_order_items($items)
    {
        if (empty($items)) {
            return false;
        }

        // Kung single item lang at hindi multidimensional array, i-wrap sa isa pang array
        if (isset($items['order_id'])) {
            $items = array($items);
        }

        return $this->db->insert_batch('order_items', $items);
    }
    // Get user orders
    public function get_user_orders($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('orders');
        return $query->result_array();
    }

    // Get order by ID
    public function get_order($order_id)
    {
        $this->db->where('id', $order_id);
        $query = $this->db->get('orders');
        return $query->row_array();
    }

    // Get order items
    public function get_order_items($order_id)
    {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get('order_items');
        return $query->result_array();
    }

    // Admin: Get all orders
    public function admin_get_all_orders()
    {
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('orders');
        return $query->result_array();
    }

    // Admin: Update order status
    public function update_order_status($order_id, $status)
    {
        $this->db->where('id', $order_id);
        return $this->db->update('orders', array('status' => $status));
    }

    // Get orders by status
    public function get_orders_by_status($status)
    {
        $this->db->where('status', $status);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('orders');
        return $query->result_array();
    }
    //     public function delete_order($order_id)
    //     {
    //         // Burahin muna ang items bago ang main order
    //         $this->db->where('order_id', $order_id);
    //         $this->db->delete('order_items');

    //         $this->db->where('id', $order_id);
    //         return $this->db->delete('orders');
    //     }
}
