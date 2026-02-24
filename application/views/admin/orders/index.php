<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .filter-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .filter-tab {
        padding: 10px 20px;
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        color: #666;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .filter-tab.active,
    .filter-tab:hover {
        background: #4a8f5f;
        color: white;
        border-color: #4a8f5f;
    }
    
    .data-table {
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
        font-size: 16px;
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
    
    .btn-view {
        background: #4a8f5f;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s;
    }
    
    .btn-view:hover {
        background: #3d7850;
    }
</style>

<div class="page-header">
    <h2 class="section-title">
        <i class="fas fa-shopping-cart"></i> Manage Orders
    </h2>
</div>

<div class="data-table">
    <?php if (!empty($orders)): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total Amount</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="order-id">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></td>
                        <td>
                            <strong><?= $order['customer_name'] ?></strong>
                            <?php if (!empty($order['customer_email'])): ?>
                                <br><small style="color: #999;"><?= $order['customer_email'] ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?= $order['customer_phone'] ?></td>
                        <td><strong style="color: #4a8f5f;">₱<?= number_format($order['total_price'], 2) ?></strong></td>
                        <td><?= date('M j, Y', strtotime($order['delivery_date'])) ?></td>
                        <td>
                            <span class="status-badge status-<?= $order['status'] ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td><?= date('M j, Y g:i A', strtotime($order['created_at'])) ?></td>
                        <td>
                            <a href="<?= base_url('admin/orders/view/' . $order['id']) ?>" class="btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div style="text-align: center; padding: 60px 20px; color: #999;">
            <i class="fas fa-inbox" style="font-size: 60px; margin-bottom: 15px; color: #ddd;"></i>
            <h3>No Orders Yet</h3>
            <p>Orders will appear here once customers start placing them.</p>
        </div>
    <?php endif; ?>
</div>