<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../../config/accessController.php';
    require_once '../../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(isset($_POST['createForm'])){
        $target_dir = __DIR__ . "/../../../assets/uploads/";
        $temp = $_FILES["product_image"]["tmp_name"];
        $fileName = $_FILES["product_image"]["name"];

        $target_file = $target_dir . $fileName;

        move_uploaded_file($temp, $target_file);
      
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $sizes = $_POST['sizes'];
        $stocks = $_POST['stocks'];
        $image = $fileName;

        $insertQuery = "INSERT INTO product (product_name, category, price, image) VALUES ('$product_name', '$category', '$price', '$image')";

        mysqli_query($connection, $insertQuery);

        $getID = "SELECT product_id from product where product_name = '$product_name' and category = '$category' and price = '$price' and image = '$image'";
        $result = mysqli_query($connection, $getID);
        $row = mysqli_fetch_assoc($result);
        $id = $row['product_id'];

        for ($i = 0; $i < count($sizes); $i++) {
            $size = $sizes[$i];
            $stock = $stocks[$i];

            $insertSizeStock = "INSERT INTO product_sizestock (product_id, size, stock_quantity) VALUES ('$id', '$size', '$stock')";
            mysqli_query($connection, $insertSizeStock);
        }
    }
?>