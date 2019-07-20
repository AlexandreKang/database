<?php

    session_start();

    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');

    include 'ConnectToDB.php';

//lines above for the login
//lines below for the deletion of an account but not a client

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $c_account_number = filter_var($_POST["account_number"], FILTER_SANITIZE_STRING);

// Create connection
$conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
// Check connection
if (!$conn) {
     die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM Account WHERE account_number = '$c_account_number'";
$sql2 = "DELETE FROM Transaction WHERE account_number = '$c_account_number'";
if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
    echo "Account deleted successfully";
}

/*else {
    echo "Error deleting account: " . $conn->error;
}*/

else {
            echo '<script language="javascript">';
            echo 'alert("Account does not exist in the database")';
            echo '</script>';
        }

$conn->close();
}?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delete Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="DeleteAccountMain.php">
In order to delete an account, please enter his / her account number : <input type="text" name="account_number" placeholder="Enter the client's account number to delete the account." /><br />
<input type="submit" value="Remove account" />
</form>
<br />
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>