<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$name = htmlspecialchars($_SESSION["username"]);
$first = 0;

$link->set_charset('utf8mb4'); // always set the charset
$stmt = $link->prepare("SELECT id FROM users WHERE username=? limit 1");
$stmt->bind_param('s', $name);
$stmt->execute();
$result = $stmt->get_result();
$value = $result->fetch_object();
$uid = $value->id; //get user id

if(empty($_SESSION["uid"])){
    $_SESSION["uid"] = $uid;
}

$query = $link->prepare("SELECT * FROM goal WHERE user_id=?");
$query->bind_param('s', $uid);
$query->execute();
$result1 = $query->get_result();
$value = $result1->fetch_object();
if ($value) {
    $first = 0;
} else {
    $first = 1;
}

// Close connection
mysqli_close($link);
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
    <style>
        /* Add a card effect for articles */
        .card {
          background-color: white;
          padding: 20px;
          //margin-top: 20px;
        }
    </style>
</head>

<body><nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
    <div class="container"><a class="navbar-brand" href=#><i class="fa fa-child"></i> KIDS BANK</a>
        <nav class="navbar navbar-light navbar-expand-md text-right">
            <div class="container-fluid"><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="logout.php">Log out</a></li>
                        <li class="nav-item"><a class="nav-link" href="home_glist.php">My Goals</a></li>
                        <li class="nav-item"><a class="nav-link" href="statistics.php">Statistics</a></li>
                        <li class="nav-item"><a class="nav-link" href="complete.php">Completed</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="reset-pw.php">Reset PW</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</nav>
    <hr>


    <div class="row" style="margin: 80px 0 30px 0;">
        <h5 class="my-5" style= "margin: 0px 0px 0px 20px;font-size: 30px;"> Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> !
        <a style="font-family: 'Open Sans', sans-serif;color: var(--gray-dark);margin: 0px 0px 0px 0px;font-size: 10px;">Logged in: <?php echo date("Y-m-d") . "  " . date("l") . "  " . date("h:i:sa"); ?> </a>
        </h5>

    </div>

    <a class="btn btn-primary btn-block" role="button" href="addgoal.php"><i class="fa fa-plus"></i>&nbsp; Add new goal&nbsp;</a>
    <div class="col">
        <p></p>
    </div>


    <div class="row" style="margin: 70px 0px 0px 0px;height: 300px;background: url(&quot;assets/img/main1.jpg&quot;);background-size: cover;">
        <div class="col" style="margin: 0px 20px 60px 0;height: 150px;">
        <p class="myp-1" style="font-family: 'Open Sans', sans-serif;color: black;text-align: center;margin: 20px 20px 0px 35px;height: 50px;font-size: 25px;background: rgba(255,253,252,0.44);"> <b>Please add your
        <?php
        if ($first) {
            echo "first";
        } ?>
        goal ! </b><i class="icon-diamond"></i></p>
        </div>
    </div>


    <footer id="footer">
    <div style= "background: #343a40; text-align: center; margin: 20px 0px 0px 0px; padding:10px">
        <p style= "color:#eee; font-family: raleway; font-size: 13.5px">Copyright (c) 2021 IIITB Msc. Digital Society DT2019009 Yunmi Lee</p>
    </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>