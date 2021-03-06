<?php

include('gtable-test.php');

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

<body>

<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
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
    <div class="row" style="margin: 70px 60px 0px 0;">
        <div>
            <button class = bbtn onclick="goBack()"> <i class="fa fa-arrow-left"></i> </button>
            <script>
            function goBack() {
                window.history.back();
            }
            </script>
        </div>
        <div class="col" style="height: 30px;"></div>
    </div>

    <div class="row" style="margin: 0;height: 140px;">
        <div class="col" style="margin: 0px 20px 60px 0;height: 80px;">
            <div>
                <p class="my-5" style="color:black; font-size:25px; background-color:#eee; text-align:center; width:100%"> Add your goal <i class="fa fa-star"></i></p>
            </div>
        </div>
    </div>

    <form action="addgoal.php" method="post">
    <div class="row">
        <div class="col"><label class="labelip" style="margin: 10px 10px 10px 10px;">Goal Name</label><input type="text" id="anyip" style="font-family: 'Open Sans', sans-serif;margin: 10px 0 10px 0;width: 200px;" name="gname"></div>
        <div class="col"><label class="labelip" style="margin: 10px 10px 10px 10px;">Goal Amount</label><input type="text" id="anyip" style="font-family: 'Open Sans', sans-serif;margin: 10px 0 10px 0;width: 200px;" name="gamount"></div>
        <div class="col"><label class="labelip" style="margin: 10px 10px 10px 10px;">Starting amount</label><input type="text" id="anyip" style="font-family: 'Open Sans', sans-serif;margin: 10px 0 10px 0;width: 200px;" name="samount"></div>
    </div>
    <div class="row" style="height: 105px;">
        <div class="col" style="width: 80px;"><label class="col-form-label labelip" style="margin: 10px 10px 10px 10px;">Due Date</label></div>
        <div class="col-8" style="width: 210px;"><input class="float-left" id="anyip-1" type="date" name='ddate' style="margin: 20px 0 10px 0;width: 170px;"><i class="fa fa-calendar-o" style="margin: 25px 10px;"></i></div>
    </div>
    <button id="submit" class="btn btn-primary btn-block" name="reg_p">Submit</button>
    </form>

    <footer id="footer">
    <div style= "background: #343a40; text-align: center; margin: 0px 0px 0px 0px; padding:10px">
        <p style= "color:#eee; font-family: raleway; font-size: 13.5px">Copyright (c) 2021 IIITB Msc. Digital Society DT2019009 Yunmi Lee</p>
    </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>