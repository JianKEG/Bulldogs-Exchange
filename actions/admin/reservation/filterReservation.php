<?php 
    if (isset($_POST['status'])) {
        $status = $_POST['status'];

        if ($status == 'pending') {
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
                        WHERE reservation.status = 'Pending' OR reservation.status = 'pending'
                        ORDER BY reservation.reservation_date DESC";
            $result = mysqli_query($connection, $query);
        } elseif ($status == 'claimed') {
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
                        WHERE reservation.status = 'Claimed' OR reservation.status = 'claimed'
                        ORDER BY reservation.reservation_date DESC";
            $result = mysqli_query($connection, $query);
        } elseif ($status == 'all') {
            $query = "SELECT * FROM reservation";
            $result = mysqli_query($connection, $query);
        }
    }
?>