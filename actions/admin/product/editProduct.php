<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    require_once '../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $product_id = $_GET['id'];
    $size = $_GET['size'];
    
    if(isset($_POST['updateForm'])){
        $product_id = $_GET['id'];
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $size = $_GET['size'];
        $stock_quantity = $_POST['stock_quantity'];

        $updateQuery = "UPDATE product SET product_name='$product_name', category='$category', price='$price' WHERE product_id='$product_id'";
        $updateQuery2 = "UPDATE product_sizestock SET stock_quantity='$stock_quantity' WHERE product_id='$product_id' and size = '$size'";

        if(mysqli_query($connection, $updateQuery) && mysqli_query($connection, $updateQuery2)){
            header("Location: ../../pages/admin/products.php");
            exit();
        }else{
            echo "Error updating record: " . mysqli_error($connection);
        }
    }

    header("Location: ../../pages/admin/editProduct.php?id=$product_id&size=$size");
    exit();
?>