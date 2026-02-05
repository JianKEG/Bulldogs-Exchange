<?php
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
require '../../config/accessController.php';

$user = $_SESSION['username'];
$cookie_name = 'cart_' . $user;

if (isset($_GET['id']) && !empty($_SESSION['cart'])) {
    $id_to_remove = $_GET['id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id_to_remove) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    $cart = json_encode($_SESSION['cart']);
    
    if (empty($_SESSION['cart'])) {
        setcookie($cookie_name, '', time() - 3600, '/');
    } else {
        setcookie($cookie_name, $cart, time() + (60*60*24*7), '/');
    }
}

header("Location: ../../pages/student/viewReservedItems.php");
exit();
?>