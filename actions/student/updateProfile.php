<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once '../../config/connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        exit();
    }
    
    // Get the current student_id from session
    $current_student_id = $_SESSION['id'];
    
    // Retrieve and sanitize inputs
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $fullName = trim($_POST['fullName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $year_level = trim($_POST['year_level'] ?? '');
    $new_student_id = trim($_POST['student_id'] ?? '');
    
    // Server-side validation
    $errors = [];
    
    // Validate name (letters, spaces, dots, hyphens, apostrophes only, 2-100 characters)
    if (!preg_match("/^[a-zA-Z\s.'-]{2,100}$/", $fullName)) {
        $errors[] = "Invalid name format. Use only letters, spaces, and common punctuation (2-100 characters).";
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }
    
    // Validate email length
    if (strlen($email) > 255) {
        $errors[] = "Email address is too long (max 255 characters).";
    }
    
    // Validate student_id (numeric)
    if (!is_numeric($new_student_id) || $new_student_id <= 0) {
        $errors[] = "Invalid student ID. Must be a positive number.";
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
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
        exit();
    }
    
    // Check if new student_id already exists in Student table (if different from current)
    if ($new_student_id != $current_student_id) {
        $sql_check = "SELECT student_id FROM Student WHERE student_id = ?";
        $stmt_check = $connection->prepare($sql_check);
        if (!$stmt_check) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $connection->error]);
            exit();
        }
        $stmt_check->bind_param('i', $new_student_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        
        if ($result_check->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'This student ID is already registered.']);
            exit();
        }
    }
    
    // Check if email already exists for different student
    $sql_check_email = "SELECT student_id FROM Student WHERE email = ? AND student_id != ?";
    $stmt_check_email = $connection->prepare($sql_check_email);
    if (!$stmt_check_email) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $connection->error]);
        exit();
    }
    $stmt_check_email->bind_param('si', $email, $current_student_id);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    
    if ($result_check_email->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'This email address is already registered to another student.']);
        exit();
    }
    
    // Update student details
    try {
        // If student_id is being changed, update it along with other fields
        if ($new_student_id != $current_student_id) {
            $sql_update = "UPDATE Student SET student_id = ?, name = ?, email = ?, course = ?, year_level = ? WHERE student_id = ?";
            $stmt_update = $connection->prepare($sql_update);
            
            if (!$stmt_update) {
                throw new Exception("Database prepare error: " . $connection->error);
            }
            
            $stmt_update->bind_param('issssi', $new_student_id, $fullName, $email, $course, $year_level, $current_student_id);
            
            if ($stmt_update->execute()) {
                // Update the session with new student_id
                $_SESSION['id'] = $new_student_id;
                echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);
            } else {
                throw new Exception("Database execute error: " . $stmt_update->error);
            }
        } else {
            // Just update other fields, keep student_id the same
            $sql_update = "UPDATE Student SET name = ?, email = ?, course = ?, year_level = ? WHERE student_id = ?";
            $stmt_update = $connection->prepare($sql_update);
            
            if (!$stmt_update) {
                throw new Exception("Database prepare error: " . $connection->error);
            }
            
            $stmt_update->bind_param('ssssi', $fullName, $email, $course, $year_level, $current_student_id);
            
            if ($stmt_update->execute()) {
                echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);
            } else {
                throw new Exception("Database execute error: " . $stmt_update->error);
            }
        }
        
        $stmt_update->close();
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating your profile.']);
        error_log("Profile update error: " . $e->getMessage());
    }
    
    $connection->close();
?>
