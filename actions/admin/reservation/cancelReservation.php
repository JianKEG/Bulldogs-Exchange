<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../../config/accessController.php';
    require '../../../config/connection.php';

    $reservation_id = $_GET['id'];
    $product_id = $_GET['pssid'];
    $qty = $_GET['quantity'];

    $updateQuantity = "UPDATE Product_SizeStock SET stock_quantity = stock_quantity + $qty WHERE pssid = $product_id";
    mysqli_query($connection, $updateQuantity);

    $delete_query = "DELETE FROM Reservation WHERE reservation_id = $reservation_id";
    mysqli_query($connection, $delete_query);

    header('Location: ../../../pages/admin/reservations.php');
    exit;
?>