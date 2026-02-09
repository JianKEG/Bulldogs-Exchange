<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once '../../config/connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $display_reservations = "SELECT 
        reservation.reservation_id,
        reservation.student_id,
        reservation.product_id,
        reservation.size,
        reservation.quantity,
        reservation.reservation_date,
        reservation.status,
        product.product_name,
        product.category,
        product.price
        FROM reservation
        LEFT JOIN product ON reservation.product_id = product.product_id
        ORDER BY reservation.reservation_date DESC";
        
    $result = mysqli_query($connection, $display_reservations);
?>