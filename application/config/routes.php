<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override']       = '';
$route['translate_uri_dashes'] = FALSE;

// -------------------------------------------------------
// USER ROUTES
// -------------------------------------------------------
$route['home']              = 'home/index';
$route['shop']              = 'shop/index';
$route['customize']         = 'customize/index';
$route['cart']              = 'cart/index';
$route['cart/add']          = 'cart/add';
$route['cart/update']       = 'cart/update';
$route['cart/remove/(:num)'] = 'cart/remove/$1';
$route['checkout']          = 'checkout/index';
$route['checkout/process']  = 'checkout/process';
$route['checkout/success/(:num)'] = 'checkout/success/$1';

// Customer Authentication
$route['customer_auth/register'] = 'customer_auth/register';
$route['customer_auth/login']    = 'customer_auth/login';
$route['customer_auth/logout']   = 'customer_auth/logout';
$route['register']               = 'customer_auth/register';
$route['login']                  = 'customer_auth/login';

// -------------------------------------------------------
// ADMIN ROUTES
// -------------------------------------------------------
$route['admin']                          = 'admin/auth/login';
$route['admin/dashboard']                = 'admin/dashboard/index';
$route['admin/auth/login']               = 'admin/auth/login';
$route['admin/auth/logout']              = 'admin/auth/logout';

// Admin Flowers
$route['admin/flowers']                  = 'admin/flowers/index';
$route['admin/flowers/add']              = 'admin/flowers/add';
$route['admin/flowers/edit/(:num)']      = 'admin/flowers/edit/$1';
$route['admin/flowers/delete/(:num)']    = 'admin/flowers/delete/$1';

// Admin Wrappers
$route['admin/wrappers']                 = 'admin/wrappers/index';
$route['admin/wrappers/add']             = 'admin/wrappers/add';
$route['admin/wrappers/edit/(:num)']     = 'admin/wrappers/edit/$1';
$route['admin/wrappers/delete/(:num)']   = 'admin/wrappers/delete/$1';

// Admin Products
$route['admin/products']                 = 'admin/products/index';
$route['admin/products/add']             = 'admin/products/add';
$route['admin/products/edit/(:num)']     = 'admin/products/edit/$1';
$route['admin/products/delete/(:num)']   = 'admin/products/delete/$1';

// Admin Orders
$route['admin/orders']                   = 'admin/orders/index';
$route['admin/orders/view/(:num)']       = 'admin/orders/view/$1';
$route['admin/orders/update_status']     = 'admin/orders/update_status';