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
    <title>Edit Student</title><!--***-->
</head>
<body class="<?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light-theme'; ?>">
<!--html-->
<div class="header">
    <h1>Edit Student</h1>
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
<!---->
<?php
require_once '../database/database.php';
require_once '../database/components.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "editstudent";
/*php*/
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
    $student = getStudentByID($conn, $studentID);
    if ($student) {
        displayEditStudentForm($student);
    } else {
        echo "<p>Student not found.</p>";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['studentID'];
    $studentName = $_POST['studentName'];
    $studentEmail = $_POST['studentEmail'];
    $studentDOB = $_POST['studentDOB'];
    $studentGrade = $_POST['studentGrade'];

    if (updateStudent($conn, $studentID, $studentName, $studentEmail, $studentDOB, $studentGrade)) {
        header("Location: students.php");
        exit();
    } else {
        echo "<p>Failed to update student details. Please try again.</p>";
    }
}
/**/
?>
<!--html-->

<!---->
<script src="assets/myscript.js"></script>
</body>
</html>