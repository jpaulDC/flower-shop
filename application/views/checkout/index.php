<style>
    .checkout-container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 0 30px;
    }
    
    .checkout-header {
        margin-bottom: 40px;
    }
    
    .checkout-header h1 {
        font-size: 42px;
        color: #2d5f3f;
        margin-bottom: 10px;
    }
    
    .checkout-content {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
    }
    
    .checkout-form {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        padding: 40px;
    }
    
    .form-section {
        margin-bottom: 35px;
    }
    
    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #2d5f3f;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
    }
    
    .form-group label .required {
        color: #e74c3c;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #4a8f5f;
        box-shadow: 0 0 0 3px rgba(74, 143, 95, 0.1);
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .order-summary-card {
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
    
    .summary-item {
        padding: 15px 0;
        border-bottom: 1px solid #f5f5f5;
    }
    
    .summary-item:last-of-type {
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 15px;
    }
    
    .item-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    
    .item-name {
        font-weight: 600;
        color: #333;
    }
    
    .item-price {
        font-weight: 600;
        color: #4a8f5f;
    }
    
    .item-details {
        font-size: 13px;
        color: #666;
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
        font-size: 24px;
        font-weight: 700;
        color: #2d5f3f;
        border-top: 2px solid #f0f0f0;
        margin-top: 10px;
    }
    
    .place-order-btn {
        width: 100%;
        background: #4a8f5f;
        color: white;
        padding: 18px;
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
    
    .place-order-btn:hover {
        background: #3d7850;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(74, 143, 95, 0.3);
    }
    
    .error-message {
        background: #f8d7da;
        color: #721c24;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }
    
    @media (max-width: 768px) {
        .checkout-content {
            grid-template-columns: 1fr;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="checkout-container">
    <div class="checkout-header">
        <h1>Checkout</h1>
        <p>Complete your order</p>
    </div>
    
    <div class="checkout-content">
        <!-- Checkout Form -->
        <div class="checkout-form">
            <?php if (validation_errors()): ?>
                <div class="error-message">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('checkout/process') ?>" method="post">
                <!-- Customer Information -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-user"></i> Customer Information
                    </h2>
                    
                    <div class="form-group">
                        <label>Full Name <span class="required">*</span></label>
                        <input type="text" name="customer_name" required 
                               value="<?= set_value('customer_name') ?>" 
                               placeholder="Enter your full name">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="customer_email" 
                                   value="<?= set_value('customer_email') ?>" 
                                   placeholder="your@email.com">
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="tel" name="customer_phone" required 
                                   value="<?= set_value('customer_phone') ?>" 
                                   placeholder="+63 912 345 6789">
                        </div>
                    </div>
                </div>
                
                <!-- Delivery Information -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-truck"></i> Delivery Information
                    </h2>
                    
                    <div class="form-group">
                        <label>Delivery Address <span class="required">*</span></label>
                        <textarea name="delivery_address" required 
                                  placeholder="Enter complete delivery address"><?= set_value('delivery_address') ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Delivery Date <span class="required">*</span></label>
                        <input type="date" name="delivery_date" required 
                               value="<?= set_value('delivery_date') ?>" 
                               min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Special Instructions (Optional)</label>
                        <textarea name="notes" 
                                  placeholder="Any special delivery instructions or messages"><?= set_value('notes') ?></textarea>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-credit-card"></i> Payment Method
                    </h2>
                    
                    <div style="padding: 20px; background: #f8fbf9; border-radius: 8px; border: 2px solid #4a8f5f;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <i class="fas fa-money-bill-wave" style="font-size: 32px; color: #4a8f5f;"></i>
                            <div>
                                <strong style="font-size: 18px; color: #2d5f3f;">Cash on Delivery</strong>
                                <p style="color: #666; margin-top: 5px;">Pay when you receive your order</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="place-order-btn">
                    <i class="fas fa-check-circle"></i>
                    Place Order
                </button>
            </form>
        </div>
        
        <!-- Order Summary -->
        <div class="order-summary-card">
            <h2 class="summary-title">Order Summary</h2>
            
            <?php foreach ($cart_items as $item): ?>
                <div class="summary-item">
                    <div class="item-header">
                        <span class="item-name"><?= $item['name'] ?></span>
                        <span class="item-price">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                    </div>
                    <div class="item-details">
                        <?php if ($item['type'] == 'custom'): ?>
                            Custom Bouquet • Qty: <?= $item['quantity'] ?>
                        <?php else: ?>
                            Ready-made • Qty: <?= $item['quantity'] ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
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
            
            <div style="background: #f8fbf9; padding: 15px; border-radius: 8px; margin-top: 20px;">
                <p style="font-size: 13px; color: #666; line-height: 1.6; margin: 0;">
                    <i class="fas fa-info-circle" style="color: #4a8f5f;"></i>
                    By placing this order, you agree to our terms and conditions.
                </p>
            </div>
        </div>
    </div>
</div>