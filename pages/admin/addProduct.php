<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $page_title = "Add Products";
    include('../../includes/admin/header.html');

    require '../../actions/admin/addProduct.php';
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
            <?php include('../../includes/admin/sidebar.html'); ?>

            <main id="main-content" class="flex-1 p-8 bg-gray-50 text-center">
                <div class="mb-6 flex flex-col items-center justify-between gap-4 sm:flex-row">
                    <h1 class="text-3xl font-bold text-gray-800">add products go here</h1>
                </div>

                
            </main>
        </div>
    </body>
</html>