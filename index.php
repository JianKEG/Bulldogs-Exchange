<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="src/output.css">
    <title>Login Page</title>
</head>
<body>
    <h1 class="text-3xl font-bold underline">WELCOME TO BULLDOGS EXCHANGE!!</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <div style="color: #b91c1c;">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']); 
            ?>
        </div>
    <?php endif; ?>

    <form id="formLogin" action="actions/login.php" method="POST">
    <input type="text" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <input type="submit" name="loginBtn" value="Login">
    </form>
</body> 
</html>
