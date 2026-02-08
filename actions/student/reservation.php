<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once '../../config/connection.php';
    require_once '../../config/accessController.php';
    
    $user = $_SESSION['username'];
    $user_id = $_SESSION['id'];
    $cookie_name = 'cart_' . $user;
            
    $sql_check_student = "SELECT student_id FROM Student WHERE student_id = $user_id";
    $query = mysqli_query($connection, $sql_check_student) ;

    if(mysqli_num_rows($query) === 0) {
         header('Location: ../../pages/student/completeProfile.php');
        exit();
    }

    