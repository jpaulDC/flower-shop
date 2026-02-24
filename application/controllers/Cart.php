<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Product_model');
        $this->load->model('Flower_model');
        $this->load->model('Wrapper_model');
    }

    public function index() {
        $data['page_title'] = 'Shopping Cart';
        $data['cart_items'] = $this->session->userdata('cart') ? $this->session->userdata('cart') : array();
        $data['cart_total'] = $this->calculate_total($data['cart_items']);
        
        $this->load->view('templates/header', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('templates/footer');
    }

    // Add item to cart
    public function add() {
        $product_type = $this->input->post('product_type');
        $cart = $this->session->userdata('cart') ? $this->session->userdata('cart') : array();
        
        if ($product_type === 'ready-made') {
            $product_id = $this->input->post('product_id');
            $quantity = $this->input->post('quantity') ? $this->input->post('quantity') : 1;
            $product = $this->Product_model->get_product($product_id);
            
            if ($product) {
                $cart_item = array(
                    'type' => 'ready-made',
                    'product_id' => $product_id,
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity,
                    'image' => $product['image']
                );
                
                $cart[] = $cart_item;
                $this->session->set_userdata('cart', $cart);
                $this->session->set_flashdata('success', 'Product added to cart!');
            }
        } else if ($product_type === 'custom') {
            // Custom bouquet
            $flowers = $this->input->post('flowers'); // Array of flower selections
            $wrapper_id = $this->input->post('wrapper_id');
            $message = $this->input->post('message');
            
            $total_price = 0;
            $flower_details = array();
            
            // Calculate price and get flower details
            foreach ($flowers as $flower_selection) {
                $flower = $this->Flower_model->get_flower($flower_selection['flower_id']);
                if ($flower) {
                    $qty = $flower_selection['quantity'];
                    $flower_details[] = array(
                        'name' => $flower['name'],
                        'color' => $flower['color'],
                        'quantity' => $qty,
                        'price' => $flower['price']
                    );
                    $total_price += ($flower['price'] * $qty);
                }
            }
            
            // Add wrapper price
            $wrapper = $this->Wrapper_model->get_wrapper($wrapper_id);
            if ($wrapper) {
                $total_price += $wrapper['price'];
            }
            
            $cart_item = array(
                'type' => 'custom',
                'name' => 'Custom Bouquet',
                'flowers' => $flower_details,
                'wrapper' => $wrapper ? $wrapper['name'] : '',
                'message' => $message,
                'price' => $total_price,
                'quantity' => 1
            );
            
            $cart[] = $cart_item;
            $this->session->set_userdata('cart', $cart);
            $this->session->set_flashdata('success', 'Custom bouquet added to cart!');
        }
        
        redirect('cart');
    }

    // Update cart item quantity
    public function update() {
        $index = $this->input->post('index');
        $quantity = $this->input->post('quantity');
        
        $cart = $this->session->userdata('cart');
        
        if (isset($cart[$index])) {
            $cart[$index]['quantity'] = $quantity;
            $this->session->set_userdata('cart', $cart);
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    // Remove item from cart
    public function remove($index) {
        $cart = $this->session->userdata('cart');
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Reindex array
            $this->session->set_userdata('cart', $cart);
            $this->session->set_flashdata('success', 'Item removed from cart');
        }
        
        redirect('cart');
    }

    // Clear entire cart
    public function clear() {
        $this->session->unset_userdata('cart');
        $this->session->set_flashdata('success', 'Cart cleared');
        redirect('cart');
    }

    // Calculate total
    private function calculate_total($cart_items) {
        $total = 0;
        foreach ($cart_items as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
        return $total;
    }
}