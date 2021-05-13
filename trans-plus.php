<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$gname = test; //$_GET['gname'];
$uid = 7; //$_GET['uid'];


if (isset($_POST['reg_p'])) {

    // receive all input values from the form
    $amount = mysqli_real_escape_string($link,$_POST['tamount']);
    $desc = mysqli_real_escape_string($link,$_POST['desc']);
    $rawdate = htmlentities($_POST['tdate']);
    $date = date('Y-m-d', strtotime($rawdate));

    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    $sql = "INSERT INTO trans (user_id, goal_name, plus, trans_amount, discription, create_date)
    VALUES ('$uid', '$gname', '1', '$amount', '$desc', '$date')";

    if ($link->query($sql) === TRUE) {
        //echo "alert('New record created successfully')";
    } else {
        //    echo "Error: " . $sql . "<br>" . $link->error;
    }


    // Close connection
    mysqli_close($link);
    header("location: gdetail.php");


}

?>
