<?php
SESSION_START();

include 'includes/config.php';
include 'includes/sessions.php';

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/stylesheet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
            /* Hide desktop-nav to check php errors

            .desktop-nav{
                display: none;
            }
            */
        </style>
    </head>
    <body>
    <div id="loader" class="center"></div>
    <div class="wrapper">

        <!-- Desktop navigation -->
        <?php

            include 'includes/main-nav.php';

        ?>

        <header class="hero">
            <div  style='width: 540px;'>
                <h1>Movie <br />&nbsp;&nbsp;&nbsp;&nbsp;Mayhem <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Madness</h1>
                <h2>Insightful Reviews and ratings for your favorite popular and cult films.</h2>
            </div>
        </header>

        <section class='discover'>
            <span class='hidden'>
                <h2>Discover the latest and Most Popular Movies.</h2>
                <p>Explore our collection of movies, featuring the latest releases and all-time favorites. Find reviews, ratings, and more!</p>
                <p style='margin-top: 5rem;'><a href='signup.php'>Join Now</a></p>
            </span>
            <div class='featured-wrapper'>
                <div class='movies movie1 showimg'>
                </div>
                <div class='movies movie2'>
                </div>
                <div class='movies movie3'>
                </div>
                <div class='movies movie4'>
                </div>
                <div class='movies movie5'>
                </div>
            </div>
        </section>

        <section class='featured-films'>
            <h2>Latest Reviews</h2>
        </section>
    </div>

    <script src="./scripts/homepage.js" defer>
        //page loader
        document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector("body").style.visibility = "hidden";
        document.querySelector("#loader").style.visibility = "visible";
        document.querySelector('.wrapper').style.display = 'none';
    } else {
        document.querySelector("#loader").style.display = "none";
        document.querySelector("body").style.visibility = "visible";
    }
};
    </script>
    </body>
</html>