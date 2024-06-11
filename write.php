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
                 <p>
                    <select name='article-type' id='article-type' class="dropdwn-styles" onchange='typeFunc()'>
                        <option value='default'>Select Article type</option>
                        <option value='review'>Review</option>
                        <option value='article'>Article</option>
                    </select>
                </p>
                <div class="review-form">
                    <form name='review' id='review' action='write.php'>
                        <table>
                            <tr>
                                <td style='text-align: right;'><b>Search for Movie:</b></td>
                                <td  style='text-align: left;'>
                                    <div class="search-movie" style='width: 244px;'>
                                        <span class="material-symbols-outlined" style='vertical-align: bottom;'>search</span>
                                        <input type='text' name='search-movie' id='search-movie' />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' style='text-align: center;'>
                                    <select name='rating' class='dropdwn-styles' id='rating-dropdwn'>
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
                                <td colspan='2'>
                                    <b>Summary:</b><br /><i>&#40;Maximum Characters: 60&#41;</i> Current count: <span id='summary-count'></span>
                                    <p style='margin-left: 0;'>
                                        <textarea name='summary' id='summary' style='width: 70ch; height: 3rem;'></textarea>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <b>Review:</b>
                                    <p style='margin-left: 0;'>
                                        <textarea name='review' id='review' style='width: 70ch; height: 10rem;'></textarea>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
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
        <script src="./scripts/write.js" defer></script>
    </body>
</html>