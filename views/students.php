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
    <title>View Students Table</title><!--***-->
</head>
<body class="<?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light-theme'; ?>">
<!--html-->
<div class="header">
    <h1>Currently Enrolled Students</h1>
    <div class="navbuttons">
        <form action="dashboard.php" method="post">
            <input type="submit" value="Dashboard">
        </form>
        <form action="index.php" method="post">
            <input type="submit" value="Logout">
        </form>
        <button id="themeToggle">Switch Theme</button>
    </div>
</div>
<!---->
<?php
require_once '../database/database.php';
require_once '../database/components.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "students";
/*php*/
// Student Data
echo "<h1>Student Data</h1>";
displayStudents($conn);
/**/
?>
<!--html-->
<!--link to add student page-->
<div class="addstudent">
    <form action="addstudent.php" method="post">
        <input type="submit" value="Add Student">
    </form>
</div>
<!---->
<script src="assets/myscript.js"></script>
</body>
</html>
