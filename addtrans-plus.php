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

$month = date('m');
$day = date('d');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;

if (isset($_POST['reg_p2'])) {

    $param1 = mysqli_real_escape_string($link,$_SESSION["uid"]);
    $param2 = mysqli_real_escape_string($link,$_SESSION["goal"]);
    // receive all input values from the form
    $amount = mysqli_real_escape_string($link,$_POST['tamount']);
    $desc = mysqli_real_escape_string($link,$_POST['desc']);
    $rawdate = htmlentities($_POST['tdate']);
    $date = date('Y-m-d', strtotime($rawdate));

    $sql = "INSERT INTO trans (user_id, goal_name, plus, trans_amount, description, create_date)
            VALUES ('$param1', '$param2', '1', '$amount', '$desc', '$date')";

    if ($link->query($sql) === TRUE) {
        //echo "alert('New record created successfully')";
    } else {
        //    echo "Error: " . $sql . "<br>" . $link->error;
    }

    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    $_SESSION["goal"] = $param2;

    //update current money
    $link->set_charset('utf8mb4'); // always set the charset
    $stmt = $link->prepare("SELECT current_amount FROM goal WHERE user_id=? AND goal_name=? limit 1");
    $stmt->bind_param('ss', $param1, $param2);
    $stmt->execute();

    $result = $stmt->get_result();
    $value = $result->fetch_object();
    $camount = $value->current_amount;
    $camount = $camount + $amount;

    //update goal
    $query = $link->prepare("UPDATE goal SET current_amount=? WHERE user_id=? AND goal_name=?");
    $query->bind_param('sss', $camount, $param1, $param2);
    $query->execute();

    // Close connection
    mysqli_close($link);
    header("location: gdetail.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>web-dev0</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body><nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
    <div class="container"><a class="navbar-brand" href="home.php"><i class="fa fa-child"></i> KIDS BANK</a>
        <nav class="navbar navbar-light navbar-expand-md text-right">
            <div class="container-fluid"><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="logout.php">Log out</a></li>
                        <li class="nav-item"><a class="nav-link" href="home_glist.php">My Goals</a></li>
                        <li class="nav-item"><a class="nav-link" href="statistics.php">Statistics</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                </div>
            </div>
        </nav>
    </div>
</nav>
    <hr>
    <div class="row" style="margin: 70px 60px 0px 0;"><div><button class = bbtn onclick="goBack()"> <i class="fa fa-arrow-left"></i> </button>

<script>
function goBack() {
  window.history.back();
}
</script></div>
        <div class="col" style="height: 30px;">
            <p style="margin: 0;color: #000000;font-family: 'Open Sans', sans-serif;">Goal <?php echo $_SESSION["goal"]?> <?php echo $_SESSION["uid"]?></p>
        </div>
    </div>
    <div class="row" style="margin: 0;height: 140px;">
        <div class="col" style="margin: 0px 0px 60px 0;height: 80px;width: 100%;"><div>
<p class="my-5" style="color:blue; font-size:25px; background-color:powderblue;"> + New transaction </p>
</div></div>
    </div>

    <form action="addtrans-plus.php" method="post">
    <div class="row">
        <div class="col-auto"><label class="labelip" style="margin: 10px 10px 10px 10px;">Amount</label><input type="text" id="anyip" style="font-family: 'Open Sans', sans-serif;margin: 10px 0 10px 0;width: 200px;" name="tamount"></div>
        <div class="col-auto"><label class="labelip" style="margin: 10px 10px 10px 10px;">Desc.</label><input type="text" id="anyip" style="font-family: 'Open Sans', sans-serif;margin: 10px 0 10px 0;width: 200px;" name="desc"></div>
    </div>
    <div class="row" style="height: 70px;">
        <div class="col-3" style="width: 40px;height: 60px;"><label class="col-form-label labelip" style="margin: 10px 10px 10px 10px;width: 40px;">Date</label></div>
        <div class="col-9" style="width: 280px;"><input class="float-left" id="anyip-1" type="date" value="<?php echo $today; ?>" name='tdate' style="margin: 20px 0 10px 0;width: 170px;"><i class="fa fa-calendar-o" style="margin: 25px 10px;"></i></div>
    </div>
     <button id="submit" class="btn btn-primary btn-block" name="reg_p2" style="margin: 40px 0 0 0;">Submit</button>
    </form>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>