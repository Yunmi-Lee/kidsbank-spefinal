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
</head>

<body style="height: 20px;"><nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
    <div class="container"><a class="navbar-brand" href="index.html"><i class="fa fa-child"></i> KIDS BANK</a>
        <nav class="navbar navbar-light navbar-expand-md text-right">
            <div class="container-fluid"><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="#">Log out</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Statistics</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
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
        <div class="col" style="margin: 0px 20px 60px 0;height: 80px;"><div>
<p class="my-5">Username<b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>'s Goals <i class="fa fa-star"></i></p>
</div></div>
    </div><a class="btn btn-primary btn-block" role="button" href="addgoal.php"><i class="fa fa-plus"></i>&nbsp; Add new goal&nbsp;</a>
    <div class="col">
        <p></p>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Goal name</th>
                            <th>Progress</th>
                            <th>Due Date</th>
                            <th>Current Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cell 1</td>
                            <td>
                                <div class="progress">
                                <div class="progress-bar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                </div> Cell 2
                            </td>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                        </tr>
                        <tr>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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