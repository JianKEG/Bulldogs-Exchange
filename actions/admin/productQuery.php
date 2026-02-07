<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    require '../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $display = "SELECT 
                product.product_id, 
                product.product_name, 
                product.category, 
                product.price,
                product_sizestock.size, 
                product_sizestock.stock_quantity
                FROM product
                LEFT JOIN product_sizestock ON product.product_id = product_sizestock.product_id
                ORDER BY product.product_id, product_sizestock.size";
    
    $query = mysqli_query($connection, $display);

    if(mysqli_num_rows($query) === 0) {
        $reset_autoincrement = "ALTER TABLE product AUTO_INCREMENT = 1";
        mysqli_query($connection, $reset_autoincrement);
    }
    
    $products = [];
    while($row = mysqli_fetch_assoc($query)) {
        $product_id = $row['product_id'];
        if (!isset($products[$product_id])) {
            $products[$product_id] = [
                'product_id' => $row['product_id'],
                'product_name' => $row['product_name'],
                'category' => $row['category'],
                'price' => $row['price'],
                'sizes' => []
            ];
        }
        
        if ($row['size'] !== null) {
            $products[$product_id]['sizes'][] = [
                'size' => $row['size'],
                'stock_quantity' => $row['stock_quantity']
            ];
        }
    }
?>