<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include('../../includes/admin/header.html');

    $page_title = "Products";
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
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">products go here</h1>
                </div>
            </main>
        </div>
    </body>
</html>