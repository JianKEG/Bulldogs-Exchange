<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    require '../../config/connection.php';

    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $reservation_id = $_GET['id'];

    $delete_query = "DELETE FROM reservation WHERE reservation_id = $reservation_id";
    mysqli_query($connection, $delete_query);

    header('Location: ../../pages/admin/reservations.php');
    exit;
?>