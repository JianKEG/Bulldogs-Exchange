<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../../config/accessController.php';
require '../../config/connection.php';
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($connection->connect_error) { header("Location: ../../pages/student/viewReservedItems.php"); exit(); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_SESSION['cart'])) { header("Location: ../../pages/student/viewReservedItems.php"); exit(); }
    $user_id = $_SESSION['id'];
    $cookie_name = 'cart_' . $_SESSION['username'];
    $conn->begin_transaction();
    try {
        $selectStmt = $conn->prepare("SELECT product_id FROM product WHERE product_name = ? LIMIT 1");
        $updateStock = $conn->prepare("UPDATE product_sizestock SET stock_quantity = stock_quantity - ? WHERE product_id = ? AND size = ? AND stock_quantity >= ?");
        $insertRes = $conn->prepare("INSERT INTO Reservation (student_id, product_id, quantity, reservation_date, status) VALUES (?, ?, ?, CURDATE(), 'Pending')");
        foreach ($_SESSION['cart'] as $item) {
            $product_name = $item['product'];
            $size = $item['size'];
            $quantity = (int)$item['quantity'];
            $selectStmt->bind_param('s', $product_name);
            $selectStmt->execute();
            $res = $selectStmt->get_result();
            $row = $res->fetch_assoc();
            if (!$row) { throw new Exception('Product not found'); }
            $product_id = (int)$row['product_id'];
            $updateStock->bind_param('iisi', $quantity, $product_id, $size, $quantity);
            $updateStock->execute();
            if ($updateStock->affected_rows === 0) { throw new Exception('Insufficient stock'); }
            $insertRes->bind_param('iii', $user_id, $product_id, $quantity);
            $insertRes->execute();
        }
        $conn->commit();
        unset($_SESSION['cart']);
        setcookie($cookie_name, '', time() - 3600, '/');
        $_SESSION['message'] = 'Reservation submitted successfully';
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['message'] = 'Failed to submit reservation';
    }
}
header("Location: ../../pages/student/viewReservedItems.php");
exit();
?>
