<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    require '../../../config/accessController.php';
    require_once '../../../config/connection.php';

    $product_id = $_GET['id'];

    if (isset($_GET['size'])) {
        $product_size = $_GET['size'];
    }

    if (!isset($product_size)) {
        $sql = "DELETE FROM product WHERE product_id = $product_id";
        $sql2 = "DELETE FROM Product_SizeStock WHERE product_id = $product_id";

        $result = mysqli_query($connection, $sql2); /* mauuna madelete dapat yung Product_SizeStock otherwise mageerror kasi naka reference yung pid sa product table bruh*/
        $result2 = mysqli_query($connection, $sql);

        if($result == TRUE && $result2 == TRUE) {
            header("Location: ../../../pages/admin/products.php");
            exit();
        }

    }else{
        $sql = "DELETE FROM Product_SizeStock where product_id = $product_id AND size = '$product_size'";
        $result = mysqli_query($connection, $sql);

        if($result == TRUE) {
            header("Location: ../../../pages/admin/products.php");
            exit();
        }
    }
?>