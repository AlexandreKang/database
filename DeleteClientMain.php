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

        $c_client_id = filter_var($_POST["client_id"], FILTER_SANITIZE_STRING);

// Create connection
$conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
// Check connection
if (!$conn) {
     die("Connection failed: " . $conn->connect_error);
}
// sql to delete a record
$sql = "DELETE FROM Client WHERE client_id = '$c_client_id'";
$sql2 = "DELETE FROM Transaction WHERE account_number IN (SELECT account_number FROM Account WHERE client_id = '$c_client_id')";
$sql3 = "DELETE FROM Account WHERE client_id = '$c_client_id'";

if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "Client deleted successfully";
}

/*else {
    echo "Error deleting client: " . $conn->error;
}*/


else {
            echo '<script language="javascript">';
            echo 'alert("Client id does not exist in the database")';
            echo '</script>';
        }

$conn->close();
}?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delete Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="DeleteClientMain.php">
In order to delete a client, please enter his / her client_id : <input type="text" name="client_id" placeholder="Enter the client id to delete the client in the database." /><br />
<input type="submit" value="Submit" />
</form>
<br />
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>