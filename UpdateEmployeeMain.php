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
    <title>Update employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <div>
        <p>Welcome to Bank, <?php echo $_SESSION['user_name'];?>!</p>
    </div>

<p>Please select an option to update the employee's information</p>


<form action="UpdateEmployeeBranchIdMain.php">
    <input type="submit" value="Update employee's branch ID" />
</form><br />

<form action="UpdateEmployeeNameMain.php">
    <input type="submit" value="Update employee's name" />
</form><br />

<form action="UpdateEmployeeAddressMain.php">
    <input type="submit" value="Update employee's address" />
</form><br />

<form action="UpdateEmployeePhoneMain.php">
    <input type="submit" value="Update employee's phone number" />
</form><br />

<form action="UpdateEmployeeEmailAddressMain.php">
    <input type="submit" value="Update employee's email address" />
</form><br />

<form action="UpdateEmployeeTitleMain.php">
    <input type="submit" value="Update employee's title" />
</form><br />

<form action="UpdateEmployeeStartDateMain.php">
    <input type="submit" value="Update employee's start date" />
</form><br />

<form action="UpdateEmployeePasswordMain.php">
    <input type="submit" value="Update employee's password" />
</form><br />

<form action="UpdateEmployeeHolidaysMain.php">
    <input type="submit" value="Update employee's number of holidays" />
</form><br />

<form action="UpdateEmployeeScheduleMain.php">
    <input type="submit" value="Update employee's schedule" />
</form><br />

<form action="UpdateEmployeeSickDaysMain.php">
    <input type="submit" value="Update employee's number of sick days" />
</form><br />

<form action="UpdateEmployeeHourlyRateMain.php">
    <input type="submit" value="Update employee's hourly rate" />
</form><br />

<form action="UpdateEmployeeHoursWorkedMain.php">
    <input type="submit" value="Update employee's number of hours worked" />
</form><br />

<form action="UpdateEmployeePayDateMain.php">
    <input type="submit" value="Update employee's pay date" />
</form><br />

<form action="UpdateEmployeeAllInfoMain.php">
    <input type="submit" value="Update all information of the employee" />
</form><br />

<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>