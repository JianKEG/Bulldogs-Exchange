<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $page_title = "About Us";
    require '../../config/accessController.php';
    require '../../config/connection.php';
    include ('../../includes/student/header.html');
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
<h1 class="text-3xl font-semibold text-center mx-auto mt-10">About Us</h1>
<p class="text-sm text-slate-500 text-center mt-2 max-w-md mx-auto">
   A system for students to reserve school uniforms and merchandise.
</p>
<div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 px-4 md:px-0 py-10">
    <img class="max-w-sm w-full rounded-xl h-auto"
        src="../../assets/images/bulldogsLogo.png" alt="Bulldogs Logo" />
    <div>
        <h1 class="text-3xl font-semibold">Our Latest features</h1>
        <p class="text-sm text-slate-500 mt-2">
            Ship Beautiful Frontends Without the Overhead — Customizable, Scalable and Developer-Friendly UI
            Components.
        </p>

        <div class="flex flex-col gap-10 mt-6">
            <div class="flex items-center gap-4">
                <div class="size-9 p-2 bg-indigo-50 border border-indigo-200 rounded">
                    <img src="https://raw.githubusercontent.com/prebuiltui/prebuiltui/main/assets/aboutSection/flashEmoji.png" alt="">
                </div>
                <div>
                    <h3 class="text-base font-medium text-slate-600">Lightning-Fast Performance</h3>
                    <p class="text-sm text-slate-500">Built with speed — minimal load times and optimized.</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="size-9 p-2 bg-indigo-50 border border-indigo-200 rounded">
                    <img src="https://raw.githubusercontent.com/prebuiltui/prebuiltui/main/assets/aboutSection/colorsEmoji.png" alt="">
                </div>
                <div>
                    <h3 class="text-base font-medium text-slate-600">Beautifully Designed Components</h3>
                    <p class="text-sm text-slate-500">Modern, pixel-perfect UI components ready for any project.</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="size-9 p-2 bg-indigo-50 border border-indigo-200 rounded">
                    <img src="https://raw.githubusercontent.com/prebuiltui/prebuiltui/main/assets/aboutSection/puzzelEmoji.png" alt="">
                </div>
                <div>
                    <h3 class="text-base font-medium text-slate-600">Plug-and-Play Integration</h3>
                    <p class="text-sm text-slate-500">Simple setup with support for React, Next.js and Tailwind css.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>