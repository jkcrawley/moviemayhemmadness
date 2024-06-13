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
    </head>
    <body>
    
    <div id="loader" class="center"></div>
    <div class="wrapper">
    
        <!-- Desktop navigation -->
        <?php

            include 'includes/main-nav.php';

        ?>
        
        <header class="hero">
            <div class='grain'></div>
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
            <div class="latest-wrapper">
<?php
$moviesSQL = "SELECT m_title, r_movie, r_summary, AVG(r_rating) AS rating, m_poster FROM reviews, movies WHERE reviews.r_movie = movies.m_id GROUP BY r_movie";

if($result = mysqli_query($conn, $moviesSQL)){

    if(mysqli_num_rows($result) > 0){
        

        while ($row = mysqli_fetch_array($result)){
            $stars = "";

            if($row['rating'] == 1){
                $stars = "&starf;";
            }

            if($row['rating'] == 2){
                $stars = "&starf;&starf;";
            }

            if($row['rating'] == 3){
                $stars = "&starf;&starf;&starf;";
            }

            if($row['rating'] == 4){
                $stars = "&starf;&starf;&starf;&starf;";
            }

            if($row['rating'] == 5){
                $stars = "&starf;&starf;&starf;&starf;&starf;";
            }

            
            ?>
            <a href='movie.php?id=<?php echo $row['r_movie']; ?>' style='color: black; font-weight: none;'>
                <div class="recent-movie">
                
                    <?php
                    echo "<h3>" . $row['m_title'] . "</h3>";
                    echo "<div style='display: flex; align-items: start; clear: right; margin: 2rem 0rem; width: 21.875rem'>";
                    echo "<div style=\"background-image:url('./posters/" . $row['m_poster'] . "'); background-size: cover; min-width: 9.375rem; display: inline-block; min-height: 12.3125rem;\"></div>";
                    echo "<p style='font-weight: none; font-family: poppins; margin: 0; margin-left: 1rem; padding: 0;'>" . $row['r_summary'] . "</p></div>";
                    echo "<p style='margin-bottom: 0px; padding-bottom: 0px;'>Average User Ratings</p><p style='color:yellow; margin-top: -1rem; padding: -1rem;'><br />" . $stars . "</p>";
                    ?>
                </div>
            </a>
            <?php
        }
    }
}
?>
            </div>
        </section>
    </div>

    <script>
        document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector("body").style.visibility = "hidden";
        document.querySelector("#loader").style.visibility = "visible";
    } else {
        document.querySelector("#loader").style.display = "none";
        document.querySelector("body").style.visibility = "visible";
    }
};
    </script>
    <script src="./scripts/homepage.js" defer></script>
    <script src="./scripts/navigation.js" defer></script>
    </body>
</html>