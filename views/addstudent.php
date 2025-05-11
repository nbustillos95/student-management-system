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
    <title>Add Student</title><!--***-->
</head>
<body class="<?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light-theme'; ?>">
<!--html-->
<div class="header">
    <h1>Add New Student</h1>
    <!--logout button-->
    <div class="navbuttons">
        <form action="students.php" method="post">
            <input type="submit" value="View Students">
        </form>
        <form action="dashboard.php" method="post">
            <input type="submit" value="Dashboard">
        </form>
        <form action="index.php" method="post">
            <input type="submit" value="Logout">
        </form>
        <button id="themeToggle">Switch Theme</button>
    </div>
</div>
<!--form to add student-->
<div class="addstudentform">
<form action="addstudent.php" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email"><br>
    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob"><br>
    <label for="grade">Grade:</label><br>
    <input type="text" id="grade" name="grade"><br>
    <br><br><br>
    <input type="submit" value="Add Student">
</form>
</div>
<!---->
<?php
require_once '../database/database.php';
require_once '../database/components.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "addstudent";
/*php*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $grade = $_POST['grade'] ?? '';
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>All fields must be filled out correctly.</p>";
    } else {
        // Call the addStudent function
        $message = addStudent($conn, $name, $email, $dob, $grade);
        // Display the result
        echo "<p>$message</p>";
    }
}
/**/
?>
<!--html-->

<!---->
<script src="assets/myscript.js"></script>
</body>
</html>