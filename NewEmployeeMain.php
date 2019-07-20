<?php

    session_start();

    //if user is not logged in redirect to login page
    if(!isset($_SESSION['user_name']))
    header('Location: login.php');
    include 'ConnectToDB.php';
    include 'processLogin.php';

       // $c_branch_id = $_SESSION['branch_id'];

//lines above for the login
//lines below to update the database (insert new client in The_Client and insert new account in The_Account)
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form

        //mysql credentials
        $mysql_host = "jec353.encs.concordia.ca";
        $mysql_username = "jec353_2";
        $mysql_password = "aaal353f";
        $mysql_database = "jec353_2";

        $e_employee_id = filter_var($_POST["employee_id"], FILTER_SANITIZE_STRING);
        $e_branch_id = filter_var($_POST["branch_id"], FILTER_SANITIZE_STRING);
        $e_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
        $e_address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
        $e_phone = $_POST["phone"];
        $e_email_address = filter_var($_POST["email_address"], FILTER_SANITIZE_EMAIL);
        $e_title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
        $e_start_date = $_POST["start_date"];
        $e_password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

        $e_hr_record_id = filter_var($_POST["hr_record_id"], FILTER_SANITIZE_STRING);
        $e_holidays = filter_var($_POST["holidays"], FILTER_SANITIZE_STRING);
        $e_schedule = filter_var($_POST["schedule"], FILTER_SANITIZE_STRING);
        $e_sick_days = filter_var($_POST["sick_days"], FILTER_SANITIZE_STRING);

        $e_payroll_id = filter_var($_POST["payroll_id"], FILTER_SANITIZE_STRING);
        $e_hourly_rate = filter_var($_POST["hourly_rate"], FILTER_SANITIZE_STRING);
        $e_hours_worked = filter_var($_POST["hours_worked"], FILTER_SANITIZE_STRING);
        $e_pay_date = $_POST["pay_date"];

        //Open a new connection to the MySQL server
        $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

        //Output any connection error
        if ($conn->connect_error) {
                die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
        }

        $con  = mysqli_connect("jec353.encs.concordia.ca","jec353_2","aaal353f","jec353_2");
        // Check connection
        if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

        $sql = "INSERT INTO Employee (employee_id, branch_id, name, address, phone, email_address, title, start_date, password) VALUES ('$e_employee_id', '$e_branch_id', '$e_name', '$e_address','$e_phone', '$e_email_address', '$e_title', '$e_start_date', '$e_password')";

        $sql2 = "INSERT INTO Human_Resources (hr_record_id, employee_id, holidays, schedule, sick_days) VALUES ('$e_hr_record_id', '$e_employee_id', '$e_holidays', '$e_schedule', '$e_sick_days')";

        $sql3 = "INSERT INTO Payroll (payroll_id, employee_id, hourly_rate, hours_worked, pay_date) VALUES ('$e_payroll_id', '$e_employee_id', '$e_hourly_rate', '$e_hours_worked', '$e_pay_date')";

        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
            echo "New employee created successfully";
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Employee cannot be created because of employee id, payroll id and hr record id must be unique")';
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
    <title>New Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script ></script>
</head>
<body>
    <form method="post" action="NewEmployeeMain.php">
Employee id : <input type="text" name="employee_id" placeholder="Enter an id for the new employee" /><br />
Branch id : <input type="text" name="branch_id" placeholder="Assign a branch id for the new employee" /><br />
Name : <input type="text" name="name" placeholder="Enter the employee's name" /><br />
Address : <input type="text" name="address" placeholder="Enter the employee's address" /><br />
Phone number: <input type="tel" name="phone" placeholder="Enter the employee's phone number"/><br />
Email address : <input type="email" name="email_address" placeholder="Enter the employee's email address" /><br />
Title : <input type="text" name="title" placeholder="Enter the position title of the new employee" /><br />
Start date : <input type="date" name="start_date" placeholder="Enter the start date of the new employee" /><br />
Password : <input type="text" name="password" placeholder="Enter the employee's password for his / her account" /><br />

HR record id : <input type="number" name="hr_record_id" placeholder="Enter an HR record id for the new employee" /><br />
Holidays : <input type="number" min = "0" name="holidays" placeholder="Enter the number of days allowed for Holidays" /><br />
Schedule : <input type="text" name="schedule" placeholder="Enter the work schedule for the new employee" /><br />
Sick days: <input type="number" min = "0" name="sick_days" placeholder="Enter the number of sick days allowed for the new employee" /><br />

Payroll id : <input type="number" name="payroll_id" placeholder="Enter a payroll id for the new employee" /><br />
Hourly rate : <input type="text" name="hourly_rate" placeholder="Enter the hourly rate for the new employee" /><br />
Hours worked : <input type="text" name="hours_worked" placeholder="Enter the worked hours per payroll for the new employee" /><br />
Pay date : <input type="date" name="pay_date" placeholder="Enter the pay date for the new employee" /><br />

<input type="submit" value="Submit" />
</form>
<br />
<form action="EmployeeMain.php">
    <input type="submit" value="Go back to main menu" />
</form>
</body>
</html>
