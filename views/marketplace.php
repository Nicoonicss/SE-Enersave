<?php
$pageTitle = 'Marketplace';
include __DIR__ . '/partials/header.php';
?>
        <div class="marketplace-header">
            <div class="marketplace-title-section">
                <h1 class="marketplace-title">MARKETPLACE</h1>
                <p class="marketplace-subtitle">Find affordable renewable energy solutions near you.</p>
            </div>
            
            <div class="marketplace-controls">
                <div class="filter-tabs">
                    <button class="filter-tab active" data-category="solar">Solar</button>
                    <button class="filter-tab" data-category="wind">Wind</button>
                    <button class="filter-tab" data-category="hydro">Hydro</button>
                    <button class="filter-tab" data-category="all">All</button>
                </div>
                
                <div class="marketplace-actions">
                    <select class="sort-dropdown">
                        <option>Sort: Price</option>
                        <option>Sort: Name</option>
                        <option>Sort: Newest</option>
                    </select>
                    
                    <div class="search-bar">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 19L14.65 14.65" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="text" placeholder="Search Product..." class="search-input">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="product-listings-section">
            <h2 class="listings-title">PRODUCT LISTINGS</h2>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image">
                        <div class="product-image-placeholder">
                            <svg width="100" height="80" viewBox="0 0 100 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="10" y="10" width="25" height="20" fill="#1f2937" rx="2"/>
                                <rect x="40" y="10" width="25" height="20" fill="#1f2937" rx="2"/>
                                <rect x="70" y="10" width="25" height="20" fill="#1f2937" rx="2"/>
                                <rect x="25" y="35" width="50" height="15" fill="#9ca3af" rx="2"/>
                                <rect x="30" y="55" width="20" height="10" fill="#374151" rx="2"/>
                                <line x1="50" y1="55" x2="50" y2="65" stroke="#6b7280" stroke-width="1"/>
                                <line x1="55" y1="55" x2="55" y2="65" stroke="#6b7280" stroke-width="1"/>
                            </svg>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Solar Starter Kit</h3>
                        <p class="product-price">P5,000</p>
                        <p class="product-supplier">GreenTech</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-buy-now">BUY NOW</button>
                        <button class="btn-add-cart">ADD TO CART</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <div class="product-image-placeholder">
                            <svg width="100" height="80" viewBox="0 0 100 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="30" r="15" fill="#374151" stroke="#6b7280" stroke-width="2"/>
                                <path d="M50 15 L50 5 M50 45 L50 55" stroke="#6b7280" stroke-width="2" stroke-linecap="round"/>
                                <path d="M35 30 L25 30 M65 30 L75 30" stroke="#6b7280" stroke-width="2" stroke-linecap="round"/>
                                <rect x="30" y="50" width="40" height="8" fill="#9ca3af" rx="2"/>
                                <rect x="35" y="62" width="30" height="6" fill="#d1d5db" rx="2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Portable Wind Turbine</h3>
                        <p class="product-price">P12,000</p>
                        <p class="product-supplier">AeroPower</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-buy-now">BUY NOW</button>
                        <button class="btn-add-cart">ADD TO CART</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <div class="product-image-placeholder">
                            <svg width="100" height="80" viewBox="0 0 100 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 40 Q20 20, 40 20 L60 20 Q80 20, 80 40 L80 50 Q80 60, 70 60 L30 60 Q20 60, 20 50 Z" fill="#3b82f6" opacity="0.3"/>
                                <path d="M20 40 Q20 20, 40 20 L60 20 Q80 20, 80 40" stroke="#2563eb" stroke-width="2" fill="none"/>
                                <circle cx="50" cy="35" r="8" fill="#2563eb"/>
                                <rect x="45" y="50" width="10" height="15" fill="#1e40af" rx="2"/>
                                <path d="M30 65 L70 65" stroke="#1e40af" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Micro-Hydro System</h3>
                        <p class="product-price">P25,000</p>
                        <p class="product-supplier">AquaFlow Solutions</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-buy-now">BUY NOW</button>
                        <button class="btn-add-cart">ADD TO CART</button>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image">
                        <div class="product-image-placeholder">
                            <svg width="100" height="80" viewBox="0 0 100 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="20" y="15" width="60" height="40" fill="#fbbf24" rx="2"/>
                                <rect x="25" y="20" width="50" height="30" fill="#f59e0b" rx="2"/>
                                <path d="M30 55 L30 70 M40 55 L40 70 M50 55 L50 70 M60 55 L60 70" stroke="#f59e0b" stroke-width="2" stroke-linecap="round"/>
                                <rect x="35" y="72" width="30" height="4" fill="#d97706" rx="2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Solar Water Heater</h3>
                        <p class="product-price">P8,500</p>
                        <p class="product-supplier">SunHeat Co.</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-buy-now">BUY NOW</button>
                        <button class="btn-add-cart">ADD TO CART</button>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
        .marketplace-header {
            margin-bottom: 32px;
        }
        
        .marketplace-title-section {
            margin-bottom: 24px;
        }
        
        .marketplace-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 8px 0;
            letter-spacing: 1px;
        }
        
        .marketplace-subtitle {
            font-size: 1rem;
            color: var(--text);
            margin: 0;
        }
        
        .marketplace-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .filter-tabs {
            display: flex;
            gap: 12px;
        }
        
        .filter-tab {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: #f3f4f6;
            color: var(--text);
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .filter-tab:hover {
            background: #e5e7eb;
        }
        
        .filter-tab.active {
            background: #27ae60;
            color: white;
        }
        
        .marketplace-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .sort-dropdown {
            padding: 10px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            color: var(--text);
            font-size: 0.9375rem;
            cursor: pointer;
            outline: none;
        }
        
        .search-bar {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .search-icon {
            position: absolute;
            left: 12px;
            pointer-events: none;
        }
        
        .search-input {
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #f9fafb;
            font-size: 0.9375rem;
            width: 250px;
            outline: none;
            transition: all 0.2s ease;
        }
        
        .search-input:focus {
            background: white;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(45, 156, 219, 0.1);
        }
        
        .product-listings-section {
            margin-top: 40px;
        }
        
        .listings-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 24px 0;
            letter-spacing: 1px;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }
        
        .product-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }
        
        .product-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .product-image {
            width: 100%;
            height: 180px;
            background: #f9fafb;
            border-radius: 8px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-info {
            margin-bottom: 16px;
        }
        
        .product-name {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 8px 0;
        }
        
        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #27ae60;
            margin: 0 0 4px 0;
        }
        
        .product-supplier {
            font-size: 0.875rem;
            color: var(--muted);
            margin: 0;
        }
        
        .product-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .btn-buy-now,
        .btn-add-cart {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.875rem;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-buy-now {
            background: #27ae60;
            color: white;
        }
        
        .btn-buy-now:hover {
            background: #229954;
        }
        
        .btn-add-cart {
            background: #a8e6cf;
            color: #27ae60;
        }
        
        .btn-add-cart:hover {
            background: #90dbb8;
        }
        
        @media (max-width: 768px) {
            .marketplace-controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-tabs {
                flex-wrap: wrap;
            }
            
            .marketplace-actions {
                flex-direction: column;
                width: 100%;
            }
            
            .search-input {
                width: 100%;
            }
            
            .products-grid {
                grid-template-columns: 1fr;
            }
        }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterTabs = document.querySelectorAll('.filter-tab');
            
            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    filterTabs.forEach(t => t.classList.remove('active'));
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Here you would filter products based on category
                    const category = this.dataset.category;
                    console.log('Filter by:', category);
                    // Add your filtering logic here
                });
            });
        });
        </script>
<?php include __DIR__ . '/partials/footer.php'; ?>
