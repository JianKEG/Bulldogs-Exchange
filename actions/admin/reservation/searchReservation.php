<?php  
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    require '../../config/connection.php';

    if (isset($_POST['search'])) {
        $search = $_POST['search'];    

        $query = "SELECT 
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
        WHERE r.student_id = '$search'
        ORDER BY r.reservation_date DESC";

        $result = mysqli_query($connection, $query);
    }
?>