<?php

$servername = "localhost";

$username = "agapelee";

$password = "0809";

$dbname = "testdb";

// Create connection
//

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['reg_p'])) {

// receive all input values from the form

$pname = mysqli_real_escape_string($conn,$_POST['pname']);

$price = mysqli_real_escape_string($conn,$_POST['pirce']);

//$pcat = mysqli_real_escape_string($conn,$_POST['pcat']);

//$product_details = mysqli_real_escape_string($conn,$_POST['pdetails']);

// Check connection

if ($conn->connect_error) {

die("Connection failed: " . $conn->connect_error);

}

$sql = "INSERT INTO goal (user_id, goal_id, goal_name, goal_amount, strarting_amount, current_amount, iscomplete) VALUES ('1', '1','goal-test', '10', '1', '1', '0')";
//$sql = "INSERT INTO goal (goal_name, goal_amount) VALUES ('$pname', '$price')";

if ($conn->query($sql) === TRUE) {

echo "alert('New record created successfully')";

} else {

echo "Error: " . $sql . "<br>" . $conn->error;

}

}


$conn->close();

?>
