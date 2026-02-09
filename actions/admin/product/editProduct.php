<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../../config/accessController.php';
    require_once '../../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $product_id = $_GET['id'];
    $size = isset($_GET['size']) ? $_GET['size'] : '';
    
    if(isset($_POST['updateForm'])){
        $product_id = $_GET['id'];
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $size_input = isset($_POST['size']) ? $_POST['size'] : '';
        $stock_quantity = isset($_POST['stock_quantity']) ? $_POST['stock_quantity'] : '';
        $sizes_input = isset($_POST['sizes']) ? $_POST['sizes'] : [];
        $stocks_input = isset($_POST['stocks']) ? $_POST['stocks'] : [];
        $size_to_use = $size !== '' ? $size : $size_input;

        $updateQuery = "UPDATE product SET product_name='$product_name', category='$category', price='$price' WHERE product_id='$product_id'";
        if ($size === '') {
            if (!empty($sizes_input)) {
                for ($i = 0; $i < count($sizes_input); $i++) {
                    $current_size = $sizes_input[$i];
                    $current_stock = isset($stocks_input[$i]) ? $stocks_input[$i] : '';

                    if ($current_size === '') {
                        continue;
                    }

                    $checkQuery = "SELECT 1 FROM product_sizestock WHERE product_id='$product_id' AND size='$current_size' LIMIT 1";
                    $checkResult = mysqli_query($connection, $checkQuery);

                    if (mysqli_num_rows($checkResult) > 0) {
                        $updateQuery2 = "UPDATE product_sizestock SET stock_quantity='$current_stock' WHERE product_id='$product_id' and size = '$current_size'";
                    } else {
                        $updateQuery2 = "INSERT INTO product_sizestock (product_id, size, stock_quantity) VALUES ('$product_id', '$current_size', '$current_stock')";
                    }

                    mysqli_query($connection, $updateQuery2);
                }
            }

            if (mysqli_query($connection, $updateQuery)) {
                header("Location: ../../../pages/admin/products.php");
                exit();
            }
        } else {
            $updateQuery2 = "UPDATE product_sizestock SET stock_quantity='$stock_quantity' WHERE product_id='$product_id' and size = '$size_to_use'";

            if(mysqli_query($connection, $updateQuery) && mysqli_query($connection, $updateQuery2)){
                header("Location: ../../../pages/admin/products.php");
                exit();
            }
        }

        if (mysqli_error($connection)) {
            echo "Error updating record: " . mysqli_error($connection);
            exit();
        }
    }

    if ($size === '') {
        header("Location: ../../../pages/admin/product/editProduct.php?id=$product_id");
    } else {
        header("Location: ../../../pages/admin/product/editProduct.php?id=$product_id&size=$size");
    }
    exit();
?>