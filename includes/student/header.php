<!DOCTYPE html>
<html>
    <head>
        <title><?php echo isset($page_title) ? $page_title : "Default Title"; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../src/output.css">
    </head>
</html>
<body>
    <nav class="flex items-center justify-between px-6 md:px-16 lg:px-24 xl:px-32 py-2 relative z-50 border-b border-gray-300 bg-white transition-all">
        <a href="home.php">
            <img class="h-12" src="../../assets/images/bulldogsLogo.png" alt="bulldogsLogo">
        </a>

        <!--mobile tablet-->
        <button aria-label="Menu" id="menu-toggle" class="lg:hidden">
            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="21" height="1.5" rx=".75" fill="#426287"/>
                <rect x="8" y="6" width="13" height="1.5" rx=".75" fill="#426287"/>
                <rect x="6" y="13" width="15" height="1.5" rx=".75" fill="#426287"/>
            </svg>
        </button>

        <div id="mobile-menu" class="hidden absolute top-15 left-0 z-50 w-full bg-white shadow-md py-4 flex-col items-start gap-2 px-5 text-sm lg:hidden">
            <a href="home.php" class="block">Home</a>
            <a href="uniform.php" class="block">Uniforms</a>
            <a href="merchandise.php" class="block">Merchandise</a>
            <a href="about.php" class="block">About</a>
            <a href="#" class="block">Profile</a>
            <a href="viewReservedItems.php" class="block">Reserved Items</a>

            <form action="../../actions/logout.php" method="POST">
                <button type="submit" class="block w-full py-1 hover:bg-gray-100 text-left">Logout</button>
            </form>
        </div>
        <!---------->

        <!--desktop-->
        <div class="hidden lg:flex justify-center ml-10 gap-8 relative z-10">
            <a href="home.php">Home</a>
            <a href="uniform.php">Uniforms</a>
            <a href="merchandise.php">Merchandise</a>
            <a href="about.php">About</a>
        </div>

        <div class="hidden lg:flex items-center justify-center relative z-10"> <!--cart profile-->
            <div class="pr-3"> <!-- Profile -->
                <div id="profile-toggle" class="group relative">
                    <a href="#"> 
                        <img
                            src="../../assets/images/sampleProfile.jpg"
                            alt="image"
                            class="size-12 rounded-full border-2 border-white group-hover:scale-110 transition-all duration-400 z-2"
                        >
                    </a>
                </div>

                <div id="profile-menu" class="hidden absolute top-16 right-0 z-50 w-40 bg-white shadow-lg rounded-md py-2 flex-col items-start px-3 text-sm">
                    <a href="studentProfile.php" class="block w-full py-1 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block w-full py-1 hover:bg-gray-100">Settings</a>
                    <form action="../../actions/logout.php" method="POST" class="w-full">
                        <button type="submit" class="block w-full py-1 hover:bg-gray-100 text-left cursor-pointer">Logout</button>
                    </form>
                </div>
            </div>

            <div id="reserved-items-toggle" class="relative cursor-pointer ml-6"> <!--For Reserved Items -->
                <a href="viewReservedItems.php">
                <svg width="26" height="26" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M.583.583h2.333l1.564 7.81a1.17 1.17 0 0 0 1.166.94h5.67a1.17 1.17 0 0 0 1.167-.94l.933-4.893H3.5m2.333 8.75a.583.583 0 1 1-1.167 0 .583.583 0 0 1 1.167 0m6.417 0a.583.583 0 1 1-1.167 0 .583.583 0 0 1 1.167 0" stroke="#615fff" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
    
                <button class="absolute -top-2 -right-3 text-xs text-white bg-indigo-500 w-4.5 h-4.5 rounded-full">3</button>
                </a>
            </div>
        </div>
    </nav>

    <script src="../../assets/js/navbar.js"></script>
</body>
</html>