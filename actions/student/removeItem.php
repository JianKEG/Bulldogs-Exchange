<?php
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
require '../../config/accessController.php';

if (isset($_GET['id']) && !empty($_SESSION['cart'])) {
    $id_to_remove = $_GET['id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id_to_remove) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

header("Location: ../../pages/student/viewReservedItems.php");
exit();
?>