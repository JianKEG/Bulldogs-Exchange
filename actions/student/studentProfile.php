<?php 
    require_once('../../config/connection.php');
    
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM Student WHERE userid = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    if (!$row) {
        header('Location: ../../pages/student/completeProfile.php');
        exit();
    }

    include ('../../includes/student/header.php');
?> 