<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../../config/accessController.php';

header("Location: ../../pages/admin/products.php");
exit();
?>