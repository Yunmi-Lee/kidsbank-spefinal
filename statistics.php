<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$user = $_SESSION["uid"];

// Include config file
require_once "config.php";

//define variables for goal statistics
$comp_total = 0;
$goal_total = 0;
$active_total = 0;
$current_total = 0;
$left_total = 0;
$total_amount = 0;
$saved_total_p_goal = 0;
$total_prog = 0;
$inx = 1;

$chart = array ( //2x20 multidimensional array
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0)
);

//define variables for transaction statistics
$saved_total = 0;
$minus_total = 0;
$trans_total = 0;
$balance = 0;
$avg_trans = 0;


$link->set_charset('utf8mb4'); // always set the charset

//conduct goal statistics
$query = $link->prepare("SELECT * FROM goal WHERE user_id=?");
$query->bind_param('s', $user);
$query->execute();

if ($result = $query->get_result()) {
        while($value = $result->fetch_object()) {
            $goal_total++;
            if ($value->iscomplete) {
                $comp_total++;
            } else {
                $active_total++;
            }

            $current_total += $value->current_amount;
            $total_amount += $value->goal_amount;

            //find transaction
            $gname = $value->goal_name;

            $stmt = $link->prepare("SELECT * FROM trans WHERE user_id=? and goal_name=?");
            $stmt->bind_param('ss', $user, $gname);
            $stmt->execute();

            if ($result1 = $stmt->get_result()) {
                    while($value = $result1->fetch_object()) {

                        if($value->plus) { //plus
                            $saved_total_p_goal += $value->trans_amount;
                        } else { //minus
                            $saved_total_p_goal -= $value->trans_amount;
                        }
                    }
                    $chart[$inx++] = array($gname, $saved_total_p_goal);
                    $saved_total_p_goal = 0;
                    $result1->free();
            }
        }

        $left_total = $total_amount - $current_total;
        if ($left_total < 0) {
            $left_total = 0;
        }
        $total_prog = round(($current_total/$total_amount)*100,1);
        $result->free();
}

//conduct transaction statistics
$query1 = $link->prepare("SELECT * FROM trans WHERE user_id=?");
$query1->bind_param('s', $user);
$query1->execute();

if ($result2 = $query1->get_result()) {
        while($value = $result2->fetch_object()) {
            if($value->plus) { //plus
                $saved_total += $value->trans_amount;
            } else { //minus
                $minus_total += $value->trans_amount;
            }
            $trans_total++;
        }
        $balance = $saved_total - $minus_total;
        $avg_trans = round($balance/$trans_total,1);
        $result2->free();
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
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
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
                        <li class="nav-item"><a class="nav-link" href="complete.php">Completed</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                    </ul>
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

    <div class="col" style="height: 30px;"></div>
    </div>
    <div class="row" style="margin: 0;height: 160px;">
        <div class="col" style="margin: 0px 0px 10px 0px;height: 80px;width: 100%;">
        <div>
        <p class="my-5" style="color:black; font-size:25px; background-color:#eee; text-align:center; border-style: outset;border-width: 2px;border-color: #eee"> Statistics </p>
        </div></div>
    </div>

    <div class="row">
        <div class="col">
            <ul class="list-group" style="font-family: 'Open Sans', sans-serif;color: var(--gray-dark);margin: 0px 0px 0px 0px;font-size: 18px;">
                <li class="list-group-item"><span>Completed goal: <?php echo $comp_total ?></span></li>
                <li class="list-group-item"><span>Active goal: <?php echo $active_total ?></span></li>
                <li class="list-group-item"><span>Current money total: $<?php echo $current_total ?></span></li>
                <li class="list-group-item"><span>Amount left: $<?php echo $left_total ?></span></li>
                <li class="list-group-item"><span>Saved money total: $<?php echo $saved_total ?></span></li>
                <li class="list-group-item"><span>Spend money total: $<?php echo $minus_total ?></span></li>
                <li class="list-group-item"><span>Balance: $<?php echo $balance ?></span></li>
                <li class="list-group-item"><span>All transactions: <?php echo $trans_total ?></span></li>
                <li class="list-group-item"><span>Average transaction: $<?php echo $avg_trans ?></span></li>

            </ul>
        </div>
    </div>

     <div class="row" >
        <div class="col" style="margin: 40px 20px 20px 20px;height: 40px;">
            <p style="font-family: 'Open Sans', sans-serif;color: var(--gray-dark);text-align: right;margin: 10px;font-size: 15px;">Total Progress&nbsp; $<?php echo $current_total;?> / $<?php echo $total_amount;?> ( <?php echo $total_prog; ?>% )</p>
            <div class="progress">
                <div class="progress-bar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_prog;?>%;"><?php echo $total_prog;?>%</div>
            </div>

        </div>
    </div>

    <div style="margin: 60px 0px 50px 0px;"><canvas data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;January&quot;,&quot;February&quot;,&quot;March&quot;,&quot;April&quot;,&quot;May&quot;,&quot;June&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;4500&quot;,&quot;5300&quot;,&quot;6250&quot;,&quot;7800&quot;,&quot;9800&quot;,&quot;15000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
    <a class="btn btn-primary btn-block" role="button" href="complete.php" style="margin: 50px 0px 0px 0px;"><i class="icon-pin"></i>&nbsp; Completed goal&nbsp;</a><footer id="footer">
    
    <div style= "background: #343a40; text-align: center; margin: 20px 0px 0px 0px; padding:10px">
        <p style= "color:#eee; font-family: raleway; font-size: 14px">Copyright (c) 2021 IIITB Msc. Digital Society DT2019009 Yunmi Lee</p>
    </div>
</footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>