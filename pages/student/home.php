<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page_title = "Home";
    include ('../../includes/student/header.php');
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../src/output.css">
        <title>Home</title>       
    </head>
    
    <body>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *       {
                font-family: 'Poppins', sans-serif;
            }
            
        
        </style>

        <?php 
            if (isset($_SESSION['message'])) {
                echo '<p class="alert">' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']); 
            }
        ?>
        <h1 class="text-7xl font-bold text-center mx-auto mt-50">Welcome to the Bulldogs Exchange!</h1>
        <p class="text-lg text-slate-400 text-center mt-2 mx-auto">A system for students to reserve school uniforms and merchandise.</p>

        <div class="flex flex-row gap-4 items-center justify-center min-h-25 w-full p-4">
            <a href="uniform.php" class="flex items-center justify-center px-6 py-2.5 bg-blue-800 text-white font-medium text-sm leading-tight uppercase rounded shadow-md hover:bg-indigo-900 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out decoration-0">
                Uniforms
            </a>

            <a href="merchandise.php" class="flex items-center justify-center px-6 py-2.5 bg-amber-400 text-white font-medium text-sm leading-tight uppercase rounded shadow-md hover:bg-amber-500 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition duration-150 ease-in-out decoration-0">
                Merchandise
            </a>
        </div>
        <div class="flex items-center justify-center mt-50">  
            <?php include ('../../includes/footer.html'); ?>
        </div>
    </body>
</html>  