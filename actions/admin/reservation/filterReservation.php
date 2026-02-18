<?php 
    if (isset($_POST['status'])) {
        $status = $_POST['status'];

        if ($status == 'pending') {
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
                        WHERE r.status = 'Pending' OR r.status = 'pending'
                        ORDER BY r.reservation_date DESC";
            $result = mysqli_query($connection, $query);
        } elseif ($status == 'claimed') {
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
                        WHERE r.status = 'Claimed' OR r.status = 'claimed'
                        ORDER BY r.reservation_date DESC";
            $result = mysqli_query($connection, $query);
        } elseif ($status == 'all') {
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
                        ORDER BY r.reservation_date DESC";
            $result = mysqli_query($connection, $query);
        }
    }
?>