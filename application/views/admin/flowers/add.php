<style>
    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 40px;
        max-width: 700px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #4a8f5f;
        box-shadow: 0 0 0 3px rgba(74, 143, 95, 0.1);
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
    
    .btn-submit {
        background: #4a8f5f;
        color: white;
        padding: 14px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        background: #3d7850;
    }
    
    .btn-cancel {
        background: #95a5a6;
        color: white;
        padding: 14px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }
    
    .btn-cancel:hover {
        background: #7f8c8d;
    }
</style>

<h2 class="section-title">
    <i class="fas fa-flower"></i> <?= isset($flower) ? 'Edit' : 'Add New' ?> Flower
</h2>

<div class="form-card">
    <?php echo validation_errors('<div class="flash-message flash-error">', '</div>'); ?>
    
    <form action="<?= isset($flower) ? base_url('admin/flowers/edit/' . $flower['id']) : base_url('admin/flowers/add') ?>" method="post">
        
        <div class="form-group">
            <label>Flower Name <span style="color: #e74c3c;">*</span></label>
            <input type="text" name="name" required 
                   value="<?= isset($flower) ? $flower['name'] : set_value('name') ?>" 
                   placeholder="e.g., Rose, Tulip, Sunflower">
        </div>
        
        <div class="form-group">
            <label>Color <span style="color: #e74c3c;">*</span></label>
            <input type="text" name="color" required 
                   value="<?= isset($flower) ? $flower['color'] : set_value('color') ?>" 
                   placeholder="e.g., Red, Pink, Yellow">
        </div>
        
        <div class="form-group">
            <label>Price (₱) <span style="color: #e74c3c;">*</span></label>
            <input type="number" name="price" step="0.01" required 
                   value="<?= isset($flower) ? $flower['price'] : set_value('price') ?>" 
                   placeholder="e.g., 50.00">
        </div>
        
        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="active" <?= (isset($flower) && $flower['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= (isset($flower) && $flower['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> <?= isset($flower) ? 'Update' : 'Add' ?> Flower
            </button>
            <a href="<?= base_url('admin/flowers') ?>" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>