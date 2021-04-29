<?php

// Include config file
require_once "config.php";

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

    $sql = "INSERT INTO goal (user_id, goal_id, goal_name, goal_amount, strarting_amount, current_amount, duedate) VALUES ('1', '1', '$gname', '$gmoney ', '$smoney', '$smoney', '$date')";
    //$sql = "INSERT INTO goal (goal_name, goal_amount) VALUES ('$pname', '$price')";

    if ($link->query($sql) === TRUE) {

        echo "alert('New record created successfully')";

    } else {

        echo "Error: " . $sql . "<br>" . $link->error;

    }
    // Close connection
    mysqli_close($link);
    header("location: home_glist.php");
}





?>
