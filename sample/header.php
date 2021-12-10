<?php
include 'logChecker.php';
?>
<html>
<head>
    <title>DASHBOARD</title>    
    <link href="css/style.css?v=<?=rand()?>" rel="stylesheet" type="text/css" />  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script src="js/bootbox.js" type="text/javascript"></script>

        <script src="js/login.js?v=<?=rand()?>"></script>  
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: sans-serif;             
            }
            .dashboard_panel{
                display:block;
                width:100%;
            }
            .dashboard_top{
                margin:0;
                background-color: #edb603;
                height:80px;
                width:100%;
                padding:0 20px;
            }
            .dashboard_center{
                padding: 0px 20px;
                width:100%;
                min-height: calc(100vh - 130px);
                height:auto;
            }
            .dashboard_bottom{
                margin:0;
                background-color: #b3b2c0;
                height:50px;
                width:100%;
            }
            .application_name{
                float:left;
                font-size 24px;
                font-weight:bold;
                color:#000;
                padding-top:30px;
                padding-left:10px;
            }
        </style>
</head>

<body>
    <div class="dashboard_panel">
        <div class="dashboard_top">
            <div class="row">
                <div class="col-md-2">
                    <img src="images/logo.png" alt="Sample" style="height: 80px;width:80px">
                </div>
                <div class="col-md-7">
                    <span class="application_name">Application console </span>
                </div>
                <div class="col-md-3" style="padding-top:25px">
                    <span class="staff_name">Welcome <?=ucfirst($person_loggedin)?>&nbsp;|&nbsp;<a href="logout.php" style="color:#000;">&nbsp;Signout</a>
                    </span>                    
                </div>
            </div>
        </div>