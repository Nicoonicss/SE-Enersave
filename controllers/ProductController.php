<?php

require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    public function create(): void
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'SUPPLIER_INSTALLER') {
            http_response_code(403);
            die('Access denied. Only suppliers can add products.');
        }
        include __DIR__ . '/../views/product_create.php';
    }

    public function handleCreate(): void
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'SUPPLIER_INSTALLER') {
            http_response_code(403);
            die('Access denied. Only suppliers can add products.');
        }

        $name = trim($_POST['name'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name === '' || $category === '' || $price === '') {
            http_response_code(400);
            echo 'Name, category, and price are required';
            return;
        }

        $priceFloat = (float) $price;
        if ($priceFloat <= 0) {
            http_response_code(400);
            echo 'Price must be greater than 0';
            return;
        }

        $productModel = new Product();
        $supplierId = (int) $_SESSION['user']['id'];
        $productModel->create($supplierId, $name, $category, $priceFloat, $description);

        header('Location: /dashboard?success=product_created');
        exit;
    }

    public function list(): void
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'SUPPLIER_INSTALLER') {
            http_response_code(403);
            die('Access denied.');
        }
        include __DIR__ . '/../views/product_list.php';
    }

    public function getAll(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $productModel = new Product();
        
        // Get filter and search parameters
        $category = $_GET['category'] ?? null;
        $search = $_GET['search'] ?? null;
        
        // Database categories are: "Solar", "Wind", "Hydro" (no mapping needed)
        // Normalize category value
        if ($category && strtolower($category) === 'all') {
            $category = null;
        }
        
        // Fetch products
        if ($search) {
            $products = $productModel->search($search);
            // Apply category filter to search results if needed
            if ($category && $category !== 'all') {
                $products = array_filter($products, function($product) use ($category) {
                    $productCategory = $product['category'] ?? '';
                    return strcasecmp($productCategory, $category) === 0;
                });
                // Re-index array after filtering
                $products = array_values($products);
            }
        } else {
            $products = $productModel->findAll($category);
        }
        
        // Format products for frontend
        $formattedProducts = array_map(function($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'category' => $product['category'],
                'price' => floatval($product['price']),
                'description' => $product['description'] ?? '',
                'image_url' => $product['image_url'] ?? '/images/product.png',
                'supplier_name' => $product['supplier_name'] ?? 'Unknown Supplier',
                'created_at' => $product['created_at'] ?? ''
            ];
        }, $products);
        
        echo json_encode(['success' => true, 'products' => $formattedProducts]);
    }
}

