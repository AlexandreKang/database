<?php
    session_start();
    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');

    include 'ConnectToDB.php';

//lines above for the login
//lines below to update account

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $c_client_id = filter_var($_POST["client_id"], FILTER_SANITIZE_STRING);
        $c_branch_id = $_POST['branch_id'];
        $c_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
        $c_date_of_birth = $_POST["date_of_birth"];
        $c_phone = $_POST["phone"];
        $c_email_address = filter_var($_POST["email_address"], FILTER_SANITIZE_EMAIL);
        $c_address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
        $c_joining_date = $_POST["joining_date"];
        $c_password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

//Open a new connection to the MySQL server
        $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

        //Output any connection error
        if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE Client SET branch_id = '$c_branch_id', name = '$c_name', date_of_birth = '$c_date_of_birth', phone = '$c_phone', email_address = '$c_email_address', address = '$c_address', joining_date = '$c_joining_date', password = '$c_password' WHERE client_id = '$c_client_id'";
if ($conn->query($sql) === TRUE) {
    echo "Client updated successfully";
}

else {
            echo '<script language="javascript">';
            echo 'alert("The client id does not exist in the database")';
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
    <title>Update Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="UpdateClientAllInfoMain.php">
Client id : <input type="text" name="client_id" placeholder="Enter the client id whose updating his / her information" /><br />
Branch id : <input type="text" name="branch_id" placeholder="Enter the new branch id of the client" /><br />
Name : <input type="text" name="name" placeholder="Enter the new name of the client" /><br />
Date of birth : <input type = "date" name="date_of_birth" placeholder="Enter the new date of birth of the client"/><br />
Phone number: <input type="tel" name="phone" placeholder="Enter the client's phone number"/><br />
Email address : <input type="email" name="email_address" placeholder="Enter the client's email address" /><br />
Address : <input type="text" name="address" placeholder="Enter the client's address" /><br />
Joining date : <input type = "date" name="joining_date" placeholder="Enter the date when the client created his / her first account" /><br />
Password : <input type="text" name="password" placeholder="Enter the client's password for his / her account" /><br />
<input type="submit" value="Submit" />
</form>
<br>
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>