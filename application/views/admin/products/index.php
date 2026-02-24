<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .btn-add {
        background: #4a8f5f;
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
    
    .btn-add:hover {
        background: #3d7850;
        transform: translateY(-2px);
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
    
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-active {
        background: #d4edda;
        color: #155724;
    }
    
    .status-inactive {
        background: #f8d7da;
        color: #721c24;
    }
    
    .featured-badge {
        background: #ffc107;
        color: #000;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        margin-left: 8px;
    }
    
    .action-btns {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-edit {
        background: #3498db;
        color: white;
    }
    
    .btn-edit:hover {
        background: #2980b9;
    }
    
    .btn-delete {
        background: #e74c3c;
        color: white;
    }
    
    .btn-delete:hover {
        background: #c0392b;
    }
</style>

<div class="page-header">
    <h2 class="section-title">
        <i class="fas fa-box"></i> Manage Products
    </h2>
    <a href="<?= base_url('admin/products/add') ?>" class="btn-add">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

<div class="data-table">
    <?php if (!empty($products)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><strong><?= $product['id'] ?></strong></td>
                        <td>
                            <?= $product['name'] ?>
                            <?php if ($product['featured']): ?>
                                <span class="featured-badge">FEATURED</span>
                            <?php endif; ?>
                        </td>
                        <td><?= substr($product['description'], 0, 60) ?>...</td>
                        <td><strong>₱<?= number_format($product['price'], 2) ?></strong></td>
                        <td><?= $product['featured'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <span class="status-badge status-<?= $product['status'] ?>">
                                <?= ucfirst($product['status']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/products/delete/' . $product['id']) ?>" 
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div style="text-align: center; padding: 60px 20px; color: #999;">
            <i class="fas fa-inbox" style="font-size: 60px; margin-bottom: 15px; color: #ddd;"></i>
            <h3>No Products Added Yet</h3>
            <p>Click "Add New Product" to get started.</p>
        </div>
    <?php endif; ?>
</div>