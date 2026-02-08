<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    header('Content-Type: application/json');
    require_once('../../config/connection.php');
    
    if (!isset($_SESSION['id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit();
    }
    
    $student_id = $_SESSION['id'];
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $fullName = trim($_POST['fullName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $year_level = trim($_POST['year_level'] ?? '');
    
    $errors = [];
    if (!$firstName || !$lastName) $errors[] = "Name required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email";
    if (strlen($email) > 255) $errors[] = "Email too long";
    
    $valid_courses = ['BS Computer Science', 'BS Information Technology', 'BS Business Administration',
        'BS Accountancy', 'BS Psychology', 'BS Nursing', 'BS Engineering', 'BS Education', 'BS Criminology', 'Other'];
    if (!in_array($course, $valid_courses)) $errors[] = "Invalid course";
    
    $valid_years = ['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'];
    if (!in_array($year_level, $valid_years)) $errors[] = "Invalid year level";
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(' | ', $errors)]);
        exit();
    }
    
    $sql_check = "SELECT student_id FROM Student WHERE email = ? AND student_id != ?";
    $stmt_check = $connection->prepare($sql_check);
    $stmt_check->bind_param('si', $email, $student_id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        exit();
    }
    
    $sql = "UPDATE Student SET name = ?, email = ?, course = ?, year_level = ? WHERE student_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ssssi', $fullName, $email, $course, $year_level, $student_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Profile updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    }
?>
