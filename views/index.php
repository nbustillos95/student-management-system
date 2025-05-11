<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---->
    <link rel="stylesheet" href="assets/layout.css">
    <link rel="stylesheet" href="assets/style.css">
    <!---->
    <title>Index</title><!--***-->
</head>
<body class="<?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light-theme'; ?>">
<!--html-->
<div class="header">
    <h1>Welcome to the Student Management System</h1>
    <div class="navbuttons">
        <button id="themeToggle">Switch Theme</button>
    </div>
</div>
<div class=loginform>
    <h2>Login</h2>
    <form action="dashboard.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</div>
<!---->
<?php
require_once '../database/database.php';
require_once '../database/components.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "index";
/*php*/

/**/
$conn->close();
?>
<!--html-->

<!---->
<script src="assets/myscript.js"></script>
</body>
</html>