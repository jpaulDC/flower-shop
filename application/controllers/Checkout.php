<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('Order_model');
    }

    public function index() {
        $cart = $this->session->userdata('cart');
        
        // Redirect if cart is empty
        if (empty($cart)) {
            $this->session->set_flashdata('error', 'Your cart is empty');
            redirect('shop');
        }
        
        $data['page_title'] = 'Checkout';
        $data['cart_items'] = $cart;
        $data['cart_total'] = $this->calculate_total($cart);
        
        $this->load->view('templates/header', $data);
        $this->load->view('checkout/index', $data);
        $this->load->view('templates/footer');
    }

    public function process() {
        $this->form_validation->set_rules('customer_name', 'Full Name', 'required');
        $this->form_validation->set_rules('customer_phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('delivery_address', 'Delivery Address', 'required');
        $this->form_validation->set_rules('delivery_date', 'Delivery Date', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $cart = $this->session->userdata('cart');
            
            if (empty($cart)) {
                $this->session->set_flashdata('error', 'Your cart is empty');
                redirect('shop');
            }
            
            // Prepare order data
            $order_data = array(
                'user_id' => $this->session->userdata('user_id') ? $this->session->userdata('user_id') : NULL,
                'customer_name' => $this->input->post('customer_name'),
                'customer_email' => $this->input->post('customer_email'),
                'customer_phone' => $this->input->post('customer_phone'),
                'delivery_address' => $this->input->post('delivery_address'),
                'delivery_date' => $this->input->post('delivery_date'),
                'total_price' => $this->calculate_total($cart),
                'payment_method' => 'Cash on Delivery',
                'notes' => $this->input->post('notes'),
                'status' => 'pending'
            );
            
            // Create order
            $order_id = $this->Order_model->create_order($order_data);
            
            if ($order_id) {
                // Prepare order items
                $order_items = array();
                
                foreach ($cart as $item) {
                    $order_item = array(
                        'order_id' => $order_id,
                        'product_type' => $item['type'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    );
                    
                    if ($item['type'] === 'ready-made') {
                        $order_item['product_id'] = $item['product_id'];
                    } else {
                        // Custom bouquet - store as JSON
                        $custom_details = array(
                            'flowers' => $item['flowers'],
                            'wrapper' => $item['wrapper'],
                            'message' => $item['message']
                        );
                        $order_item['custom_details'] = json_encode($custom_details);
                    }
                    
                    $order_items[] = $order_item;
                }
                
                // Save order items
                $this->Order_model->add_order_items($order_items);
                
                // Clear cart
                $this->session->unset_userdata('cart');
                
                // Success
                $this->session->set_flashdata('success', 'Order placed successfully! Order ID: ' . $order_id);
                redirect('checkout/success/' . $order_id);
            } else {
                $this->session->set_flashdata('error', 'Failed to place order. Please try again.');
                redirect('checkout');
            }
        }
    }

    public function success($order_id) {
        $data['page_title'] = 'Order Success';
        $data['order'] = $this->Order_model->get_order($order_id);
        $data['order_items'] = $this->Order_model->get_order_items($order_id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('checkout/success', $data);
        $this->load->view('templates/footer');
    }

    private function calculate_total($cart_items) {
        $total = 0;
        foreach ($cart_items as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
        return $total;
    }
}