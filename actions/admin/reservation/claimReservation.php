<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../../config/accessController.php';
    require '../../../config/connection.php';

    $reservation_id = $_GET['id'];

    $mark_as_claimed_query = "UPDATE Reservation SET status = 'Claimed' WHERE reservation_id = $reservation_id";
    mysqli_query($connection, $mark_as_claimed_query);

    header('Location: ../../../pages/admin/reservations.php');
    exit;
?>