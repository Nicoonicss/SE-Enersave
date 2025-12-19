<?php

require_once __DIR__ . '/../models/User.php';

class SuppliersController
{
    public function index(): void
    {
        include __DIR__ . '/../views/suppliers.php';
    }

    public function getAll(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $userModel = new User();
        $suppliers = $userModel->findByRole('SUPPLIER_INSTALLER');
        
        // Format suppliers for frontend
        $formattedSuppliers = array_map(function($supplier) {
            return [
                'id' => $supplier['id'],
                'username' => $supplier['username'],
                'email' => $supplier['email'],
                'role' => $supplier['role'],
                'status' => $supplier['status'] ?? 'active',
                'is_verified' => (bool)($supplier['is_verified'] ?? false),
                'created_at' => $supplier['created_at'] ?? ''
            ];
        }, $suppliers);
        
        echo json_encode(['success' => true, 'suppliers' => $formattedSuppliers]);
    }

    public function verify(): void
    {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $supplierId = (int)($data['supplier_id'] ?? 0);

        if ($supplierId <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Supplier ID is required']);
            return;
        }

        $userModel = new User();
        
        try {
            $userModel->updateVerification($supplierId, true);
            
            echo json_encode([
                'success' => true,
                'message' => 'Supplier verified successfully'
            ]);
        } catch (Exception $e) {
            error_log("Error verifying supplier: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to verify supplier: ' . $e->getMessage()]);
        }
    }

    public function unverify(): void
    {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $supplierId = (int)($data['supplier_id'] ?? 0);

        if ($supplierId <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Supplier ID is required']);
            return;
        }

        $userModel = new User();
        
        try {
            $userModel->updateVerification($supplierId, false);
            
            echo json_encode([
                'success' => true,
                'message' => 'Supplier unverified successfully'
            ]);
        } catch (Exception $e) {
            error_log("Error unverifying supplier: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to unverify supplier: ' . $e->getMessage()]);
        }
    }
}

