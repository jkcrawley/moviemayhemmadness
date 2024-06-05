<?php
SESSION_START();

$loggedin ='';
$loggedout ='';

if(isset($_SESSION['userid'])){
    $loggedin = "style='display: inline-block;'";
    $loggedout = "style='display: none;'";
} else {
    $loggedin = "style='display: none;'";
    $loggedout = "style='display: table-cell;vertical-align: middle;'";
}

//logout menu
$tools = '';
$write = '';


//display links according to user level and privileges.

if(isset($_SESSION['userlevel'])){
    $userlevel = $_SESSION['userlevel'];

    if($userlevel = 'admin'){
        $tools = "<a href='admin/tools.php'>Admin Tools</a>";
        $write = "<a href='#'>Write a Review</a>";
    }

    if($userlevel = 'reviewer'){
        $tools = "";
        $write = "<a href='#'>Write a Review</a>";
    }
}

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
        <nav class='desktop-nav'>
        <h2><a href='index.php'>Movie Mayhem Madness</a></h2>

            <ul>
                <!--Search button-->
                <li>
                    <form action='' method='post'>
                        <div class='search'>
                            <span class="material-symbols-outlined" style='color: black;'>search</span>
                            <input type='search' name='search' class='search-input' placeholder='Search'/>
                        </div>
                    </form>
                </li>

                <!--- Desktop drop down for profile -->
                <li class='dropdown'<?php echo $loggedin; ?>>
                    <button onclick='dropdown()' class='dropbtn'>
                        <span class="material-symbols-outlined person">person</span>
                    </button>
                    <div id="prof-menu" class="profile-links">
                        <a href='#'>My Profile</a>

                        <?php 
                            echo $tools; 
                            echo $write; 
                        ?>
                        <a href='logout.php'>Logout</a>
                    </div>
                </li>
                
                <!-- Display signup and log out buttons if user is logged out -->
                <span <?php echo $loggedout; ?>>
                    <li><a href='signup.php' class='nav-signup'>Sign Up</a></li>
                    <li><a href='login.php' class='nav-login'>Log In</a><li>
                </span>
            </ul>
        </nav>

        <header class="hero">
            <h1>Movie <br />&nbsp;&nbsp;&nbsp;&nbsp;Mayhem <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Madness</h1>
            <h2>Insightful Reviews and ratings for your favorite films.</h2>
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