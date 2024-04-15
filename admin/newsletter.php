<?php
SESSION_START();

include('../includes/config.php');

//PHP Handler
require('sendemail.php');

//form handling

//get users emails
$usersSQL = "SELECT u_email FROM users WHERE u_newsletter = 'yes'";
$usersResult = mysqli_query($conn, $usersSQL) or die("Bad Query: $usersSQL");


//error messages
$subjectErr = '';
$bodyErr = '';

$display = '';

//check if form has been submitted
if(isset($_POST['submit'])){
    $subject = $_POST['subject'];
    $textbody = $_POST['textbody'];

    if(empty($subject) || empty($textbody)){
        if(empty($subject)){
            $subjectErr = '<li>Subject is required</li>';
        }
    
        if(empty($subject)){
            $bodyErr = '<li>Body is required</li>';
        }

        

    } else {
        while($userRow = mysqli_fetch_array($usersResult, MYSQLI_ASSOC)){
            $userRow = $userRow['u_email'];

            $response = sendMail($userRow, $subject, $textbody);
        }
    }
}


$toggleDisplay = '';

if($_SESSION['userlevel'] != 'admin'){
    $toggleDisplay = 'display: none;';
    echo "<div style='display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%;'><div style=\"background-image: url('../images/stop.png'); width: 200px; height: 200px; background-size: cover;\"></div>";
    echo "<h1>You do not have access to this area</h1></div>";
    echo "<span style='position: absolute; bottom: 15%; left: 40px; padding: 0;'><a href='../login.php' style='text-decoration: none;' ><span style='font-size: 1.4rem'>&#9666;</span> Back to Website</a></span>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/admin.css">
        
        <script src="../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script>

            
            tinymce.init({
                selector: '#textbody',
                plugins : 'allychecker image formatpainter media',
		        toolbar : 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image | media',
                license_key: 'gpl',
                images_upload_url : 'upload.php',
                automatic_uploads: true,

                relative_urls : false,
                remove_script_host : false,
                convert_urls : true,
                
            });
        </script>

    </head>
    <body>
        
        
        <div class='content-wrapper' <?php echo $toggleDisplay; ?>>
            
            <form action='newsletter.php' method='post'>
            <?php

if(@$response == "success"){
    $formStyle = "style='display: none;'";
    ?>
    <p style='text-align: center; margin:0 auto; padding: 0px;'><b>Email Successfully sent!</b></p>
    <?php
} else {
    $formStyle = "style='display: block;'";
    ?>
    <p><?php echo @$response; ?></p>
    <?php
}

?>
    
                <table>
                    <tr><td colspan='2'><h1 style='margin-top: 0px;'>Send Newsletter</h1><?php echo "<ul>" . $subjectErr . $bodyErr . "</ul>"?></td>
                    <tr>
                        <td style='text-align: left'><label for='subject'><h4 style='display: inline'>Subject:</h4></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='subject' maxlength='60' /><br /><i>Maximum Characters: 60</i>
                    </tr>
                    <tr>
                        <td colspan='2' style='padding: 20px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan='2'><label for='body'><h4>Body:</h4></td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <textarea name='textbody' id='textbody'>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style='padding: 40px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan='2'><button name='submit' type='submit'>Send Email</button></td>
                    </tr>
                </table>
            </form>
        </div>
        <script src="" async defer></script>
    </body>
</html>
