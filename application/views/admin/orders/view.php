<style>
    .order-header {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .order-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .order-title h2 {
        font-size: 28px;
        color: #2d3e50;
    }
    
    .order-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }
    
    .order-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3e50;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
    }
    
    .info-label {
        color: #666;
        font-weight: 500;
    }
    
    .info-value {
        color: #333;
        font-weight: 600;
        text-align: right;
    }
    
    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .status-delivered {
        background: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    
    .status-update-form {
        margin-top: 20px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    
    .status-update-form select {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        margin-bottom: 15px;
    }
    
    .btn-update {
        background: #4a8f5f;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        transition: all 0.3s;
    }
    
    .btn-update:hover {
        background: #3d7850;
    }
    
    .order-items-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .order-items-table th {
        background: #f8f9fa;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        border-bottom: 2px solid #e0e0e0;
    }
    
    .order-items-table td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .item-details {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
    }
    
    .total-row {
        background: #f8f9fa;
        font-weight: 700;
        font-size: 18px;
        color: #2d3e50;
    }
    
    .btn-back {
        background: #95a5a6;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-back:hover {
        background: #7f8c8d;
    }
</style>

<div class="order-header">
    <div class="order-title">
        <h2>Order #<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></h2>
        <span class="status-badge status-<?= $order['status'] ?>">
            <?= ucfirst($order['status']) ?>
        </span>
    </div>
    
    <a href="<?= base_url('admin/orders') ?>" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Orders
    </a>
</div>

<div class="order-grid">
    <!-- Customer Information -->
    <div class="order-section">
        <h3 class="section-title">
            <i class="fas fa-user"></i> Customer Information
        </h3>
        
        <div class="info-row">
            <span class="info-label">Name</span>
            <span class="info-value"><?= $order['customer_name'] ?></span>
        </div>
        
        <?php if (!empty($order['customer_email'])): ?>
        <div class="info-row">
            <span class="info-label">Email</span>
            <span class="info-value"><?= $order['customer_email'] ?></span>
        </div>
        <?php endif; ?>
        
        <div class="info-row">
            <span class="info-label">Phone</span>
            <span class="info-value"><?= $order['customer_phone'] ?></span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Delivery Address</span>
            <span class="info-value"><?= $order['delivery_address'] ?></span>
        </div>
    </div>
    
    <!-- Order Information -->
    <div class="order-section">
        <h3 class="section-title">
            <i class="fas fa-info-circle"></i> Order Information
        </h3>
        
        <div class="info-row">
            <span class="info-label">Order Date</span>
            <span class="info-value"><?= date('M j, Y g:i A', strtotime($order['created_at'])) ?></span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Delivery Date</span>
            <span class="info-value"><?= date('M j, Y', strtotime($order['delivery_date'])) ?></span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Payment Method</span>
            <span class="info-value"><?= $order['payment_method'] ?></span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Total Amount</span>
            <span class="info-value" style="color: #4a8f5f; font-size: 20px;">₱<?= number_format($order['total_price'], 2) ?></span>
        </div>
        
        <?php if (!empty($order['notes'])): ?>
        <div class="info-row">
            <span class="info-label">Special Instructions</span>
            <span class="info-value"><?= $order['notes'] ?></span>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Order Items -->
<div class="order-section">
    <h3 class="section-title">
        <i class="fas fa-box"></i> Order Items
    </h3>
    
    <table class="order-items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td>
                        <strong>
                            <?php if ($item['product_type'] == 'ready-made' && $item['product_id']): ?>
                                <?php 
                                $product = $this->Product_model->get_by_id($item['product_id']);
                                echo $product ? $product['name'] : 'Product';
                                ?>
                            <?php else: ?>
                                Custom Bouquet
                            <?php endif; ?>
                        </strong>
                        
                        <?php if ($item['product_type'] == 'custom' && !empty($item['custom_details'])): ?>
                            <?php 
                            $custom = json_decode($item['custom_details'], true);
                            if ($custom):
                            ?>
                                <div class="item-details">
                                    <strong>Flowers:</strong>
                                    <ul style="margin: 5px 0 5px 20px;">
                                        <?php foreach ($custom['flowers'] as $flower): ?>
                                            <li><?= $flower['quantity'] ?>x <?= $flower['name'] ?> (<?= $flower['color'] ?>)</li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <strong>Wrapper:</strong> <?= $custom['wrapper'] ?><br>
                                    <?php if (!empty($custom['message'])): ?>
                                        <strong>Message:</strong> "<?= $custom['message'] ?>"
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= ucfirst(str_replace('-', ' ', $item['product_type'])) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>₱<?= number_format($item['price'], 2) ?></td>
                    <td><strong>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></strong></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">Total Amount</td>
                <td>₱<?= number_format($order['total_price'], 2) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Update Status -->
<div class="order-section">
    <h3 class="section-title">
        <i class="fas fa-edit"></i> Update Order Status
    </h3>
    
    <form action="<?= base_url('admin/orders/update_status') ?>" method="post" class="status-update-form">
        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
        
        <label style="display: block; margin-bottom: 10px; font-weight: 600;">Select New Status:</label>
        <select name="status" required>
            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="confirmed" <?= $order['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
            <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
            <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
        
        <button type="submit" class="btn-update">
            <i class="fas fa-check"></i> Update Status
        </button>
    </form>
</div>