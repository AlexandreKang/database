<?php

    session_start();

    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');
    include 'ConnectToDB.php';
    include 'processLogin.php';

        $c_branch_id = $_SESSION['branch_id'];

//lines above for the login
//lines below to update the database (insert new client in The_Client and insert new account in The_Account)
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $c_client_id = filter_var($_POST["client_id"], FILTER_SANITIZE_STRING);
        $c_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
        $c_date_of_birth = $_POST["date_of_birth"];
        $c_phone = $_POST["phone"];
        $c_email_address = filter_var($_POST["email_address"], FILTER_SANITIZE_EMAIL);
        $c_address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
        $c_joining_date = $_POST["joining_date"];
        $c_category = filter_var($_POST["category"], FILTER_SANITIZE_STRING);
        $c_password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

        $c_account_number = filter_var($_POST["account_number"], FILTER_SANITIZE_STRING);
        $c_type = filter_var($_POST["type"], FILTER_SANITIZE_STRING);
        $c_account_option = filter_var($_POST["account_option"], FILTER_SANITIZE_STRING);
        $c_balance = $_POST["balance"];

        //Open a new connection to the MySQL server
        $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

        //Output any connection error
        if ($conn->connect_error) {
                die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
        }

        $sql = "INSERT INTO Client (client_id, branch_id, name, date_of_birth, phone, email_address, address, joining_date, category, password) VALUES ('$c_client_id', '$c_branch_id', '$c_name', '$c_date_of_birth', '$c_phone', '$c_email_address', '$c_address', '$c_joining_date', '$c_category', '$c_password')";

        $sql2 = "INSERT INTO Account (account_number, client_id, type, account_option, balance) VALUES ('$c_account_number', '$c_client_id', '$c_type', '$c_account_option', '$c_balance')";

        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            echo "New client created successfully" . "<br>";
            echo "New account created successfully";
        } else {
            echo '<script language="javascript">';
            echo 'alert("Account cannot be created because of client id and account number must be unique")';
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
    <title>New Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="NewClientMain.php">
Client id : <input type="text" name="client_id" placeholder="Enter an id for the client" /><br />
Name : <input type="text" name="name" placeholder="Enter the name" /><br />
Date of birth : <input type = "date" name="date_of_birth" placeholder="Enter the date of birth"/><br />
Phone number: <input type="tel" name="phone" placeholder="Enter the client's phone number"/><br />
Email address : <input type="email" name="email_address" placeholder="Enter the client's email address" /><br />
Address : <input type="text" name="address" placeholder="Enter the client's address" /><br />
Joining date : <input type = "date" name="joining_date" placeholder="Enter today's date" /><br />
Category : <input type="text" name="category" placeholder="Enter the client's category (Private, Business or Corporate)" /><br />
Password : <input type="text" name="password" placeholder="Enter the client's password for his / her account" /><br />

Account number: <input type="text" name="account_number" placeholder="Enter an account id for the client" /><br />
Type : <input type="text" name="type" placeholder="Enter the client's type of account (Checking or Saving)" /><br />
Account Option : <input type="text" name="account_option" placeholder="Enter the client's option's type (Student, Platinum or Easy)" /><br />
Balance : <input type="number" min = "0" step="0.01" name="balance" placeholder="Enter the client's first deposit" /><br />

<input type="submit" value="Submit" />
</form>
<br />
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>
