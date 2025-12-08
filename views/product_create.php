<?php
$pageTitle = 'Add Product';
include __DIR__ . '/partials/header.php';
?>
        <h1>Add New Product</h1>
        <div class="grid">
            <div class="card row-span-12">
                <form method="post" action="/products/create" class="product-form">
                    <div class="field">
                        <label for="name">PRODUCT NAME</label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            placeholder="Enter product name"
                            required
                        >
                    </div>
                    
                    <div class="field">
                        <label for="category">CATEGORY</label>
                        <select id="category" name="category" required>
                            <option value="">Select category</option>
                            <option value="Solar">Solar</option>
                            <option value="Wind">Wind</option>
                            <option value="Hydro">Hydro</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <div class="field">
                        <label for="price">PRICE (PHP)</label>
                        <input 
                            id="price" 
                            type="number" 
                            name="price" 
                            step="0.01"
                            min="0.01"
                            placeholder="0.00"
                            required
                        >
                    </div>
                    
                    <div class="field">
                        <label for="description">DESCRIPTION</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="5"
                            placeholder="Enter product description (optional)"
                        ></textarea>
                    </div>
                    
                    <div class="actions">
                        <button class="btn primary" type="submit">ADD PRODUCT</button>
                        <a class="btn ghost" href="/dashboard">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
<?php include __DIR__ . '/partials/footer.php'; ?>

