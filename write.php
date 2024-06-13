<?php
SESSION_START();

include 'includes/config.php';
include 'includes/sessions.php';

//Get JSON object
$json_file = file_get_contents('./json/movies.json');
$json_movies = json_decode($json_file, JSON_OBJECT_AS_ARRAY);

$error = '';

//submit review
if(isset($_POST['submit-review'])){
    $user = $_SESSION['userid'];
    $movie = $_POST['movieid'];
    $rating = $_POST['rating'];
    $summary = mysqli_escape_string($conn, $_POST['review-summary']);
    $review = mysqli_escape_string($conn, nl2br($_POST['review']));
    $date = date('Y-m-d H:i:s');
    $type = 'review';


    $insertReview = "INSERT INTO reviews (r_movie, r_rating, r_summary, r_content, r_date, r_user, r_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertReview);
    $stmt->bind_param("sssssss", $movie, $rating, $summary, $review, $date, $user, $type);

    $stmt->execute();
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
        <link rel="stylesheet" href="./css/write-styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
        <div id="loader" class="center"></div>
        <div class="wrapper">
            <?php include "includes/main-nav.php"; ?>
            <div class="write-forms">
                <!-- Select Article type -->
                 <h2 style='margin: 0; padding: 0;'>Write Review/Article</h2>
                 <!-- php error checking -->
                 <?php echo $error; ?>
                 <p>
                    <select name='article-type' id='article-type' class="dropdwn-styles" onchange='typeFunc()'>
                        <option value='default'>Select Article type</option>
                        <option value='review'>Review</option>
                        <option value='article'>Article</option>
                    </select>
                </p>

                <!--Display Review form is selected -->
                <div class="review-form">
                    <form name='review' id='review' action='write.php' method='post'>
                        <table>
                            <tr>
                                <td style='text-align: center;' colspan='2'><b>Search for Movie:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="search-movie" style='width: 244px; display: inline;'>
                                        <span class="material-symbols-outlined" style='vertical-align: bottom;'>search</span>
                                        <input type='text' name='search-movie' id='search-movie' />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' style='text-align: center;'>
                                    <span id='movieResults'></span>
                                    <input type='hidden' name='movieid' id='movieid'/>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan='2' style='text-align: center; padding-top: 1rem;' class='rating-dropdwn'>
                                    <select name='rating' class='dropdwn-styles' id='rating-dropdwn' required>
                                        <option value='default'>Choose a rating</option>
                                        <option value='1' style='color: yellow;'>&starf;</option>
                                        <option value='2' style='color: yellow'>&starf;&starf;</option>
                                        <option value='3' style='color: yellow'>&starf;&starf;&starf;</option>
                                        <option value='4' style='color: yellow'>&starf;&starf;&starf;&starf;</option>
                                        <option value='5' style='color: yellow'>&starf;&starf;&starf;&starf;&starf;</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' class='review-summary'>
                                    <b>Summary:</b><br /><i>&#40;Maximum Characters: 120&#41;</i><br />Current count: <span id='summary-count'></span>
                                    <p style='margin-left: 0;'>
                                        <textarea name='review-summary' id='review-summary' style='width: 70ch;' rows='4'  maxlength='120' required></textarea>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' class='review'>
                                    <b>Review:</b>
                                    <p style='margin-left: 0;'>
                                        <textarea name='review' id='review-text' style='width: 70ch; height: 10rem;' required></textarea>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' class='reviewBtn'>
                                    <input type='submit' name='submit-review' id='submit-review' value='Submit Review'  />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class='article-form'>
                    <form name='article' action='write.php' method='post'>
                        <table>
                            <tr>
                                <td><b>Title:</b></td>
                                <td><input type='text' name='article-title' id='article-title' class='article-title' /></td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <b>Summary:</b><br /><i>&#40;Maximum Characters: 60&#41;</i> Current count: <span id='summary-count'></span>
                                    <p style='margin-left: 0;'>
                                        <textarea name='summary' id='summary' style='width: 70ch; height: 3rem;'></textarea>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="" async defer></script>

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
        <script src="./scripts/navigation.js" defer></script>
        <script src='./json/movies.json' defer></script>
        <script src="./scripts/write.js" defer></script>
        <script defer>
            const movieArr = <?php echo json_encode($json_movies); ?>;

            //get userid for object insertion
            const userid = <?php echo $_SESSION['userid']; ?>;
        </script>
        
    </body>
</html>