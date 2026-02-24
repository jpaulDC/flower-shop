<!DOCTYPE html>
<html>
<head>
    <title><?= $page_title ?></title>
    <style>
        .customize-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        
        .builder-section {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .section-title {
            color: #FFB6C1;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .flower-selection {
            margin-bottom: 20px;
            padding: 15px;
            border: 2px solid #f0f0f0;
            border-radius: 8px;
        }
        
        .flower-row {
            display: grid;
            grid-template-columns: 2fr 2fr 1fr 1fr;
            gap: 15px;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .wrapper-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .wrapper-card {
            border: 2px solid #e0e0e0;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .wrapper-card:hover,
        .wrapper-card.selected {
            border-color: #FFB6C1;
            background: #FFF9F9;
        }
        
        .price-summary {
            background: #FFF9F9;
            padding: 20px;
            border-radius: 10px;
            position: sticky;
            top: 20px;
        }
        
        .total-price {
            font-size: 32px;
            color: #FFB6C1;
            font-weight: bold;
        }
        
        .add-flower-btn,
        .add-to-cart-btn {
            background: #FFB6C1;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .add-flower-btn:hover,
        .add-to-cart-btn:hover {
            background: #ff9fb6;
        }
        
        select, input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="customize-container">
        <h1>Build Your Perfect Bouquet</h1>
        
        <form id="customBouquetForm" method="post" action="<?= base_url('cart/add') ?>">
            <input type="hidden" name="product_type" value="custom">
            
            <div class="builder-section">
                <h2 class="section-title">Step 1: Choose Your Flowers</h2>
                
                <div id="flowerSelections">
                    <div class="flower-selection" data-index="0">
                        <div class="flower-row">
                            <div>
                                <label>Flower Type</label>
                                <select name="flowers[0][flower_id]" class="flower-select" data-index="0" required>
                                    <option value="">Select Flower</option>
                                    <?php foreach ($flowers as $flower_name => $flower_colors): ?>
                                        <optgroup label="<?= $flower_name ?>">
                                            <?php foreach ($flower_colors as $flower): ?>
                                                <option value="<?= $flower['id'] ?>" data-price="<?= $flower['price'] ?>">
                                                    <?= $flower['name'] ?> - <?= $flower['color'] ?> (₱<?= number_format($flower['price'], 2) ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div>
                                <label>Quantity</label>
                                <input type="number" name="flowers[0][quantity]" class="flower-quantity" data-index="0" min="1" value="1" required>
                            </div>
                            
                            <div>
                                <label>Price</label>
                                <p class="flower-price" data-index="0">₱0.00</p>
                            </div>
                            
                            <div>
                                <button type="button" class="remove-flower" data-index="0" style="display:none;">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" id="addFlowerBtn" class="add-flower-btn">+ Add Another Flower</button>
            </div>
            
            <div class="builder-section">
                <h2 class="section-title">Step 2: Choose Wrapper Style</h2>
                
                <div class="wrapper-options">
                    <?php foreach ($wrappers as $wrapper): ?>
                        <div class="wrapper-card" data-wrapper-id="<?= $wrapper['id'] ?>" data-price="<?= $wrapper['price'] ?>">
                            <input type="radio" name="wrapper_id" value="<?= $wrapper['id'] ?>" required style="display:none;">
                            <h3><?= $wrapper['name'] ?></h3>
                            <p>₱<?= number_format($wrapper['price'], 2) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="builder-section">
                <h2 class="section-title">Step 3: Add Personal Message (Optional)</h2>
                <textarea name="message" rows="4" placeholder="Write your special message here..."></textarea>
            </div>
            
            <div class="builder-section">
                <h2 class="section-title">Summary</h2>
                <div class="price-summary">
                    <div id="summaryDetails"></div>
                    <hr>
                    <div style="margin-top: 20px;">
                        <strong>Total Price:</strong>
                        <div class="total-price" id="totalPrice">₱0.00</div>
                    </div>
                    <button type="submit" class="add-to-cart-btn" style="width:100%; margin-top:20px;">Add to Cart</button>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        let flowerCount = 1;
        let flowerPrices = {};
        let wrapperPrice = 0;
        
        // Add flower button
        document.getElementById('addFlowerBtn').addEventListener('click', function() {
            const container = document.getElementById('flowerSelections');
            const newSelection = document.querySelector('.flower-selection').cloneNode(true);
            
            newSelection.dataset.index = flowerCount;
            newSelection.querySelector('.flower-select').name = `flowers[${flowerCount}][flower_id]`;
            newSelection.querySelector('.flower-select').dataset.index = flowerCount;
            newSelection.querySelector('.flower-quantity').name = `flowers[${flowerCount}][quantity]`;
            newSelection.querySelector('.flower-quantity').dataset.index = flowerCount;
            newSelection.querySelector('.flower-price').dataset.index = flowerCount;
            newSelection.querySelector('.remove-flower').dataset.index = flowerCount;
            newSelection.querySelector('.remove-flower').style.display = 'inline-block';
            
            container.appendChild(newSelection);
            flowerCount++;
            
            attachEventListeners();
        });
        
        // Attach event listeners
        function attachEventListeners() {
            document.querySelectorAll('.flower-select').forEach(select => {
                select.addEventListener('change', calculatePrice);
            });
            
            document.querySelectorAll('.flower-quantity').forEach(input => {
                input.addEventListener('input', calculatePrice);
            });
            
            document.querySelectorAll('.remove-flower').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = this.dataset.index;
                    delete flowerPrices[index];
                    this.closest('.flower-selection').remove();
                    calculatePrice();
                });
            });
            
            document.querySelectorAll('.wrapper-card').forEach(card => {
                card.addEventListener('click', function() {
                    document.querySelectorAll('.wrapper-card').forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                    this.querySelector('input[type="radio"]').checked = true;
                    wrapperPrice = parseFloat(this.dataset.price);
                    calculatePrice();
                });
            });
        }
        
        // Calculate total price
        function calculatePrice() {
            let total = 0;
            let summary = '';
            
            // Calculate flower prices
            document.querySelectorAll('.flower-select').forEach(select => {
                const index = select.dataset.index;
                const selectedOption = select.options[select.selectedIndex];
                const quantity = document.querySelector(`.flower-quantity[data-index="${index}"]`).value;
                
                if (selectedOption.value && quantity) {
                    const price = parseFloat(selectedOption.dataset.price);
                    const itemTotal = price * parseInt(quantity);
                    flowerPrices[index] = itemTotal;
                    
                    document.querySelector(`.flower-price[data-index="${index}"]`).textContent = 
                        `₱${itemTotal.toFixed(2)}`;
                    
                    summary += `<p>${quantity}x ${selectedOption.text}</p>`;
                    total += itemTotal;
                }
            });
            
            // Add wrapper price
            if (wrapperPrice > 0) {
                total += wrapperPrice;
                const selectedWrapper = document.querySelector('.wrapper-card.selected h3');
                if (selectedWrapper) {
                    summary += `<p>Wrapper: ${selectedWrapper.textContent}</p>`;
                }
            }
            
            document.getElementById('summaryDetails').innerHTML = summary;
            document.getElementById('totalPrice').textContent = `₱${total.toFixed(2)}`;
        }
        
        // Initialize
        attachEventListeners();
    </script>
</body>
</html>