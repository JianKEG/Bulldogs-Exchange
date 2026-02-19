<?php 
    
    require '../../config/connection.php';
    require '../../config/accessController.php';

    $page_title = "Dashboard";
    
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


    // productss
    $totalProducts = "SELECT COUNT(*) as total FROM product";
    $totalProductsResult = mysqli_query($connection, $totalProducts);
    $totalProductsRow = mysqli_fetch_array($totalProductsResult);
    $totalProductCount = $totalProductsRow['total'];

    $uniformCount = "SELECT COUNT(*) as total FROM product WHERE category = 'Uniform'";
    $uniformCountResult = mysqli_query($connection, $uniformCount);
    $uniformCountRow = mysqli_fetch_array($uniformCountResult);
    $uniformTotal = $uniformCountRow['total'];

    $merchandiseCount = "SELECT COUNT(*) as total FROM product WHERE category = 'Merchandise'";
    $merchandiseCountResult = mysqli_query($connection, $merchandiseCount);
    $merchandiseCountRow = mysqli_fetch_array($merchandiseCountResult);
    $merchandiseTotal = $merchandiseCountRow['total'];


    //stokc statys
    $outOfStock = "SELECT product.product_id, product.product_name, product.category, GROUP_CONCAT(Product_SizeStock.size ORDER BY Product_SizeStock.size SEPARATOR ', ') AS sizes FROM product LEFT JOIN Product_SizeStock ON product.product_id = Product_SizeStock.product_id WHERE Product_SizeStock.stock_quantity = 0 GROUP BY product.product_id, product.product_name, product.category;";
    $outOfStockResult = mysqli_query($connection, $outOfStock);
    $outOfStockTotal = mysqli_num_rows($outOfStockResult);
    $outOfStockProducts = [];
    while ($outOfStockRow = mysqli_fetch_array($outOfStockResult)){
        $outOfStockProducts[] = $outOfStockRow;
    };

    $lowStock = "SELECT product.product_id, product.product_name, product.category, GROUP_CONCAT(Product_SizeStock.size ORDER BY Product_SizeStock.size SEPARATOR ', ') AS sizes FROM product LEFT JOIN Product_SizeStock ON product.product_id = Product_SizeStock.product_id WHERE Product_SizeStock.stock_quantity > 0 AND Product_SizeStock.stock_quantity <= 10 GROUP BY product.product_id, product.product_name, product.category;";
    $lowStockResult = mysqli_query($connection, $lowStock);
    $lowStockProducts = [];
    while ($lowStockRow = mysqli_fetch_array($lowStockResult)){
        $lowStockProducts[] = $lowStockRow;
    };

    // reservations
    $totalReservations = "SELECT COUNT(*) as total FROM Reservation";
    $totalReservationsResult = mysqli_query($connection, $totalReservations);
    $totalReservationsRow = mysqli_fetch_array($totalReservationsResult);
    $totalReservationCount = $totalReservationsRow['total'];

    $pendingReservations = "SELECT COUNT(*) as total FROM Reservation WHERE status = 'Pending'";
    $pendingReservationsResult = mysqli_query($connection, $pendingReservations);
    $pendingReservationsRow = mysqli_fetch_array($pendingReservationsResult);
    $pendingReservationCount = $pendingReservationsRow['total'];

    $claimedReservations = "SELECT COUNT(*) as total FROM Reservation WHERE status = 'Claimed'";
    $claimedReservationsResult = mysqli_query($connection, $claimedReservations);
    $claimedReservationsRow = mysqli_fetch_array($claimedReservationsResult);
    $claimedReservationCount = $claimedReservationsRow['total'];
?>