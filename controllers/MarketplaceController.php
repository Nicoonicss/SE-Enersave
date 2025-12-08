<?php

require_once __DIR__ . '/../models/Product.php';

class MarketplaceController
{
    public function index(): void
    {
        $productModel = new Product();
        
        // Get filter and search parameters
        $category = $_GET['category'] ?? null;
        $search = $_GET['search'] ?? null;
        
        // Fetch products
        if ($search) {
            $products = $productModel->search($search);
        } else {
            $products = $productModel->findAll($category);
        }
        
        include __DIR__ . '/../views/marketplace.php';
    }
}

