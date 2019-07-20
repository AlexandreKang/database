<?php session_start();

    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <div>
        <p>Welcome to Bank, <?php echo $_SESSION['user_name'];?>!</p>
    </div>

<p>Please select an option to update the client information</p>

<form action="UpdateClientBranchIdMain.php">
    <input type="submit" value="Update branch ID" />
</form><br />

<form action="UpdateClientNameMain.php">
    <input type="submit" value="Update client's name" />
</form><br />

<form action="UpdateClientDateOfBirthMain.php">
    <input type="submit" value="Update client's date of birth" />
</form><br />

<form action="UpdateClientPhoneMain.php">
    <input type="submit" value="Update client's phone number" />
</form><br />

<form action="UpdateClientEmailAddressMain.php">
    <input type="submit" value="Update client's email address" />
</form><br />

<form action="UpdateClientJoiningDateMain.php">
    <input type="submit" value="Update client's joining date" />
</form><br />

<form action="UpdateClientAddressMain.php">
    <input type="submit" value="Update client's address" />
</form><br />

<form action="UpdateClientPasswordMain.php">
    <input type="submit" value="Update client's password" />
</form><br />

<form action="UpdateClientAllInfoMain.php">
    <input type="submit" value="Update all client's information" />
</form><br />

<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>