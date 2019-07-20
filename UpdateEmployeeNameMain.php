<?php
    session_start();
    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');

    include 'ConnectToDB.php';
    include 'processLogin.php';

//lines above for the login
//lines below to update account

$e_employee_id = $_SESSION['employee_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $e_name = $_POST['name'];
//Open a new connection to the MySQL server
        $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

        //Output any connection error
        if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE Employee SET name = '$e_name' WHERE employee_id = '$e_employee_id'";
if ($conn->query($sql) === TRUE) {
    echo "Employee updated successfully";
}

else {
            echo '<script language="javascript">';
            echo 'alert("The employee id does not exist in the database")';
            echo '</script>';
        }

$conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update employee's name</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="UpdateEmployeeNameMain.php">
Name : <input type="text" name="name" placeholder="Enter the new name of the employee" /><br />
<input type="submit" value="Submit" />
</form>
<br>
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>