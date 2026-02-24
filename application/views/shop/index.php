<style>
    .shop-container {
        max-width: 1400px;
        margin: 50px auto;
        padding: 0 30px;
    }
    
    .shop-header {
        margin-bottom: 40px;
    }
    
    .shop-header h1 {
        font-size: 42px;
        color: #2d5f3f;
        margin-bottom: 10px;
    }
    
    .shop-header p {
        font-size: 18px;
        color: #666;
    }
    
    .filters {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 20px;
        background: #f8fbf9;
        border-radius: 10px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .filter-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .filter-group label {
        font-weight: 500;
        color: #555;
    }
    
    .filter-group select {
        padding: 10px 20px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: white;
        cursor: pointer;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }
    
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .product-image {
        width: 100%;
        height: 280px;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 80px;
        position: relative;
        overflow: hidden;
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
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .add-to-cart-btn:hover {
        background: #3d7850;
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #999;
    }
    
    .empty-state i {
        font-size: 80px;
        margin-bottom: 20px;
        color: #ddd;
    }
</style>

<div class="shop-container">
    <!-- Header -->
    <div class="shop-header">
        <h1>Our Flower Collection</h1>
        <p>Explore our beautiful selection of fresh flowers and bouquets</p>
    </div>
    
    <!-- Filters -->
    <div class="filters">
        <div class="filter-group">
            <label>Sort by:</label>
            <select id="sortFilter" onchange="sortProducts()">
                <option value="default">Default</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="name">Name: A to Z</option>
            </select>
        </div>
        
        <div class="filter-group">
            <span style="color: #666;">Showing <?= count($products) ?> products</span>
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="products-grid" id="productsGrid">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card" data-price="<?= $product['price'] ?>" data-name="<?= $product['name'] ?>">
                    <div class="product-image">
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" alt="<?= $product['name'] ?>">
                        <?php else: ?>
                            <i class="fas fa-flower"></i>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?= $product['name'] ?></h3>
                        <p class="product-description"><?= $product['description'] ?></p>
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
            <div class="empty-state" style="grid-column: 1/-1;">
                <i class="fas fa-box-open"></i>
                <h2>No Products Available</h2>
                <p>Check back soon for new arrivals!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function sortProducts() {
    const sortValue = document.getElementById('sortFilter').value;
    const grid = document.getElementById('productsGrid');
    const products = Array.from(grid.getElementsByClassName('product-card'));
    
    products.sort((a, b) => {
        switch(sortValue) {
            case 'price-low':
                return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
            case 'price-high':
                return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
            case 'name':
                return a.dataset.name.localeCompare(b.dataset.name);
            default:
                return 0;
        }
    });
    
    products.forEach(product => grid.appendChild(product));
}
</script>