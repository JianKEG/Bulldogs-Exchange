<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../../config/accessController.php';
    require_once '../../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $product_id = $_GET['id'];
    if (isset($_GET['size'])) {
        $size = $_GET['size'];
    } else {
        $size = '';
    }
    
    if(isset($_POST['updateForm'])){
        $product_id = $_GET['id'];
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        
        if (isset($_POST['size'])) {
            $size_input = $_POST['size'];
        } else {
            $size_input = '';
        }
        
        if (isset($_POST['stock_quantity'])) {
            $stock_quantity = $_POST['stock_quantity'];
        } else {
            $stock_quantity = '';
        }
        
        if (isset($_POST['sizes'])) {
            $sizes_input = $_POST['sizes'];
        } else {
            $sizes_input = [];
        }
        
        if (isset($_POST['stocks'])) {
            $stocks_input = $_POST['stocks'];
        } else {
            $stocks_input = [];
        }
        
        if ($size !== '') {
            $size_to_use = $size;
        } else {
            $size_to_use = $size_input;
        }

        $updateQuery = "UPDATE product SET product_name='$product_name', category='$category', price='$price' WHERE product_id='$product_id'";
        if ($size === '') {
            if (isset($_POST['total_stock']) && $_POST['total_stock'] !== '') {
                $total_stock = $_POST['total_stock'];
                
                $checkQuery = "SELECT 1 FROM Product_SizeStock WHERE product_id='$product_id' AND size='No Size' LIMIT 1";
                $checkResult = mysqli_query($connection, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
                    $updateQuery2 = "UPDATE Product_SizeStock SET stock_quantity='$total_stock' WHERE product_id='$product_id' and size = 'No Size'";
                } else {
                    $updateQuery2 = "INSERT INTO Product_SizeStock (product_id, size, stock_quantity) VALUES ('$product_id', 'No Size', '$total_stock')";
                }

                mysqli_query($connection, $updateQuery2);
                
                if (mysqli_query($connection, $updateQuery)) {
                    header("Location: ../../../pages/admin/products.php");
                    exit();
                }
            } elseif (!empty($sizes_input)) {
                for ($i = 0; $i < count($sizes_input); $i++) {
                    $current_size = $sizes_input[$i];
                    if (isset($stocks_input[$i])) {
                        $current_stock = $stocks_input[$i];
                    } else {
                        $current_stock = '';
                    }

                    if ($current_size === '') {
                        continue;
                    }

                    $checkQuery = "SELECT * FROM Product_SizeStock WHERE product_id='$product_id' AND size='$current_size' LIMIT 1";
                    $checkResult = mysqli_query($connection, $checkQuery);

                    if (mysqli_num_rows($checkResult) > 0) {
                        $updateQuery2 = "UPDATE Product_SizeStock SET stock_quantity='$current_stock' WHERE product_id='$product_id' and size = '$current_size'";
                    } else {
                        $updateQuery2 = "INSERT INTO Product_SizeStock (product_id, size, stock_quantity) VALUES ('$product_id', '$current_size', '$current_stock')";
                    }

                    mysqli_query($connection, $updateQuery2);
                }
            }

            if (mysqli_query($connection, $updateQuery)) {
                header("Location: ../../../pages/admin/products.php");
                exit();
            }
        }elseif ($size_to_use === 'No Size') {
            $updateStockQuery = "UPDATE Product_SizeStock SET stock_quantity='$stock_quantity' WHERE product_id='$product_id' and size = 'No Size'";
            
            if(mysqli_query($connection, $updateQuery) && mysqli_query($connection, $updateStockQuery)){
                header("Location: ../../../pages/admin/products.php");
                exit();
            }
        }else{
            $updateQuery2 = "UPDATE Product_SizeStock SET stock_quantity='$stock_quantity' WHERE product_id='$product_id' and size = '$size_to_use'";

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

    header("Location: ../../../pages/admin/products.php");
    exit();
?>