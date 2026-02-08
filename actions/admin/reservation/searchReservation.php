<?php  
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    require '../../config/connection.php';

    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (isset($_POST['search'])) {
        $search = $_POST['search'];    

        $query = "SELECT 
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
        WHERE reservation.student_id = '$search'
        ORDER BY reservation.reservation_date DESC";

        $result = mysqli_query($connection, $query);
    }
?>