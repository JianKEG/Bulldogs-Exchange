<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once '../../config/connection.php';
require_once '../../config/accessController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: ../../pages/student/viewReservedItems.php');
	exit();
}

$login_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
if (!$login_id) {
	$_SESSION['message'] = 'Please login to finalize reservation.';
	header('Location: ../../index.php');
	exit();
}

// map login id to student_id (no bind_param)
$login_id_int = (int)$login_id;
$result = $connection->query("SELECT student_id FROM Student WHERE s_id = $login_id_int LIMIT 1");
if (!$result || $result->num_rows === 0) {
	$_SESSION['message'] = 'Please complete your profile before reserving.';
	header('Location: ../../pages/student/completeProfile.php');
	exit();
}
$row = $result->fetch_assoc();
$student_id = $row['student_id'];

$today = date('Y-m-d');

$connection->begin_transaction();
try {
	// If a cart exists in session, insert all items
	if (!empty($_SESSION['cart'])) {
		foreach ($_SESSION['cart'] as $item) {
			$product_name = $item['product'];
			$size = $item['size'];
			$quantity = (int)$item['quantity'];

			$pn = $connection->real_escape_string($product_name);
			$rp = $connection->query("SELECT product_id FROM Product WHERE product_name = '$pn' LIMIT 1");
			if (!$rp || $rp->num_rows === 0) {
				throw new Exception('Product not found: ' . $product_name);
			}
			$prod = $rp->fetch_assoc();
			$product_id = (int)$prod['product_id'];

			$status = 'pending';
			$st = $connection->real_escape_string($status);
			$sz = $connection->real_escape_string($size);
			$today_esc = $connection->real_escape_string($today);
			$student_id_int = (int)$student_id;
			$product_id_int = (int)$product_id;
			$quantity_int = (int)$quantity;
			$insert_sql = "INSERT INTO Reservation (student_id, product_id, size, quantity, reservation_date, status) VALUES ($student_id_int, $product_id_int, '$sz', $quantity_int, '$today_esc', '$st')";
			if (!$connection->query($insert_sql)) {
				throw new Exception('Insert failed: ' . $connection->error);
			}
		}

		// clear cart and cookie
		unset($_SESSION['cart']);
		if (isset($_SESSION['username'])) {
			setcookie('cart_'.$_SESSION['username'], '', time() - 3600, '/');
		}

	} else {
		// support single-item finalize via POST
		$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
		$product_name = isset($_POST['product_name']) ? trim($_POST['product_name']) : null;
		$size = isset($_POST['size']) ? trim($_POST['size']) : null;
		$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

		if (!$product_id && $product_name) {
			$pn = $connection->real_escape_string($product_name);
			$rp = $connection->query("SELECT product_id FROM Product WHERE product_name = '$pn' LIMIT 1");
			if (!$rp || $rp->num_rows === 0) {
				throw new Exception('Product not found');
			}
			$prod = $rp->fetch_assoc();
			$product_id = (int)$prod['product_id'];
		}

		if (!$product_id || !$size || $quantity < 1) {
			throw new Exception('Invalid reservation data');
		}

		$status = 'pending';
		$st = $connection->real_escape_string($status);
		$sz = $connection->real_escape_string($size);
		$today_esc = $connection->real_escape_string($today);
		$student_id_int = (int)$student_id;
		$product_id_int = (int)$product_id;
		$quantity_int = (int)$quantity;
		$insert_sql = "INSERT INTO Reservation (student_id, product_id, size, quantity, reservation_date, status) VALUES ($student_id_int, $product_id_int, '$sz', $quantity_int, '$today_esc', '$st')";
		if (!$connection->query($insert_sql)) {
			throw new Exception('Insert failed: ' . $connection->error);
		}
	}

	$connection->commit();
	$_SESSION['message'] = 'Reservation created and is pending.';
	header('Location: ../../pages/student/viewReservedItems.php');
	exit();

} catch (Exception $e) {
	$connection->rollback();
	error_log('Finalize reservation error: ' . $e->getMessage());
	$_SESSION['message'] = 'Could not create reservation. Please try again.';
	header('Location: ../../pages/student/viewReservedItems.php');
	exit();
}

?>

