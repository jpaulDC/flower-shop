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
        <i class="fas fa-flower"></i> Manage Flowers
    </h2>
    <a href="<?= base_url('admin/flowers/add') ?>" class="btn-add">
        <i class="fas fa-plus"></i> Add New Flower
    </a>
</div>

<div class="data-table">
    <?php if (!empty($flowers)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Flower Name</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $flower): ?>
                    <tr>
                        <td><strong><?= $flower['id'] ?></strong></td>
                        <td><?= $flower['name'] ?></td>
                        <td><?= $flower['color'] ?></td>
                        <td><strong>₱<?= number_format($flower['price'], 2) ?></strong></td>
                        <td>
                            <span class="status-badge status-<?= $flower['status'] ?>">
                                <?= ucfirst($flower['status']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="<?= base_url('admin/flowers/edit/' . $flower['id']) ?>" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/flowers/delete/' . $flower['id']) ?>" 
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this flower?')">
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
            <h3>No Flowers Added Yet</h3>
            <p>Click "Add New Flower" to get started.</p>
        </div>
    <?php endif; ?>
</div>