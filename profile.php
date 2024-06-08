<?php
SESSION_START();

include 'includes/config.php';
include 'includes/sessions.php';

$profSQL = "SELECT * FROM users WHERE u_id = " . $_SESSION['userid'];
$profResult = $conn->query($profSQL);
$profRow = $profResult->fetch_assoc();

$profpic = $profRow['u_pic'];

//check if logged in

$loginErr = '';

if(!isset($_SESSION['userid'])){
    $loginErr = "<h2 style='text-align: center;'>You need to be logged in to view this page</h2>";
}

//check if user is a reviewer or admin to display ability to write an article or use tools.
$write = '';

$tools = '';

if($_SESSION['userlevel'] == 'admin' || $_SESSION['userlevel'] == 'reviewer'){
    $write = "<p><a href='write.php?id=" . $_SESSION['userid'] . "'>Write Review/Article</a></p>";

    if($_SESSION['userlevel'] == 'admin'){
        $tools = "<p><a href='admin/tools.php' >Admin tools</a></p>";
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
        <link rel="stylesheet" href="./css/profile-styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        
    </head>
    <body>
       <div class="wrapper">
            <?php include "includes/main-nav.php"; ?>
            <div class="profile">
                    <div class="update-pic">
                        
                        <div class="prof-pic" style="background-image: url('<?php echo $profpic; ?>');" ></div>
                        <form action='profile.php' method='post' enctype='multipart/form-data' style='margin: 0; margin-top: 1rem; padding: 0; display: inline-block;'>
                        
                        <label for='picbtn' class='profbtn'>Update Profile Pic</label><input type='file' class='picbtn' id='picbtn' />
                        </form>
                    </div>
                    <div class="prof-text">
                        <?php echo $loginErr; ?>
                        <h2><?php echo " " . $profRow['u_username']; ?></h2>
                        <h3><?php echo " " . $profRow['u_level']; ?></h3>
                        <p><b>Email:</b> <?php echo $profRow['u_email'];  ?></p>
                        <p>
                            <a href="resetpassword.php?id=<?php echo $_SESSION['userid']; ?>" >Reset Password</a>
                        </p>
                        <?php 
                            echo $write;
                            echo $tools;
                        ?>
                    </div>
            </div>
       </div>
        
       <!--<script src="./scripts/homepage.js" defer></script>-->
        <script src="./scripts/navigation.js" defer></script>
    </body>
</html>