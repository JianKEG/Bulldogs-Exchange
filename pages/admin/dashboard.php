<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include('../../includes/admin/header.html');

    $page_title = "Dashboard";
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
            
            <main id="main-content" class="flex-1 p-8 bg-gray-50">
                <?php 
                    if (isset($_SESSION['message'])) {
                        echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']); 
                    }
                ?>

                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
                    <p class="text-gray-600 mt-2">mga metrics dito</p>
                </div>
            </main>
        </div>
    </body>
</html>
