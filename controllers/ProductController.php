<?php

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
}

