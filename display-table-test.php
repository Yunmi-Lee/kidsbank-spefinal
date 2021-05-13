<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<html>
<head>

<style>
table {
    width: 100%;
    display:block;
}
thead {
    //display: inline-block;
    display: block;
    width: 100%;
    height: 20px;
}
tbody {
    height: 200px;
    //display: inline-block;
    display: block;
    width: 100%;
    //overflow: auto;
    //height: 100px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
}
</style>

</head>
<body>
<?php 
require_once "config.php";

$name = htmlspecialchars($_SESSION["username"]);
echo $name;

$link->set_charset('utf8mb4'); // always set the charset
$stmt = $link->prepare("SELECT id FROM users WHERE username=? limit 1");
$stmt->bind_param('s', $name);
$stmt->execute();
$result = $stmt->get_result();
$value = $result->fetch_object();
echo '----';
echo $value->id;
$uid = $value->id;

$query = $link->prepare("SELECT * FROM goal WHERE user_id=?");
$query->bind_param('s', $uid);
$query->execute();

/*
$result = $query->get_result();
while($value = $result->fetch_object())
{

    //echo $value;
    echo $value->goal_name;
}
*/


echo '<table border="0" cellspacing="2" cellpadding="2">
        <thead>
	      <tr> 
	                <td> <font face="Arial">Goal Name</font> </td>
			        <td> <font face="Arial">Goal Amount</font> </td>
				    <td> <font face="Arial">Starting Amount</font> </td>
					<td> <font face="Arial">Current Amount</font> </td>
					<td> <font face="Arial">Due Date</font> </td>
	      </tr>
	    </thead>';



echo '  <tbody>';


if ($result = $query->get_result()) {
        while($value = $result->fetch_object())
        {
		            $field1name = $value->goal_name;
			        $field2name = $value->goal_amount;
			        $field3name = $value->strarting_amount;
				    $field4name = $value->current_amount;
				    $prog = ($field4name/$field2name)*100;
				   // echo " --- ";
				   // echo $field4name;
				   // echo " --- ";
				   // echo $field2name;
				    echo " ---  ";
				    echo round($prog)."\n";

				    $date = date_create($value->duedate);
				    $field5name = date_format($date,"Y-m-d");
				                echo '<tr>
					                      <td>'.$field1name.'</td>
						                  <td>'.$field2name.'</td>
						                  <td><progress id="file" value="2" max="100"> 10%</progress>
						                  <p> <?php echo $prog; ?> </p>         </td>
						                  <td>'.$field4name.'</td>
						                  <td>'.$field5name.'</td>
					            </tr>';
        }
	    $result->free();
}


echo '  </tbody>';




?>
</body>
</html>
