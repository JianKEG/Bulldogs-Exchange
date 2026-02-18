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

	$stmt = $connection->prepare("SELECT student_id FROM Student WHERE userid = ? LIMIT 1");
	$stmt->bind_param("i", $login_id);
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
		$stmtInsert = $connection->prepare("INSERT INTO Reservation (student_id, pssid, quantity, reservation_date, status) VALUES (?, ?, ?, ?, ?)");
		$stmtLookup = $connection->prepare("SELECT pssid FROM Product_SizeStock WHERE product_id = ? AND size = ? LIMIT 1");
		$stmtUpdateStock = $connection->prepare("UPDATE Product_SizeStock SET stock_quantity = stock_quantity - ? WHERE pssid = ?");

		foreach ($_SESSION['cart'] as $item) {
			$p_id = $item['product_id'];
			$size = $item['size'];
			$qty  = $item['quantity'];

			$stmtLookup->bind_param("is", $p_id, $size);
			$stmtLookup->execute();
			$lookupResult = $stmtLookup->get_result();

			if ($lookupResult->num_rows === 0) {
				throw new Exception("Size not found for product: " . $p_id);
			}

			$pssRow = $lookupResult->fetch_assoc();
			$pssid = (int) $pssRow['pssid'];

			$stmtInsert->bind_param("siiss", $student_id, $pssid, $qty, $today, $status);
			
			if (!$stmtInsert->execute()) {
				throw new Exception("Failed to insert item: " . $stmtInsert->error);
			}
			
			$stmtUpdateStock->bind_param("ii", $qty, $pssid);
			$stmtUpdateStock->execute();	
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