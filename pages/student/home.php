<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page_title = "Home";
    include ('../../includes/student/header.html');
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
            
            @keyframes rotate {
                100% {
                    transform: rotate(1turn);
                }
            }
        </style>

        <?php 
            if (isset($_SESSION['message'])) {
                echo '<p class="alert">' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']); 
            }
        ?>
        <h1 class="text-6xl font-bold text-center mx-auto mt-40">Welcome to the Bulldogs Exchange!</h1>
        <p class="text-lg text-slate-500 text-center mt-2 max-w-md mx-auto">
            A system for students to reserve school uniforms and merchandise.
        </p>

        <div class="flex flex-row gap-4 items-center justify-center min-h-[100px] w-full p-4">
            <a href="uniform.php" class="flex items-center justify-center px-6 py-2.5 bg-blue-800 text-white font-medium text-sm leading-tight uppercase rounded shadow-md hover:bg-indigo-900 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out decoration-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                    Uniforms
            </a>

            <a href="merchandise.php" class="flex items-center justify-center px-6 py-2.5 bg-amber-400 text-white font-medium text-sm leading-tight uppercase rounded shadow-md hover:bg-amber-500 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition duration-150 ease-in-out decoration-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                    Merchandise
            </a>
        </div>
        <div class="flex items-center justify-center mt-50">  
            <?php include ('../../includes/footer.html'); ?>
        </div>
    </body>
</html>  