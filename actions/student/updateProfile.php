<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once '../../config/connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        exit();
    }
    
    // Get the current userid (User_Credentials id) from session
    $current_userid = $_SESSION['id'];
    
    // Retrieve and sanitize inputs
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $year_level = trim($_POST['year_level'] ?? '');
    $new_student_id = trim($_POST['student_id'] ?? '');
    
    // Server-side validation
    $errors = [];
    
    // Validate student_id (must not be empty)
    if (empty($new_student_id)) {
        $errors[] = "Student ID is required.";
    }
    
    // Validate first name (letters, spaces, dots, hyphens, apostrophes only, 2-100 characters)
    if (!preg_match("/^[a-zA-Z\s.'-]{2,100}$/", $firstName)) {
        $errors[] = "Invalid first name format. Use only letters, spaces, and common punctuation (2-100 characters).";
    }
    
    // Validate last name (letters, spaces, dots, hyphens, apostrophes only, 2-100 characters)
    if (!preg_match("/^[a-zA-Z\s.'-]{2,100}$/", $lastName)) {
        $errors[] = "Invalid last name format. Use only letters, spaces, and common punctuation (2-100 characters).";
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }
    
    // Validate email length
    if (strlen($email) > 255) {
        $errors[] = "Email address is too long (max 255 characters).";
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
    
    // Get current student_id before making changes
    $sql_get_current = "SELECT student_id FROM Student WHERE userid = ?";
    $stmt_get_current = $connection->prepare($sql_get_current);
    if (!$stmt_get_current) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $connection->error]);
        exit();
    }
    $stmt_get_current->bind_param('i', $current_userid);
    $stmt_get_current->execute();
    $result_get_current = $stmt_get_current->get_result();
    $current_student_id_row = $result_get_current->fetch_assoc();
    $current_student_id = $current_student_id_row['student_id'];
    $stmt_get_current->close();
    
    // Check if new student_id already exists in Student table (if different from current)
    if ($new_student_id !== $current_student_id) {
        $sql_check = "SELECT student_id FROM Student WHERE student_id = ?";
        $stmt_check = $connection->prepare($sql_check);
        if (!$stmt_check) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $connection->error]);
            exit();
        }
        $stmt_check->bind_param('s', $new_student_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        
        if ($result_check->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'This student ID is already registered.']);
            exit();
        }
        $stmt_check->close();
    }
    
    // Check if email already exists for different student
    $sql_check_email = "SELECT userid FROM Student WHERE email = ? AND userid != ?";
    $stmt_check_email = $connection->prepare($sql_check_email);
    if (!$stmt_check_email) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $connection->error]);
        exit();
    }
    $stmt_check_email->bind_param('si', $email, $current_userid);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    
    if ($result_check_email->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'This email address is already registered to another student.']);
        exit();
    }
    
    $stmt_check_email->close();
    
    // Update student details
    try {
        // Disable foreign key checks temporarily
        $connection->query("SET FOREIGN_KEY_CHECKS=0");
        
        // If student_id is being changed, update reservations first
        if ($new_student_id !== $current_student_id) {
            $sql_update_reservations = "UPDATE Reservation SET student_id = ? WHERE student_id = ?";
            $stmt_update_res = $connection->prepare($sql_update_reservations);
            
            if (!$stmt_update_res) {
                $connection->query("SET FOREIGN_KEY_CHECKS=1");
                throw new Exception("Database prepare error for reservations: " . $connection->error);
            }
            
            $stmt_update_res->bind_param('ss', $new_student_id, $current_student_id);
            
            if (!$stmt_update_res->execute()) {
                $connection->query("SET FOREIGN_KEY_CHECKS=1");
                throw new Exception("Database execute error for reservations: " . $stmt_update_res->error);
            }
            
            $stmt_update_res->close();
        }
        
        // Update student details
        $sql_update = "UPDATE Student SET student_id = ?, first_name = ?, last_name = ?, email = ?, course = ?, year_level = ? WHERE userid = ?";
        $stmt_update = $connection->prepare($sql_update);
        
        if (!$stmt_update) {
            $connection->query("SET FOREIGN_KEY_CHECKS=1");
            throw new Exception("Database prepare error: " . $connection->error);
        }
        
        $stmt_update->bind_param('ssssssi', $new_student_id, $firstName, $lastName, $email, $course, $year_level, $current_userid);
        
        if (!$stmt_update->execute()) {
            $connection->query("SET FOREIGN_KEY_CHECKS=1");
            throw new Exception("Database execute error: " . $stmt_update->error);
        }
        
        $stmt_update->close();
        
        // Re-enable foreign key checks
        $connection->query("SET FOREIGN_KEY_CHECKS=1");
        
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);
        
    } catch (Exception $e) {
        // Make sure foreign keys are re-enabled on error
        $connection->query("SET FOREIGN_KEY_CHECKS=1");
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating your profile.']);
        error_log("Profile update error: " . $e->getMessage());
    }
    
    $connection->close();
?>
