<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once '../../config/connection.php';
    require_once '../../config/accessController.php';
    
    $user = $_SESSION['username'];
    $student_id = $_SESSION['id'];
    $cookie_name = 'cart_' . $user;
    
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $reservation_date = date('Y-m-d');
        $status = 'confirmed';
        
        foreach ($_SESSION['cart'] as $item) {
            $product_name = $item['product'];
            $quantity = $item['quantity'];
            
            $sql_product = "SELECT product_id FROM Product WHERE product_name = ?";
            $stmt_product = $connection->prepare($sql_product);
            $stmt_product->bind_param('s', $product_name);
            $stmt_product->execute();
            $result_product = $stmt_product->get_result();
            $product = $result_product->fetch_assoc();
            
            if ($product) {
                $product_id = $product['product_id'];
                
                $sql_reservation = "INSERT INTO Reservation (student_id, product_id, quantity, reservation_date, status) VALUES (?, ?, ?, ?, ?)";
                $stmt_reservation = $connection->prepare($sql_reservation);
                $stmt_reservation->bind_param('iiiss', $student_id, $product_id, $quantity, $reservation_date, $status);
                $stmt_reservation->execute();
            }
        }
        
        $_SESSION['cart'] = [];
        setcookie($cookie_name, '', time() - 3600, '/');
        $_SESSION['message'] = "Reservation finalized successfully!";
    } else {
        $_SESSION['message'] = "No items to finalize!";
    }
    
    header('Location: ../../pages/student/viewReservedItems.php');
    exit();
?>
