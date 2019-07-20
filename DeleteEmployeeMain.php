<?php
    session_start();

    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');
    include 'ConnectToDB.php';

//lines above for the login
//lines below to delete client

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $e_employee_id = filter_var($_POST["employee_id"], FILTER_SANITIZE_STRING);

// Create connection
$conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
// Check connection
if (!$conn) {
     die("Connection failed: " . $conn->connect_error);
}
// sql to delete a record
$sql = "DELETE FROM Employee WHERE employee_id = '$e_employee_id'";
$sql2 = "DELETE FROM Human_Resources WHERE employee_id = '$e_employee_id'";
$sql3 = "DELETE FROM Payroll WHERE employee_id = '$e_employee_id'";

if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "Employee deleted successfully";
}
/*else {
    echo "Error deleting employee: " . $conn->error;
}
*/

else {
            echo '<script language="javascript">';
            echo 'alert("Employee id does not exist in the database")';
            echo '</script>';
        }

$conn->close();
}?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delete Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="DeleteEmployeeMain.php">
In order to delete an employee, please enter his / her employee_id : <input type="text" name="employee_id" placeholder="Enter the employee id to delete the employee in the database." /><br />
<input type="submit" value="Submit" />
</form>
<br />
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>