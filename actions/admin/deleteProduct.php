<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    require '../../config/accessController.php';
    require_once '../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


    $product_id = $_GET['id'];

    if (isset($_GET['size'])) {
        $product_size = $_GET['size'];
    }

    if (!isset($product_size)) {
        $sql = "DELETE FROM product WHERE product_id = $product_id";
        $sql2 = "DELETE FROM product_sizestock WHERE product_id = $product_id";

        $result = mysqli_query($connection, $sql2); /* mauuna madelete dapat yung product_sizestock othjerwise mageerror kasi naka reference yung pid sa product table bruh*/
        $result2 = mysqli_query($connection, $sql);

        if($result == TRUE && $result2 == TRUE) {
            header("Location: ../../pages/admin/products.php");
            exit();
        }

    }else{
        $sql = "DELETE FROM product_sizestock where product_id = $product_id AND size = '$product_size'";
        $result = mysqli_query($connection, $sql);

        if($result == TRUE) {
            header("Location: ../../pages/admin/products.php");
            exit();
        }
    }
?>