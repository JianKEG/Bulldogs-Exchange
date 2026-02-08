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
                GROUP_CONCAT(product_sizestock.size ORDER BY product_sizestock.size SEPARATOR '|') AS sizes,
                GROUP_CONCAT(product_sizestock.stock_quantity ORDER BY product_sizestock.size SEPARATOR '|') AS stocks
                FROM product
                LEFT JOIN product_sizestock ON product.product_id = product_sizestock.product_id
                GROUP BY product.product_id, product.product_name, product.category, product.price
                ORDER BY product.product_id";
    
    $result = mysqli_query($connection, $display);

    if(mysqli_num_rows($result) === 0) {
        $reset_autoincrement = "ALTER TABLE product AUTO_INCREMENT = 1";
        mysqli_query($connection, $reset_autoincrement);
    }
?>