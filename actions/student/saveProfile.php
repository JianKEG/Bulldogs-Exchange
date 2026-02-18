<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once '../../config/connection.php';
    require_once '../../config/accessController.php';
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../../pages/student/completeProfile.php');
        exit();
    }
    
    $login_id = $_SESSION['id'];
    
    // Retrieve and sanitize inputs
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $student_id = trim($_POST['student_id']);
    $course = trim($_POST['course']);
    $year_level = trim($_POST['year_level']);
    
    // Server-side validation
    $errors = [];
    
    // Validate first name (letters, spaces, dots, hyphens, apostrophes only, 1-50 characters)
    if (!preg_match("/^[a-zA-Z\s.'-]{1,50}$/", $first_name)) {
        $errors[] = "Invalid first name format. Use only letters, spaces, and common punctuation (1-50 characters).";
    }
    
    // Validate last name (letters, spaces, dots, hyphens, apostrophes only, 1-50 characters)
    if (!preg_match("/^[a-zA-Z\s.'-]{1,50}$/", $last_name)) {
        $errors[] = "Invalid last name format. Use only letters, spaces, and common punctuation (1-50 characters).";
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }
    
    // Validate email length
    if (strlen($email) > 255) {
        $errors[] = "Email address is too long (max 255 characters).";
    }
    
    // Validate student ID format (YYYY-NNNNNNN)
    if (!preg_match("/^\d{4}-\d{7}$/", $student_id)) {
        $errors[] = "Invalid student ID format. Use YYYY-NNNNNNN.";
    }
    
    // Validate course
    $valid_courses = [
        'BS Computer Science', 'BS Information Technology', 'BS Business Administration',
        'BS Accountancy', 'BS Psychology', 'BS Nursing', 'BS Engineering',
        'BS Education', 'BS Criminology', 'Other'
    ];
    if (empty($course) || !in_array($course, $valid_courses)) {
        $errors[] = "Please select a valid course.";
    }
    
    // Validate year level
    $valid_years = ['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'];
    if (empty($year_level) || !in_array($year_level, $valid_years)) {
        $errors[] = "Please select a valid year level.";
    }
    
    // Check if profile already exists for this login account
    $sql_check = "SELECT student_id FROM Student WHERE s_id = ?";
    $stmt_check = $connection->prepare($sql_check);
    $stmt_check->bind_param('i', $login_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        $errors[] = "Profile already exists. Please contact administrator if you need to update your information.";
    }
    
    // Check if this student_id already exists
    $sql_check_student_id = "SELECT student_id FROM Student WHERE student_id = ?";
    $stmt_check_student_id = $connection->prepare($sql_check_student_id);
    $stmt_check_student_id->bind_param('s', $student_id);
    $stmt_check_student_id->execute();
    $result_check_student_id = $stmt_check_student_id->get_result();

    if ($result_check_student_id->num_rows > 0) {
        $errors[] = "This student ID is already registered.";
    }
    
    // Check if email already exists for different student
    $sql_check_email = "SELECT student_id FROM Student WHERE email = ? AND student_id != ?";
    $stmt_check_email = $connection->prepare($sql_check_email);
    $stmt_check_email->bind_param('ss', $email, $student_id);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    
    if ($result_check_email->num_rows > 0) {
        $errors[] = "This email address is already registered to another student.";
    }
    
    // If there are errors, redirect back with error message
    if (!empty($errors)) {
        $_SESSION['profile_error'] = implode(' ', $errors);
        header('Location: ../../pages/student/completeProfile.php');
        exit();
    }
    
    // Insert student details into Student table
    try {
        $sql_insert = "INSERT INTO Student (student_id, first_name, last_name, email, course, year_level, s_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $connection->prepare($sql_insert);
        
        if (!$stmt_insert) {
            throw new Exception("Database prepare error: " . $connection->error);
        }
        
        $stmt_insert->bind_param('ssssssi', $student_id, $first_name, $last_name, $email, $course, $year_level, $login_id);
        
        if ($stmt_insert->execute()) {
            $_SESSION['message'] = "Profile completed successfully! You can now make reservations.";
            header('Location: ../../pages/student/viewReservedItems.php');
            exit();
        } else {
            throw new Exception("Database execute error: " . $stmt_insert->error);
        }
        
    } catch (Exception $e) {
        $_SESSION['profile_error'] = "An error occurred while saving your profile. Please try again.";
        error_log("Profile save error: " . $e->getMessage());
        header('Location: ../../pages/student/completeProfile.php');
        exit();
    }
?>
