<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../config/connection.php';


    if (isset($_POST['loginBtn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM Student_Log WHERE username =? Limit 1";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        if($username && hash('md5', $password) == $user['password']){
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['message'] = "You are now logged in!";
            header('location: ../pages/student/home.php');
            exit();
        }
        else{
            $_SESSION['message'] = "Invalid username or password!";

            header('location: ../index.php');
            exit();
        }
    }
?>