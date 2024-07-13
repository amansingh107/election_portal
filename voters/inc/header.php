<?php 
    session_start();
    require_once("../admin/inc/config.php");

    // if($_SESSION['key'] != "VotersKey")
    // {
    //     echo "<script> location.assign('../admin/inc/logout.php'); </script>";
    //     die;
    // }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="../firstpage/allfile/css/bootstrap.min.css" rel="stylesheet">
    <link href="../firstpage/ionicons/css/ionicons.min.css" rel="stylesheet">
    <!-- <link href="../first/allfile/css/animate.min.css" rel="stylesheet"> -->
    <link href="../firstpage/allfile/allcss/aos.css" rel="stylesheet">
    <!-- main style -->
    <link href="../firstpage/allfile/css/style.css" rel="stylesheet">
   
  
</head>

<body>

    <!-- Preloader -->
    <!-- <div id="preloader">
        <div id="status">

            <div class="preloader" aria-busy="true" aria-label="Loading, please wait." role="progressbar">
            </div>

        </div>
    </div> -->
    <!-- ./Preloader -->
    
    <!-- header -->
    <header class="navbar-fixed-top">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="../admin/logout.php">Logout</a></li>
                <li><a href="../admin/viewResults.php">Reults</a></li>
               
            </ul>
        </nav>
    </header>
    <!-- ./header -->
    
    <!-- home -->
    <div class="section" id="home" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="disply-table">
                <div class="table-cell" data-aos="fade-up" data-aos-delay="0">
                <h4>IIT Bombay </h4>
                    <h1>Welcome to Our<br />Election Website</h1> </div>
            </div>
        </div>
    </div>


      