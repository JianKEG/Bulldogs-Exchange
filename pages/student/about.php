<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $page_title = "About Us";
    require '../../config/accessController.php';
    require '../../config/connection.php';
    include ('../../includes/student/header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../../src/output.css">
</head>
<body>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
    }
</style>
<h1 class="text-4xl font-bold text-center mx-auto mt-20">About Us</h1>
    <p class="text-lg text-slate-500 text-center mt-5 max-w-2xl mx-auto">
        A web-based inventory platform where students can view real-time stock of uniforms/merchandise and secure reservations without going to the physical store.
    </p>
    <div class="text-lg text-slate-500 text-center mt-10 max-w-xs mx-auto">
        <ul>
            <li>BSCS241A</li>
            <li>Abrenilla, Alfonso</li>
            <li>Cabrera, Edrei</li>
            <li>Clarion, Zairiel</li>
            <li>Gapatan, Jian</li>
            <li>Kagahastian, Zet</li>
        </ul>
    </div>
    <div class="flex items-center justify-center mt-20">
        <?php include ('../../includes/footer.html'); ?>
    </div>
</body>
</html>