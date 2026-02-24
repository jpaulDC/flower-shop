<style>
    .auth-container {
        max-width: 500px;
        margin: 80px auto;
        padding: 0 30px;
    }
    
    .auth-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 50px 40px;
    }
    
    .auth-header {
        text-align: center;
        margin-bottom: 35px;
    }
    
    .auth-header h1 {
        font-size: 32px;
        color: #2d5f3f;
        margin-bottom: 10px;
    }
    
    .auth-header p {
        color: #666;
        font-size: 15px;
    }
    
    .form-group {
        margin-bottom: 22px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 14px;
    }
    
    .form-group input {
        width: 100%;
        padding: 14px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #4a8f5f;
        box-shadow: 0 0 0 3px rgba(74,143,95,0.1);
    }
    
    .submit-btn {
        width: 100%;
        padding: 16px;
        background: #4a8f5f;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 10px;
        transition: all 0.3s;
    }
    
    .submit-btn:hover {
        background: #3d7850;
        transform: translateY(-2px);
    }
    
    .error-box {
        background: #f8d7da;
        color: #721c24;
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
        font-size: 14px;
    }
    
    .auth-footer {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        color: #666;
    }
    
    .auth-footer a {
        color: #4a8f5f;
        font-weight: 600;
        text-decoration: none;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><i class="fas fa-user-plus"></i> Create Account</h1>
            <p>Join Bloom & Blossom today</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-box">
                <i class="fas fa-exclamation-circle"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('customer_auth/register') ?>" method="post">
            
            <div class="form-group">
                <label>Full Name <span style="color:#e74c3c;">*</span></label>
                <input type="text" name="name" required 
                       value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
                       placeholder="Enter your full name">
            </div>
            
            <div class="form-group">
                <label>Email Address <span style="color:#e74c3c;">*</span></label>
                <input type="email" name="email" required 
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                       placeholder="your@email.com">
            </div>
            
            <div class="form-group">
                <label>Password <span style="color:#e74c3c;">*</span></label>
                <input type="password" name="password" required 
                       placeholder="At least 6 characters">
            </div>
            
            <div class="form-group">
                <label>Confirm Password <span style="color:#e74c3c;">*</span></label>
                <input type="password" name="confirm_password" required 
                       placeholder="Re-enter your password">
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fas fa-user-check"></i> Create Account
            </button>
        </form>
        
        <div class="auth-footer">
            Already have an account? <a href="<?= base_url('customer_auth/login') ?>">Login here</a>
        </div>
    </div>
</div>