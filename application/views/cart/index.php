<style>
    .cart-container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 0 30px;
    }
    
    .cart-header {
        margin-bottom: 40px;
    }
    
    .cart-header h1 {
        font-size: 42px;
        color: #2d5f3f;
        margin-bottom: 10px;
    }
    
    .cart-content {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
    }
    
    .cart-items {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        padding: 30px;
    }
    
    .cart-item {
        display: grid;
        grid-template-columns: 120px 1fr auto;
        gap: 20px;
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .item-image {
        width: 120px;
        height: 120px;
        background: #f5f5f5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #ccc;
    }
    
    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .item-details {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .item-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .item-type {
        font-size: 13px;
        color: #666;
        background: #f0f7f3;
        padding: 4px 10px;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 10px;
        width: fit-content;
    }
    
    .item-custom-details {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }
    
    .item-custom-details strong {
        color: #4a8f5f;
    }
    
    .item-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
    }
    
    .item-price {
        font-size: 24px;
        font-weight: 700;
        color: #4a8f5f;
    }
    
    .quantity-control {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 10px 0;
    }
    
    .quantity-btn {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .quantity-btn:hover {
        background: #4a8f5f;
        color: white;
        border-color: #4a8f5f;
    }
    
    .quantity-input {
        width: 50px;
        text-align: center;
        border: 1px solid #ddd;
        padding: 6px;
        border-radius: 6px;
        font-weight: 600;
    }
    
    .remove-btn {
        color: #e74c3c;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        padding: 5px 10px;
        transition: all 0.3s;
    }
    
    .remove-btn:hover {
        text-decoration: underline;
    }
    
    .cart-summary {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        padding: 30px;
        height: fit-content;
        position: sticky;
        top: 100px;
    }
    
    .summary-title {
        font-size: 24px;
        font-weight: 600;
        color: #2d5f3f;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        font-size: 16px;
        color: #666;
    }
    
    .summary-total {
        display: flex;
        justify-content: space-between;
        padding: 20px 0;
        font-size: 22px;
        font-weight: 700;
        color: #2d5f3f;
        border-top: 2px solid #f0f0f0;
        margin-top: 15px;
    }
    
    .checkout-btn {
        width: 100%;
        background: #4a8f5f;
        color: white;
        padding: 16px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .checkout-btn:hover {
        background: #3d7850;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(74, 143, 95, 0.3);
    }
    
    .continue-shopping {
        display: inline-block;
        margin-top: 20px;
        color: #4a8f5f;
        text-decoration: none;
        font-weight: 500;
    }
    
    .continue-shopping:hover {
        text-decoration: underline;
    }
    
    .empty-cart {
        text-align: center;
        padding: 80px 20px;
    }
    
    .empty-cart i {
        font-size: 100px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .empty-cart h2 {
        color: #666;
        margin-bottom: 15px;
    }
    
    @media (max-width: 768px) {
        .cart-content {
            grid-template-columns: 1fr;
        }
        
        .cart-item {
            grid-template-columns: 80px 1fr;
        }
        
        .item-actions {
            grid-column: 1 / -1;
            flex-direction: row;
            margin-top: 15px;
        }
    }
</style>

<div class="cart-container">
    <div class="cart-header">
        <h1>Shopping Cart</h1>
        <p>Review your items before checkout</p>
    </div>
    
    <?php if (!empty($cart_items)): ?>
        <div class="cart-content">
            <!-- Cart Items -->
            <div class="cart-items">
                <?php foreach ($cart_items as $index => $item): ?>
                    <div class="cart-item">
                        <div class="item-image">
                            <?php if ($item['type'] == 'ready-made' && !empty($item['image'])): ?>
                                <img src="<?= base_url('uploads/products/' . $item['image']) ?>" alt="<?= $item['name'] ?>">
                            <?php else: ?>
                                <i class="fas fa-flower"></i>
                            <?php endif; ?>
                        </div>
                        
                        <div class="item-details">
                            <div>
                                <h3 class="item-name"><?= $item['name'] ?></h3>
                                <span class="item-type">
                                    <?= $item['type'] == 'ready-made' ? 'Ready-made Bouquet' : 'Custom Bouquet' ?>
                                </span>
                                
                                <?php if ($item['type'] == 'custom'): ?>
                                    <div class="item-custom-details">
                                        <strong>Flowers:</strong>
                                        <ul style="margin: 5px 0 10px 20px;">
                                            <?php foreach ($item['flowers'] as $flower): ?>
                                                <li><?= $flower['quantity'] ?>x <?= $flower['name'] ?> (<?= $flower['color'] ?>)</li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <strong>Wrapper:</strong> <?= $item['wrapper'] ?><br>
                                        <?php if (!empty($item['message'])): ?>
                                            <strong>Message:</strong> "<?= $item['message'] ?>"
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="item-actions">
                            <span class="item-price">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                            
                            <div class="quantity-control">
                                <button class="quantity-btn" onclick="updateQuantity(<?= $index ?>, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="quantity-input" value="<?= $item['quantity'] ?>" 
                                       min="1" readonly>
                                <button class="quantity-btn" onclick="updateQuantity(<?= $index ?>, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <a href="<?= base_url('cart/remove/' . $index) ?>" class="remove-btn">
                                <i class="fas fa-trash"></i> Remove
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Cart Summary -->
            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                
                <div class="summary-row">
                    <span>Subtotal (<?= count($cart_items) ?> items)</span>
                    <span>₱<?= number_format($cart_total, 2) ?></span>
                </div>
                
                <div class="summary-row">
                    <span>Delivery Fee</span>
                    <span><?= $cart_total >= 1000 ? 'FREE' : '₱50.00' ?></span>
                </div>
                
                <div class="summary-total">
                    <span>Total</span>
                    <span>₱<?= number_format($cart_total + ($cart_total >= 1000 ? 0 : 50), 2) ?></span>
                </div>
                
                <a href="<?= base_url('checkout') ?>">
                    <button class="checkout-btn">
                        <i class="fas fa-lock"></i>
                        Proceed to Checkout
                    </button>
                </a>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="<?= base_url('shop') ?>" class="continue-shopping">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h2>Your cart is empty</h2>
            <p style="color: #999; margin-bottom: 30px;">Add some beautiful flowers to get started!</p>
            <a href="<?= base_url('shop') ?>" class="btn btn-primary" style="text-decoration: none; display: inline-block; padding: 15px 35px; background: #4a8f5f; color: white; border-radius: 8px; font-weight: 600;">
                <i class="fas fa-shopping-bag"></i> Start Shopping
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
function updateQuantity(index, change) {
    const currentQty = parseInt(document.querySelectorAll('.quantity-input')[index].value);
    const newQty = currentQty + change;
    
    if (newQty < 1) return;
    
    // Send AJAX request to update quantity
    $.ajax({
        url: '<?= base_url("cart/update") ?>',
        method: 'POST',
        data: {
            index: index,
            quantity: newQty
        },
        success: function(response) {
            location.reload();
        }
    });
}
</script>