<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    include('../../includes/admin/header.html');

    require '../../actions/admin/dashboard.php'
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../src/output.css">
        <title>Document</title>
    </head>
    <body>
        <div class="flex">
            <?php include('../../includes/admin/sidebar.html'); ?>
            
            <main id="main-content" class="flex-1 p-4 bg-gray-50">
                <div class="mb-4">
                    <h1 class="text-2xl font-bold text-gray-800 justify-center text-center">Dashboard Overview</h1>
                </div>

                <div class="mb-4">
                    <h2 class="text-lg font-bold text-gray-800 mb-2">Products</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #2563eb;">
                            <p class="text-gray-600 text-xs font-medium">Total Products</p>
                            <p class="text-2xl font-bold" style="color: #2563eb;"><?php echo $totalProductCount; ?></p>
                        </div>
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #a855f7;">
                            <p class="text-gray-600 text-xs font-medium">Uniforms</p>
                            <p class="text-2xl font-bold" style="color: #a855f7;"><?php echo $uniformTotal; ?></p>
                        </div>
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #6366f1;">
                            <p class="text-gray-600 text-xs font-medium">Merchandise</p>
                            <p class="text-2xl font-bold" style="color: #6366f1;"><?php echo $merchandiseTotal; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-gray-800 mb-2">Stock Status</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #ca8a04;">
                            <p class="text-gray-600 text-xs font-medium">About to Run Out</p>
                            <?php if (count($lowStockProducts) == 0): ?>
                                <p class="text-2xl font-bold" style="color: #ca8a04;">No Low Stock Products</p>
                            <?php endif; ?>
                            <?php for ($i = 0; $i < count($lowStockProducts); $i++){ ?>
                                <?php if ($lowStockProducts[$i]['sizes'] == 'No Size'){ ?>
                                    <p class="text-2xl font-bold" style="color: #ca8a04;"><?php echo $lowStockProducts[$i]['product_name'] . "<br>"; ?></p>
                                    <?php continue; ?>
                                <?php } ?>
                                <p class="text-2xl font-bold" style="color: #ca8a04;"><?php echo $lowStockProducts[$i]['product_name'] . " - Size: " . $lowStockProducts[$i]['sizes'] . "<br>"; ?></p>
                            <?php } ?>
                            <p class="text-gray-500 text-xs mt-1">(1-10 units)</p>
                        </div>
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #dc2626;">
                            <p class="text-gray-600 text-xs font-medium">Out of Stock</p>
                            <?php if (count($outOfStockProducts) == 0){ ?>
                                <p class="text-2xl font-bold" style="color: #dc2626;">No Out of Stock Products</p>
                            <?php } ?>
                            <?php for ($i = 0; $i < count($outOfStockProducts); $i++){ ?>
                                <?php if ($outOfStockProducts[$i]['sizes'] == 'No Size'){ ?>
                                    <p class="text-2xl font-bold" style="color: #dc2626;"><?php echo $outOfStockProducts[$i]['product_name'] . "<br>"; ?></p>
                                    <?php continue; ?>
                                <?php } ?>
                                <p class="text-2xl font-bold" style="color: #dc2626;"><?php echo $outOfStockProducts[$i]['product_name'] . " - Size: " . $outOfStockProducts[$i]['sizes'] . "<br>"; ?></p>
                            <?php } ?>
                            <p class="text-gray-500 text-xs mt-1">(0 units)</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-bold text-gray-800 mb-2">Reservations</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #16a34a;">
                            <p class="text-gray-600 text-xs font-medium">Total Reservations</p>
                            <p class="text-2xl font-bold" style="color: #16a34a;"><?php echo $totalReservationCount; ?></p>
                        </div>
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #ea580c;">
                            <p class="text-gray-600 text-xs font-medium">Pending</p>
                            <p class="text-2xl font-bold" style="color: #ea580c;"><?php echo $pendingReservationCount; ?></p>
                            <p class="text-gray-500 text-xs mt-1">Awaiting claim</p>
                        </div>
                        <div class="bg-white rounded shadow p-4" style="border-left: 4px solid #0d9488;">
                            <p class="text-gray-600 text-xs font-medium">Claimed</p>
                            <p class="text-2xl font-bold" style="color: #0d9488;"><?php echo $claimedReservationCount; ?></p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
