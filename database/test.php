<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---->
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/style.css">
    <!---->
    <title>Test</title><!--***-->
</head>
<body>
<!--html-->
<!---->
<?php
require_once 'database.php';
require_once 'components.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "test";
/*php*/
// Student Data
echo "<h1>Student Data</h1>";
displayStudents($conn);
/**/
$conn->close();
?>
<!--html-->
<!---->
</body>
</html>