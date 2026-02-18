<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once '../../config/connection.php';

    $display_reservations = "SELECT 
        r.reservation_id,
        r.student_id,
        r.pssid,
        pss.size,
        r.quantity,
        r.reservation_date,
        r.status,
        p.product_name,
        p.category,
        p.price
        FROM Reservation r
        INNER JOIN Product_SizeStock pss ON r.pssid = pss.pssid
        INNER JOIN Product p ON pss.product_id = p.product_id
        ORDER BY r.reservation_date DESC";
        
    $result = mysqli_query($connection, $display_reservations);
?>