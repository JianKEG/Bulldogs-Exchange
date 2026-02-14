<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="src/output.css">
    <title>Login Page</title>
    
</head>

<body class="bg-blue-50 min-h-screen flex items-center justify-center">
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *       {
                font-family: 'Poppins', sans-serif;
            }
            
    </style>

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold text-center mb-4 text-yellow-400">BULLDOGS EXCHANGE</h1>
        <p class="text-center text-gray-400 mb-6">Welcome! Please login to continue.</p>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']); 
                ?>
            </div>
        <?php endif; ?>

        
        <form id="formLogin" action="actions/login.php" method="POST" class="space-y-4">
            <div>
                <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <input type="submit" name="loginBtn" value="Login"class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-yellow-500 transition cursor-pointer">
            </div>

        </form>

    </div>

</body>
</html>

