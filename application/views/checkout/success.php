<style>
    .success-container {
        max-width: 800px;
        margin: 80px auto;
        padding: 0 30px;
        text-align: center;
    }
    
    .success-icon {
        width: 120px;
        height: 120px;
        background: #d4edda;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 60px;
        color: #28a745;
        animation: scaleIn 0.5s ease-out;
    }
    
    @keyframes scaleIn {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }
    
    .success-container h1 {
        font-size: 42px;
        color: #2d5f3f;
        margin-bottom: 15px;
    }
    
    .success-container p {
        font-size: 18px;
        color: #666;
        margin-bottom: 40px;
    }
    
    .order-details {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        padding: 40px;
        margin-bottom: 30px;
        text-align: left;
    }
    
    .order-id {
        background: #f8fbf9;
        padding: 20px;
        border-radius: 8px;
        border: 2px dashed #4a8f5f;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .order-id strong {
        font-size: 24px;
        color: #4a8f5f;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        color: #666;
        font-weight: 500;
    }
    
    .detail-value {
        color: #333;
        font-weight: 600;
    }
    
    .order-items {
        margin-top: 30px;
    }
    
    .order-items h3 {
        font-size: 20px;
        color: #2d5f3f;
        margin-bottom: 20px;
    }
    
    .order-item {
        padding: 15px;
        background: #f8fbf9;
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .actions {
        display: flex;
        gap: 15px;
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
    }
    
    .btn-primary {
        background: #4a8f5f;
        color: white;
    }
    
    .btn-primary:hover {
        background: #3d7850;
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background: white;
        color: #4a8f5f;
        border: 2px solid #4a8f5f;
    }
    
    .btn-secondary:hover {
        background: #f8fbf9;
    }
</style>

<div class="success-container">
    <div class="success-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    
    <h1>Order Placed Successfully!</h1>
    <p>Thank you for your order. We've received your request and will process it shortly.</p>
    
    <div class="order-details">
        <div class="order-id">
            <p style="margin: 0; color: #666; font-size: 14px;">Your Order ID</p>
            <strong>#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></strong>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Customer Name</span>
            <span class="detail-value"><?= $order['customer_name'] ?></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Phone Number</span>
            <span class="detail-value"><?= $order['customer_phone'] ?></span>
        </div>
        
        <?php if (!empty($order['customer_email'])): ?>
        <div class="detail-row">
            <span class="detail-label">Email</span>
            <span class="detail-value"><?= $order['customer_email'] ?></span>
        </div>
        <?php endif; ?>
        
        <div class="detail-row">
            <span class="detail-label">Delivery Address</span>
            <span class="detail-value"><?= $order['delivery_address'] ?></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Delivery Date</span>
            <span class="detail-value"><?= date('F j, Y', strtotime($order['delivery_date'])) ?></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Payment Method</span>
            <span class="detail-value"><?= $order['payment_method'] ?></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Order Status</span>
            <span class="detail-value" style="color: #f39c12;">
                <i class="fas fa-clock"></i> Pending
            </span>
        </div>
        
        <div class="order-items">
            <h3>Order Items</h3>
            <?php foreach ($order_items as $item): ?>
                <div class="order-item">
                    <div>
                        <strong>
                            <?php if ($item['product_type'] == 'ready-made'): ?>
                                <?php 
                                $this->load->model('Product_model');
                                $product = $this->Product_model->get_by_id($item['product_id']);
                                echo $product ? $product['name'] : 'Product';
                                ?>
                            <?php else: ?>
                                Custom Bouquet
                            <?php endif; ?>
                        </strong>
                        <span style="color: #666; font-size: 14px; margin-left: 10px;">
                            Qty: <?= $item['quantity'] ?>
                        </span>
                    </div>
                    <strong style="color: #4a8f5f;">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></strong>
                </div>
            <?php endforeach; ?>
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #f0f0f0;">
                <div style="display: flex; justify-content: space-between; font-size: 24px; font-weight: 700; color: #2d5f3f;">
                    <span>Total Amount</span>
                    <span>₱<?= number_format($order['total_price'], 2) ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
        <p style="margin: 0; color: #856404; line-height: 1.6;">
            <i class="fas fa-info-circle"></i>
            <strong>What's Next?</strong><br>
            We'll contact you soon to confirm your order. You'll receive your beautiful flowers on the scheduled delivery date.
        </p>
    </div>
    
    <div class="actions">
        <a href="<?= base_url('shop') ?>" class="btn btn-primary">
            <i class="fas fa-shopping-bag"></i>
            Continue Shopping
        </a>
        <a href="<?= base_url() ?>" class="btn btn-secondary">
            <i class="fas fa-home"></i>
            Back to Home
        </a>
    </div>
</div>