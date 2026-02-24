<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Bloom & Blossom' ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        
        /* Header & Navigation */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 600;
            color: #2d5f3f;
            text-decoration: none;
        }
        
        .logo i {
            color: #4a8f5f;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 35px;
        }
        
        .nav-menu a {
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            font-size: 15px;
        }
        
        .nav-menu a:hover,
        .nav-menu a.active {
            color: #4a8f5f;
        }
        
        .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 25px;
            border: 1px solid #e0e0e0;
        }
        
        .search-box input {
            border: none;
            background: none;
            outline: none;
            padding: 0 10px;
            width: 200px;
            font-size: 14px;
        }
        
        .search-box button {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 16px;
        }
        
        .cart-icon {
            position: relative;
            color: #4a8f5f;
            font-size: 22px;
            cursor: pointer;
            padding: 8px 12px;
            background: #f0f7f3;
            border-radius: 8px;
            border: 1px solid #d4e8dd;
        }
        
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
        }
        
        /* Flash Messages */
        .flash-message {
            max-width: 1400px;
            margin: 20px auto;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .flash-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .flash-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Main Content */
        .main-content {
            min-height: calc(100vh - 200px);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="logo">
                <i class="fas fa-seedling"></i>
                Byhappiest Flower
            </a>
            
            <!-- Navigation Menu -->
            <nav>
                <ul class="nav-menu">
                    <li><a href="<?= base_url('home') ?>" class="<?= $this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="<?= base_url('shop') ?>" class="<?= $this->uri->segment(1) == 'shop' ? 'active' : '' ?>">Shop</a></li>
                    <li><a href="<?= base_url('customize') ?>" class="<?= $this->uri->segment(1) == 'customize' ? 'active' : '' ?>">Custom Bouquet</a></li>
                    <li><a href="<?= base_url('about') ?>" class="<?= $this->uri->segment(1) == 'about' ? 'active' : '' ?>">About</a></li>
                    <li><a href="<?= base_url('contact') ?>" class="<?= $this->uri->segment(1) == 'contact' ? 'active' : '' ?>">Contact</a></li>
                </ul>
            </nav>
            
            <!-- Right Side: Search & Cart -->
            <div class="nav-right">
                <!-- Search Box -->
                <form action="<?= base_url('shop/search') ?>" method="get" class="search-box">
                    <input type="text" name="q" placeholder="Search flowers..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                
                <!-- Shopping Cart -->
                <a href="<?= base_url('cart') ?>" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <?php 
                    $cart = $this->session->userdata('cart');
                    $cart_count = $cart ? count($cart) : 0;
                    if ($cart_count > 0): 
                    ?>
                        <span class="cart-count"><?= $cart_count ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </header>
    
    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="flash-message flash-success">
            <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('error')): ?>
        <div class="flash-message flash-error">
            <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <main class="main-content">