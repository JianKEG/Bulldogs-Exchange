<?php 
    require_once('../../config/connection.php');
    
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM Student WHERE s_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
?> 