<?php

require_once __DIR__ . '/../models/Product.php';

class MarketplaceController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        if ($role === 'SUPPLIER_INSTALLER') {
            include __DIR__ . '/../views/supplier_marketplace.php';
        } else if ($role === 'COMMUNITY_USER') {
            include __DIR__ . '/../views/community_marketplace.php';
        } else {
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
}

