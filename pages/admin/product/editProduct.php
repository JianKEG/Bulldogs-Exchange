<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $page_title = "Edit Products";
    include('../../includes/admin/product/header.html');

    require_once '../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $id = $_GET['id'];
    $size = $_GET['size'];
    
    $display = "SELECT 
                product.product_id, 
                product.product_name, 
                product.category, 
                product.price,
                product_sizestock.size, 
                product_sizestock.stock_quantity
                FROM product
                LEFT JOIN product_sizestock ON product.product_id = product_sizestock.product_id
                WHERE product.product_id = $id AND product_sizestock.size = '$size'
                ORDER BY product.product_id, product_sizestock.size";

    $sql = mysqli_query($connection, $display); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../src/output.css">
        <title><?php echo $page_title; ?></title>
    </head>

    <body>
        <div class="flex">
            <?php include('../../includes/admin/product/sidebar.html'); ?>

            <main id="main-content" class="flex-1 p-8 bg-gray-50 text-center">
                <div class="mb-6 flex items-center justify-center">
                    <h1 class="text-3xl font-bold text-gray-800 text-center">Edit Product</h1>
                </div>

                <div class="space-y-4 inline-block bg-white rounded-lg shadow-sm border border-gray-200 overflow-x-auto px-5 pt-5">
                    <form action="../../actions/admin/product/editProduct.php?id=<?php echo $_GET['id']; ?>&size=<?php echo $_GET['size']; ?>" method="POST" class="space-y-4">
                        <?php while($row = mysqli_fetch_array($sql)){ ?>
                        <label class="block text-left text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="Product Name" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        
                        <label class="block text-left text-sm font-medium text-gray-700">Category</label>
                        <input type="text" name="category" value="<?php echo $row['category']; ?>" placeholder="Category" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        
                        <label class="block text-left text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" value="<?php echo $row['price']; ?>" placeholder="Price" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        
                        <label class="block text-left text-sm font-medium text-gray-700">Size</label>
                        <input type="text" name="size" value="<?php echo $_GET['size']; ?>" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" disabled>
                        
                        <label class="block text-left text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="<?php echo $row['stock_quantity']; ?>" placeholder="Stock Quantity" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <button type="button" onclick="window.location.href='../../pages/admin/products.php'" class="inline-flex items-center rounded-lg mt-2 bg-gray-600 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 transition cursor-pointer">
                            Cancel
                        </button>

                        <button type="submit" name="updateForm" class="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 transition cursor-pointer">
                            Save Changes
                        </button>
          
                          <?php } ?>
                    </form>
                </div>
            </main>
        </div>
    </body>
</html>