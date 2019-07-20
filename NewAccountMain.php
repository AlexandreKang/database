<?php

    session_start();

    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');

    include 'ConnectToDB.php';

//lines above for the login
//lines below to create new account but not new client

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $c_account_number = filter_var($_POST["account_number"], FILTER_SANITIZE_STRING);
        $c_client_id = filter_var($_POST["client_id"], FILTER_SANITIZE_STRING);
        $c_type = filter_var($_POST["type"], FILTER_SANITIZE_STRING);
        $c_account_option = filter_var($_POST["account_option"], FILTER_SANITIZE_STRING);
        $c_balance = $_POST["balance"];

        //Open a new connection to the MySQL server
        $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

        //Output any connection error
        if ($conn->connect_error) {
                die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
$sql = "INSERT Account (account_number, client_id, type, account_option, balance) VALUES ('$c_account_number', '$c_client_id', '$c_type', '$c_account_option', '$c_balance')";

if ($conn->query($sql) === TRUE) {
    echo "New account created successfully";
        } else {
            echo '<script language="javascript">';
            echo 'alert("Account cannot be created because of account number must be unique")';
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
    <title>New Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="NewAccountMain.php">
Client id : <input type="text" name="client_id" placeholder="Enter the client id to add a new account for the client" /><br />
Account number : <input type="text" name="account_number" placeholder="Enter an account number for the client" /><br />
Type : <input type="text" name="type" placeholder="Enter the client's type of account (Checking or Saving)" /><br />
Account option : <input type="text" name="account_option" placeholder="Enter the client's option's type (Student, Platinum or Easy)" /><br />
Balance : <input type="number" min = "0" step="0.01" name="balance" placeholder="Enter the client's first deposit for the new account" /><br />

<input type="submit" value="Submit" />
</form>
<br />
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>