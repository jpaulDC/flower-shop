<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .stat-info h3 {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
        font-weight: 500;
    }
    
    .stat-info .number {
        font-size: 36px;
        font-weight: 700;
        color: #2d3e50;
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: white;
    }
    
    .stat-card.orders .stat-icon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .stat-card.pending .stat-icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .stat-card.confirmed .stat-icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stat-card.delivered .stat-icon {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    
    .section-title {
        font-size: 24px;
        color: #2d3e50;
        margin-bottom: 25px;
        font-weight: 600;
    }
    
    .orders-table {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    table thead {
        background: #f8f9fa;
    }
    
    table th {
        padding: 18px;
        text-align: left;
        font-weight: 600;
        color: #555;
        font-size: 14px;
        border-bottom: 2px solid #e0e0e0;
    }
    
    table td {
        padding: 18px;
        border-bottom: 1px solid #f0f0f0;
        color: #666;
    }
    
    table tbody tr:hover {
        background: #f8f9fa;
    }
    
    .order-id {
        font-weight: 600;
        color: #2d3e50;
    }
    
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
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
    
    .action-btn {
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-view {
        background: #4a8f5f;
        color: white;
    }
    
    .btn-view:hover {
        background: #3d7850;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }
    
    .empty-state i {
        font-size: 60px;
        margin-bottom: 15px;
        color: #ddd;
    }
</style>

<h2 class="section-title">
    <i class="fas fa-chart-line"></i> Dashboard Overview
</h2>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card orders">
        <div class="stat-info">
            <h3>Total Orders</h3>
            <div class="number"><?= $total_orders ?></div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
    </div>
    
    <div class="stat-card pending">
        <div class="stat-info">
            <h3>Pending Orders</h3>
            <div class="number"><?= $pending_orders ?></div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
    </div>
    
    <div class="stat-card confirmed">
        <div class="stat-info">
            <h3>Confirmed Orders</h3>
            <div class="number"><?= $confirmed_orders ?></div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>
    
    <div class="stat-card delivered">
        <div class="stat-info">
            <h3>Delivered Orders</h3>
            <div class="number"><?= $delivered_orders ?></div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-box-check"></i>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<h2 class="section-title">
    <i class="fas fa-list"></i> Recent Orders
</h2>

<div class="orders-table">
    <?php if (!empty($recent_orders)): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total Amount</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_orders as $order): ?>
                    <tr>
                        <td class="order-id">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></td>
                        <td><?= $order['customer_name'] ?></td>
                        <td><?= $order['customer_phone'] ?></td>
                        <td><strong>₱<?= number_format($order['total_price'], 2) ?></strong></td>
                        <td><?= date('M j, Y', strtotime($order['delivery_date'])) ?></td>
                        <td>
                            <span class="status-badge status-<?= $order['status'] ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/orders/view/' . $order['id']) ?>" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>No Orders Yet</h3>
            <p>Orders will appear here once customers start placing them.</p>
        </div>
    <?php endif; ?>
</div>