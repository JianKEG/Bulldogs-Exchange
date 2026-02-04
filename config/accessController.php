<?php

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: main.php');
    exit();
}
?>