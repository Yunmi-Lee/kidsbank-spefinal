<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
                        <li class="nav-item"><a class="nav-link" href="#">Statistics</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</nav>
    <hr>


    <div class="row" style="margin: 80px 0 0 0;">
<!--
        <!div class="col" style="margin: 44px;height: 100px;">
            <!div>
                <!p class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! <br>
                    <!a href="reset-password.php"> Reset Your Password</a> <br>
                    <!a href="logout.php"> Sign Out of Your Account</a>
                </p>
            </div>
        </div>
-->

        <!--div class="card"-->
            <h5 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.  <br><br>
                  <?php echo date("Y/m/d") . "  " . date("l") . "  " . date("h:i:sa"); ?>
                <p><a href="reset-password.php" class="btn ">Reset Your Password</a>
                <a href="logout.php" class="btn ">Sign Out of Your Account</a> </p>
            </h5>
        <!--/div-->

    </div>

    <a class="btn btn-primary btn-block" role="button" href="addgoal.php"><i class="fa fa-plus"></i>&nbsp; Add new goal&nbsp;</a>
    <div class="col">
        <p></p>
    </div>
    <div class="row">
        <div class="col"><img class="img-fluid" src="assets/img/main1.jpg"></div>
    </div>

    <footer id="footer">
    <div style= "background: #343a40; text-align: center; margin: 0px 0px 0px 0px; padding:10px">
        <p style= "color:#eee; font-family: raleway; font-size: 15px">Copyright (c) 2021 IIITB Msc. Digital Society DT2019009 Yunmi Lee</p>
    </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>