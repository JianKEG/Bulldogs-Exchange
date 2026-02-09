<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $page_title = "Edit Products";
    include('../../../includes/admin/product/header.html');

    require_once '../../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $id = $_GET['id'];
    $size = isset($_GET['size']) ? $_GET['size'] : '';

    if ($size === '') {
        $display = "SELECT 
                    product.product_id, 
                    product.product_name, 
                    product.category, 
                    product.price
                    FROM product
                    WHERE product.product_id = $id";
    } else {
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
    }

    $sql = mysqli_query($connection, $display); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../src/output.css">
        <title><?php echo $page_title; ?></title>
    </head>

    <body>
        <div class="flex">
            <?php include('../../../includes/admin/product/sidebar.html'); ?>

            <main id="main-content" class="flex-1 p-8 bg-gray-50 text-center">
                <div class="mb-6 flex items-center justify-center">
                    <h1 class="text-3xl font-bold text-gray-800 text-center">Edit Product</h1>
                </div>

                <div class="space-y-4 inline-block bg-white rounded-lg shadow-sm border border-gray-200 overflow-x-auto px-5 pt-5">
                    <form action="../../../actions/admin/product/editProduct.php?id=<?php echo $_GET['id']; ?><?php echo $size === '' ? '' : '&size=' . urlencode($size); ?>" method="POST" class="space-y-4">
                        <?php while($row = mysqli_fetch_array($sql)){ ?>
                        <label class="block text-left text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="Product Name" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        
                        <label class="block text-left text-sm font-medium text-gray-700">Category</label>
                        <input type="text" name="category" value="<?php echo $row['category']; ?>" placeholder="Category" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        
                        <label class="block text-left text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" value="<?php echo $row['price']; ?>" placeholder="Price" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <?php if ($size !== '') { ?>
                        <label class="block text-left text-sm font-medium text-gray-700">Size</label>
                        <input type="text" name="size" value="<?php echo $size; ?>" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" disabled>

                        <label class="block text-left text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="<?php echo $row['stock_quantity']; ?>" placeholder="Stock Quantity" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <?php } else if ($size === '') { ?>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Add More Size</label>
                            <div id="size-container" class="space-y-2">
                                <div class="flex gap-2 mb-2 size-row">
                                    <select name="sizes[]" class="w-1/2 rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        <option value="">-- Select Size --</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                    <input type="number" name="stocks[]" placeholder="Stock Quantity" class="w-1/2 rounded-lg border-gray-300 border px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 transition cursor-pointer">
                                        <svg class="h-5.5 w-5.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </button>
                                </div>
                            </div>
                            <button type="button" onclick="addSizeRow()" class="mt-2 mb-4 w-full text-center text-sm text-blue-600 hover:underline font-medium cursor-pointer">
                                + Add Size
                            </button>
                        <?php } ?>

                        <button type="button" onclick="window.location.href='../../../pages/admin/products.php'" class="inline-flex items-center rounded-lg mt-2 bg-gray-600 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 transition cursor-pointer">
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
    <script src="../../../assets/js/editProduct.js"></script>
</html>