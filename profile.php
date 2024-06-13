<?php
SESSION_START();

include 'includes/config.php';
include 'includes/sessions.php';



$profSQL = "SELECT * FROM users WHERE u_id = " . $_SESSION['userid'];
$profResult = $conn->query($profSQL);
$profRow = $profResult->fetch_assoc();

$profpic = $profRow['u_pic'];

//check if logged in

//check if user is a reviewer or admin to display ability to write an article or use tools.
$write = '';

$tools = '';

if($_SESSION['userlevel'] == 'admin' || $_SESSION['userlevel'] == 'reviewer'){
    $write = "<p><a href='write.php'><span class='material-symbols-outlined' style='vertical-align: bottom;'>edit_note</span>&nbsp;&nbsp;Write Review/Article</a></p>";

    if($_SESSION['userlevel'] == 'admin'){
        $tools = "<p><a href='admin/tools.php' ><span class='material-symbols-outlined' style='vertical-align: bottom;'>construction</span>&nbsp;&nbsp;Admin tools</a></p>";
    }
}



if(isset($_POST['sub-pic'])){
    $filename = $_FILES['uploadimg']['name'];
    $tempname = $_FILES['uploadimg']['tmp_name'];
    $folder = "./profile-imgs/" . $filename;

    move_uploaded_file($tempname, $folder);

    $picSQL = "UPDATE users SET u_pic = ? WHERE u_id = " . $_SESSION['userid'];
    $picStmt = $conn->prepare($picSQL);
    $picStmt->bind_param('s', $folder);
    $picStmt->execute();

    header("location: profile.php");

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
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    </head>
    <body onload='uploadFunc()'>
        <div id="loader" class="center"></div>
       <div class="wrapper">
            <?php include "includes/main-nav.php"; ?>
            <div class="profile">
                    <div class="update-pic" style='text-align'>
                        
                        <div class="prof-pic" style="background-image: url('<?php echo $profpic; ?>');" ></div>
                        <form action='profile.php' method='post' enctype='multipart/form-data' style='margin: 0; margin-top: 1rem; padding: 0; display: inline-block;'>
                        
                        <p style='margin: 0; padding:0; text-align: center;'>
                            <label for='picbtn' class='profbtn upload' ><span class="material-symbols-outlined" style='vertical-align: bottom;'>upload_file</span>&nbsp;&nbsp;Upload Pic</label>
                            <input type='file' name='uploadimg' class='picbtn' id='picbtn' onchange='uploadFunc()'/>
                        </p>
                        <p style='margin: 0; margin-top: 2rem; padding:0; text-align: center;'><span id='file-selected'></span></p>
                        <p style='margin: 0; margin-top: 2rem; padding:0; text-align: center;'><input type='submit' name='sub-pic' class='profbtn upload-sub' id='upload-sub' value='Update'/></p>
                        </form>
                    </div>
                    <div class="prof-text">
                        <?php echo $loginErr; ?>
                        <h2><?php echo " " . $profRow['u_username']; ?></h2>
                        <h3><?php echo " " . $profRow['u_level']; ?></h3>
                        <p><?php echo $profRow['u_email'];  ?></p>
                        <p>
                            <a href="resetpassword.php"><span class="material-symbols-outlined" style='vertical-align: bottom;'>lock_reset</span>&nbsp;&nbsp;Reset Password</a>
                        </p>
                        <?php 
                            echo $write;
                            echo $tools;
                        ?>
                    </div>
            </div>
       </div>
        
       <script>
        //Loading function

        document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector("body").style.visibility = "hidden";
            document.querySelector("#loader").style.visibility = "visible";
        } else {
            document.querySelector("#loader").style.display = "none";
            document.querySelector("body").style.visibility = "visible";
        }
    };


        //Upload profile pic
        const uploadimg = document.getElementById('picbtn');
        const uploadsub = document.getElementById('upload-sub');

        function uploadFunc(event){

            if(uploadimg.value.length > 0){
                uploadsub.style.display = 'block';
                document.getElementById('file-selected').innerHTML = uploadimg.files[0].name;
            } else {
                uploadsub.style.display = 'none';
            }
        }

    </script>
    <script src="./scripts/navigation.js" defer></script>
        
    </body>
</html>