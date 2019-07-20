<?php

    session_start();

    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');

    include 'ConnectToDB.php';
    include 'processLogin.php';

    $c_branch_id = $_SESSION['branch_id'];

//lines above for the login
//lines below to update account

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $c_account_number = filter_var($_POST["account_number"], FILTER_SANITIZE_STRING);
        $c_balance = $_POST["balance"];

        $c_client_id = $_POST["client_id"];
        $c_transaction_date = $_POST["transaction_date"];


//Open a new connection to the MySQL server
        $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

        //Output any connection error
        if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

        $sql = "UPDATE Account SET balance = balance + '$c_balance' WHERE account_number = '$c_account_number'";
        $sql2 = "INSERT Transaction (transaction_id, branch_id, client_id, account_number, amount, transaction_date, transaction_type) VALUES (NULL, '$c_branch_id', '$c_client_id', '$c_account_number', '$c_balance', '$c_transaction_date', 'Deposit')";

if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
    echo "Account updated successfully";
}

else {
            echo '<script language="javascript">';
            echo 'alert("The account does not exist in the database")';
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
    <title>Update Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="UpdateDepositAccountMain.php">
Account number : <input type="text" name="account_number" placeholder="Enter an account number to update the account" /><br />
Deposit: <input type="number" min = "0" step="0.01" name="balance" placeholder="Enteran amount to deposit in the client's account" /><br />
Client id : <input type="text" name="client_id" placeholder="Enter the client id whose doing the transaction" /><br />
Transaction date : <input type="date" name="transaction_date" placeholder="Enter today's date" /><br />

<input type="submit" value="Submit" />
</form>
<br>
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>