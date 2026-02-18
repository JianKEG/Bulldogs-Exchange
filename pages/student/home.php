<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    require_once '../../config/connection.php';

    $page_title = "Home";
    include ('../../includes/student/header.html');
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../src/output.css">
        <title>Home</title>
    </head>
    
    <body>
        <?php 
            if (isset($_SESSION['message'])) {
                echo '<p class="alert">' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']); 
            }
        ?>

        <?php include ('../../includes/footer.html'); ?>
    </body>
</html>  