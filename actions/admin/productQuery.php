<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $display = "SELECT 
                    p.product_id, 
                    p.product_name, 
                    p.category, 
                    p.price,
                    ps.size, 
                    ps.stock_quantity
                  FROM product p
                  LEFT JOIN product_sizestock ps ON p.product_id = ps.product_id
                  ORDER BY p.product_id, ps.size";
    
    $query = mysqli_query($connection, $display);
    
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