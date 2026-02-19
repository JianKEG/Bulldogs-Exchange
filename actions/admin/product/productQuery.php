<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessControllerActions.php';
    require '../../config/connection.php';

    $display = "SELECT 
                product.product_id,
                product.product_name,
                product.category, 
                product.price,
                product.image,
                GROUP_CONCAT(Product_SizeStock.size ORDER BY Product_SizeStock.size SEPARATOR '|') AS sizes,
                GROUP_CONCAT(Product_SizeStock.stock_quantity ORDER BY Product_SizeStock.size SEPARATOR '|') AS stocks
                FROM product
                LEFT JOIN Product_SizeStock ON product.product_id = Product_SizeStock.product_id
                GROUP BY product.product_id, product.product_name, product.category, product.price, product.image
                ORDER BY product.product_id";
    
    $result = mysqli_query($connection, $display);

    if(mysqli_num_rows($result) === 0) {
        $reset_autoincrement = "ALTER TABLE product AUTO_INCREMENT = 1";
        mysqli_query($connection, $reset_autoincrement);
    }
?>