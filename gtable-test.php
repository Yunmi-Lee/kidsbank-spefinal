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
$name = htmlspecialchars($_SESSION["username"]);
//echo $name;

$link->set_charset('utf8mb4'); // always set the charset
$stmt = $link->prepare("SELECT id FROM users WHERE username=? limit 1");
$stmt->bind_param('s', $name);
$stmt->execute();
$result = $stmt->get_result();
$value = $result->fetch_object();


if (isset($_POST['reg_p'])) {

    // receive all input values from the form
    $gname = mysqli_real_escape_string($link,$_POST['gname']);
    $gmoney = mysqli_real_escape_string($link,$_POST['gamount']);
    $smoney = mysqli_real_escape_string($link,$_POST['samount']);
    $rawdate = htmlentities($_POST['ddate']);
    $date = date('Y-m-d', strtotime($rawdate));

    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    $sql = "INSERT INTO goal (user_id, goal_id, goal_name, goal_amount, strarting_amount, current_amount, duedate)
    VALUES ('$value->id', '1', '$gname', '$gmoney ', '$smoney', '$smoney', '$date')";

    if ($link->query($sql) === TRUE) {
        //echo "alert('New record created successfully')"
    } else {
        //    echo "Error: " . $sql . "<br>" . $link->error;
    }

    if(empty($_SESSION["uid"])){
        $_SESSION["uid"] = $uid;
    }
//    $_SESSION["goal"] = $gname;

    // Close connection
    mysqli_close($link);
    header("location: home_glist.php");
}

?>
