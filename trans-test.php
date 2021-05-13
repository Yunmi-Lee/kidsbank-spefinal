<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if($_SESSION["uid"]){
  echo '***';
  echo $_SESSION["uid"];
}

if($_SESSION["goal"]){
  echo '***';
  echo $_SESSION["goal"];
}



// Include config file
require_once "config.php";

if (isset($_POST['reg_p1'])) {

    $param1 = $_SESSION["uid"];
    $param2 = $_SESSION["goal"];

    echo $param1;
    echo $param2;

    // receive all input values from the form
    $amount = mysqli_real_escape_string($link,$_POST['tamount']);
    $desc = mysqli_real_escape_string($link,$_POST['desc']);
    $rawdate = htmlentities($_POST['tdate']);
    $date = date('Y-m-d', strtotime($rawdate));

    $sql = "INSERT INTO trans (user_id, goal_name, plus, trans_amount, description, create_date)
            VALUES ('3', '333', '1', '3333', 'desc', '2021-1-1')";
          //VALUES ('$param1', '$param2', '1', '$amount', '$desc', '$date')";

    if ($link->query($sql) === TRUE) {
        //echo "alert('New record created successfully')";
    } else {
        //    echo "Error: " . $sql . "<br>" . $link->error;
    }

    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    // Close connection
    mysqli_close($link);
    //header("location: gdetail.php");

}

?>


<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <form action="trans-test.php" method="post">
    <div class="row">
        <div class="col-auto"><label class="labelip" style="margin: 10px 10px 10px 10px;">Amount</label><input type="text" id="anyip" style="font-family: 'Open Sans', sans-serif;margin: 10px 0 10px 0;width: 200px;" name="tamount"></div>
        <div class="col-auto"><label class="labelip" style="margin: 10px 10px 10px 10px;">Desc.</label><input type="text" id="anyip" style="font-family: 'Open Sans', sans-serif;margin: 10px 0 10px 0;width: 200px;" name="desc"></div>
    </div>
    <div class="row" style="height: 70px;">
        <div class="col-3" ><label class="col-form-label labelip" style="margin: 10px 10px 10px 10px;width: 40px;">Date</label></div>
        <div class="col-9" ><input class="float-left" id="anyip-1" type="date" name='tdate' ><i class="fa fa-calendar-o" style="margin: 25px 10px;"></i></div>
    </div>
     <button id="submit" class="btn btn-primary" name="reg_p1">Submit</button>
    </form>

</body>

</html>