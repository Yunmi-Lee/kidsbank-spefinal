<?php
// Initialize the session
session_start();

if(!empty($_GET['gname'])){
    $_SESSION["goal"] = $_GET['gname'];
}

require_once "config.php";

$uid = $_SESSION["uid"];
$gname = $_SESSION["goal"];

$link->set_charset('utf8mb4'); // always set the charset
$stmt = $link->prepare("SELECT * FROM goal WHERE user_id=? AND goal_name=? limit 1");
$stmt->bind_param('ss', $uid, $gname);
$stmt->execute();

$result = $stmt->get_result();
$value = $result->fetch_object();

$cmoney = $value->current_amount;
$tmoney = $value->goal_amount;
$prog = round(($cmoney/$tmoney)*100, 1);
$gdate = $value->duedate;
$cpl = $value->iscomplete;

$query = $link->prepare("SELECT * FROM trans WHERE user_id=? AND goal_name=?");
$query->bind_param('ss', $uid, $gname);
$query->execute();
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
    <div class="row" style="margin: 0;">
        <div class="col offset-2" style="margin: 0px 20px 60px 0;height: 80px;"><div>
<p class="my-5"> Goal <i class="fa fa-star"></i> <b> <?php echo $_SESSION["goal"] ?></b> <i class="fa fa-star"></i></p>
</div></div>
    </div>
    <div class="row" style="margin: 0;">
        <div class="col" style="margin: 20px 20px 60px 20px;height: 40px;">
            <p style="font-family: 'Open Sans', sans-serif;color: var(--gray-dark);text-align: right;margin: 10px;">Progress&nbsp; $<?php echo $cmoney;?> / $<?php echo $tmoney;?> ( <?php echo $prog; ?>% )</p>
            <div class="progress">
                <div class="progress-bar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog;?>%;"><?php echo $prog;?>%</div>
            </div>
            <p style="font-family: 'Open Sans', sans-serif;color: var(--gray-dark);text-align: left;margin: 10px 0px 10px;font-size: 10px;">Due date: <?php echo $gdate; ?>&nbsp;&nbsp;
            <?php
            if ($cpl) {
                echo '<a href="complete.php" style="font-size: 15px; color: red;"> <b>Complete!</b> </a>';
            } ?>
            </p>
        </div>
    </div>
    <div class="row" style="margin: 0;height: 100px;">
        <div class="col-5" style="margin: 50px 20px 3px 4px;height: 50px;width: 100px;">
            <p class="myp" style="font-family: 'Open Sans', sans-serif;color: var(--gray-dark);text-align: left;margin: 20px 2px 0px 15px;width: 130px;">Transactions</p>
        </div>
        <div class="col-2" style="height: 50px;margin: 60px 2px 3px 4px;"><a class="btn btn-primary btn-block" role="button" id="rbtn" href="addtrans-plus.php" style="height: 50px;width: 50px;padding: 0;"><i class="fa fa-plus" style="margin: 17px 2px 3px 4px;"></i></a></div>
        <div class="col-2" style="height: 50px;margin: 60px 2px 3px 4px;"><a class="btn btn-primary btn-block" role="button" id="rbtn" href="addtrans-minus.php" style="height: 50px;width: 50px;padding: 0;background-color: rgb(239,89,89);border-style: none;"><i class="fa fa-minus" style="margin: 17px 2px 3px 4px;"></i></a></div>

    </div>

    <div class="row" style="margin: 0;height: 230px;">
        <div class="col" style="margin: 20px 20px 60px 0px;height: 600px;">
            <div class="table-responsive" style ="margin: 30px 20px 60px 10px;overflow-x:scroll;height:350px;">
                <table class="table" >
                    <thead >
                        <tr>
                            <th style="margin: 30px 20px 0px 20px;">Amount</th>
                            <th>In/Out</th>
                            <th>Desc.</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody >

                    <?php
                    if ($result = $query->get_result()) {
                            while($value = $result->fetch_object())
                            {
                    		            $field1name = $value->trans_amount;
                    			        //$field2name = $value->plus;
                    			        if($value->plus) {
                    			            $field2name = "In";
                    			        } else {
                    			            $field2name = "Out";
                    			        }
                    			        $field3name = $value->description;
                    				    $date = date_create($value->create_date);
                    				    $field4name = date_format($date,"Y-m-d");

                    					            echo '<tr>
                                                              <td>$ '.$field1name.'</td>
                                                              <td>'.$field2name.'</td>
                                                              <td>'.$field3name.'</td>
                                                              <td>'.$field4name.'</td>
                                                    </tr>';
                            }
                    	    $result->free();
                    }
                    // Close connection
                    mysqli_close($link);
                    ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <div class="row" style="margin: 180px 0px 0px 0px;height: 200px;background: url(&quot;assets/img/main2.jpg&quot;);background-size: cover;">
        <div class="col" style="margin: 0px 20px 60px 0;height: 150px;">
            <p class="myp-1" style="font-family: 'Open Sans', sans-serif;color: black;text-align: left;margin: 20px 20px 0px 35px;height: 150px;font-size: 15px;background: rgba(255,253,252,0.44);">
            Goal details:<br>You saved 7$ on average.<br>The expecting date is 17/May/2021.<br>It will completed in 12 days.&nbsp;</p>
        </div>
    </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>