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
    <title>Dashboard</title><!--***-->
</head>
<body class="<?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light-theme'; ?>">
<!--html-->
<div class="header">
    <h1>Welcome to the dashboard.</h1>
    <!--logout button-->
    <div class="navbuttons">
        <form action="index.php" method="post">
            <input type="submit" value="Logout">
        </form>
        <button id="themeToggle">Switch Theme</button>
    </div>
</div>
<div class="dashboard">
    <ul>
        <li><a href="students.php">View/Edit Students</a></li>
    </ul>
</div>
<!---->
<?php
require_once '../database/database.php';
require_once '../database/components.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "dashboard";
/*php*/

/**/
$conn->close();
?>
<!--html-->

<!---->
<script src="assets/myscript.js"></script>
</body>
</html>
