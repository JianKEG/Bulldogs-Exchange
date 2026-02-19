<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../../config/accessControllerActions.php';
    require '../../../config/connection.php';

    $reservation_id = $_GET['id'];

    $delete_query = "DELETE FROM Reservation WHERE reservation_id = $reservation_id";
    mysqli_query($connection, $delete_query);

    header('Location: ../../../pages/admin/reservations.php');
    exit;
?>