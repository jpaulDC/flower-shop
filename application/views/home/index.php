<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, rgba(169, 169, 169, 0.95), rgba(128, 128, 128, 0.95)),
                    url('<?= base_url("assets/images/hero-bg.jpg") ?>');
        background-size: cover;
        background-position: center;
        padding: 120px 30px;
        text-align: center;
        color: white;
    }
    
    .hero h1 {
        font-size: 56px;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .hero p {
        font-size: 20px;
        margin-bottom: 40px;
        color: #f0f0f0;
    }
    
    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 15px 35px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary {
        background: #4a8f5f;
        color: white;
        box-shadow: 0 4px 15px rgba(74, 143, 95, 0.3);
    }
    
    .btn-primary:hover {
        background: #3d7850;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 143, 95, 0.4);
    }
    
    .btn-secondary {
        background: white;
        color: #4a8f5f;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .btn-secondary:hover {
        background: #f8f8f8;
        transform: translateY(-2px);
    }
    
    /* Featured Products Section */
    .section {
        max-width: 1400px;
        margin: 80px auto;
        padding: 0 30px;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .section-header h2 {
        font-size: 38px;
        color: #2d5f3f;
        margin-bottom: 15px;
    }
    
    .section-header p {
        font-size: 18px;
        color: #666;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }
    
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .product-image {
        width: 100%;
        height: 280px;
        object-fit: cover;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 80px;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-info {
        padding: 20px;
    }
    
    .product-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .product-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
        line-height: 1.5;
    }
    
    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .product-price {
        font-size: 24px;
        font-weight: 700;
        color: #4a8f5f;
    }
    
    .add-to-cart-btn {
        background: #4a8f5f;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .add-to-cart-btn:hover {
        background: #3d7850;
    }
    
    /* Features Section */
    .features {
        background: #f8fbf9;
        padding: 60px 30px;
        margin-top: 80px;
    }
    
    .features-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
    }
    
    .feature-item {
        text-align: center;
    }
    
    .feature-icon {
        font-size: 48px;
        color: #4a8f5f;
        margin-bottom: 20px;
    }
    
    .feature-item h3 {
        font-size: 20px;
        color: #2d5f3f;
        margin-bottom: 10px;
    }
    
    .feature-item p {
        color: #666;
        line-height: 1.6;
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <h1>Beautiful Fresh Flowers</h1>
    <p>Create stunning bouquets and arrangements for every special occasion</p>
    <div class="hero-buttons">
        <a href="<?= base_url('shop') ?>" class="btn btn-primary">
            <i class="fas fa-shopping-bag"></i>
            Shop Now
        </a>
        <a href="<?= base_url('customize') ?>" class="btn btn-secondary">
            <i class="fas fa-palette"></i>
            Create Custom Bouquet
        </a>
    </div>
</section>

<!-- Featured Products -->
<section class="section">
    <div class="section-header">
        <h2>Featured Bouquets</h2>
        <p>Handpicked selections for your special moments</p>
    </div>
    
    <div class="products-grid">
        <?php if (!empty($featured_products)): ?>
            <?php foreach ($featured_products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if ($product['image']): ?>
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" alt="<?= $product['name'] ?>">
                        <?php else: ?>
                            <i class="fas fa-flower"></i>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?= $product['name'] ?></h3>
                        <p class="product-description"><?= substr($product['description'], 0, 80) ?>...</p>
                        <div class="product-footer">
                            <span class="product-price">₱<?= number_format($product['price'], 2) ?></span>
                            <form action="<?= base_url('cart/add') ?>" method="post" style="display: inline;">
                                <input type="hidden" name="product_type" value="ready-made">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="grid-column: 1/-1; text-align: center; color: #999;">No featured products available at the moment.</p>
        <?php endif; ?>
    </div>
    
    <div style="text-align: center; margin-top: 50px;">
        <a href="<?= base_url('shop') ?>" class="btn btn-primary">
            View All Products <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

<!-- Features -->
<section class="features">
    <div class="features-grid">
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-truck"></i>
            </div>
            <h3>Free Delivery</h3>
            <p>Free delivery on orders over ₱1,000</p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h3>Fresh Flowers</h3>
            <p>100% fresh flowers guaranteed</p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-palette"></i>
            </div>
            <h3>Custom Designs</h3>
            <p>Build your own unique bouquet</p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h3>Made with Love</h3>
            <p>Each bouquet crafted with care</p>
        </div>
    </div>
</section>