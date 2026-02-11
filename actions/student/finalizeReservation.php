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

	$login_id = $_SESSION['id'] ?? null;
	if (!$login_id) {
		$_SESSION['message'] = 'Please login to finalize reservation.';
		header('Location: ../../index.php');
		exit();
	}

	$stmt = $connection->prepare("SELECT student_id FROM Student WHERE s_id = ? LIMIT 1");
	$stmt->bind_param("s", $login_id);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows === 0) {
		$_SESSION['message'] = 'Student profile not found.';
		header('Location: ../../pages/student/viewReservedItems.php');
		exit();
	}

	$student = $result->fetch_assoc();
	$student_id = $student['student_id'];
	$today = date('Y-m-d');
	$status = 'Pending';


	if (empty($_SESSION['cart'])) {
		$_SESSION['message'] = 'Your cart is empty.';
		header('Location: ../../pages/student/viewReservedItems.php');
		exit();
	}

	$connection->begin_transaction();

	try {
		$stmtInsert = $connection->prepare("INSERT INTO Reservation (student_id, product_id, size, quantity, reservation_date, status) VALUES (?, ?, ?, ?, ?, ?)");

		foreach ($_SESSION['cart'] as $item) {
			$p_id = $item['product_id'];
			$size = $item['size'];
			$qty  = $item['quantity'];

			$stmtInsert->bind_param("sisiss", $student_id, $p_id, $size, $qty, $today, $status);
			
			if (!$stmtInsert->execute()) {
				throw new Exception("Failed to insert item: " . $stmtInsert->error);
			}
			
			$updateStock = $connection->prepare("UPDATE Product_SizeStock SET stock_quantity = stock_quantity - ? WHERE product_id = ? AND size = ?");
			$updateStock->bind_param("iis", $qty, $p_id, $size);
			$updateStock->execute();	
		}

		$connection->commit();
		
		unset($_SESSION['cart']);
		
		$_SESSION['message'] = 'Reservation successful! Your items are now pending.';
		header('Location: ../../pages/student/viewReservedItems.php');
		exit();

	} catch (Exception $e) {
		$connection->rollback();
		$_SESSION['message'] = 'Error: ' . $e->getMessage();
		header('Location: ../../pages/student/viewReservedItems.php');
		exit();
	}
?>