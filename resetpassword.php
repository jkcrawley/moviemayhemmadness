<?php
SESSION_START();

include 'includes/config.php';
include 'includes/sessions.php';




//Variables to alter content on user input.
$error = '';

$texttest = '';

$display = '';

$success = '';

//check if form has been submitted
if(isset($_POST['submit'])){

    //user inputs
    $currentPass = mysqli_escape_string($conn, $_POST['currentpass']);
    $newPass = mysqli_escape_string($conn, $_POST['newpass']);
    $conPass = mysqli_escape_string($conn, $_POST['confirmpass']);

    $resetSQL = "SELECT * FROM users WHERE u_id = " . $_SESSION['userid'];
    $resetResult = mysqli_query($conn, $resetSQL);
    $resetRow = mysqli_fetch_array($resetResult, MYSQLI_ASSOC);

    $SQLpass = $resetRow['u_password'];


    if(mysqli_num_rows($resetResult) == 1){

        //validate form
        if($_POST['newpass'] === $_POST['confirmpass'] && !empty($_POST['newpass']) && !empty($_POST['confirmpass'])){

            //verify current password
            if(password_verify($currentPass, $SQLpass)){
                $success = "<h2>Password verified</h2>";
            

                //hash new password
                $hashPass = password_hash($newPass, PASSWORD_BCRYPT);

                //update password
                $updateSQL = "UPDATE users SET u_password = ? WHERE u_id = " . $_SESSION['userid'];
                $updateStmt = $conn->prepare($updateSQL);
                $updateStmt->bind_param('s', $hashPass);
                $updateStmt->execute();

                $display = "style='display:none;'";
                $success = "<h3 style='padding: 0; margin: 0;'>Password has been updated!</h3><p style='margin: 0; padding: 0;'><a href='profile.php'>&larr; Back to Profile</a></p>";

            } else {
                $error = "<p style='color:red; margin: 0px; margin-top: 4rem;'>Current password is incorrect.</p>";
            }

        } else {
                
                //check if new password and confirmed password matches.
                if($_POST['newpass'] !== $_POST['confirmpass']){
                    $error = "<p style='color:red; margin: 0px;'>Passwords do not match.</p";
                }

                //check if either field was empty
                if(empty($_POST['newpass']) || empty($_POST['newpass'])){
                    $error = "<p style='color:red; margin: 0px;'>Empty fields.</p>";
                }

            }
        } else {
        $texttest = '<p>Nice try, but no cigar</p>';
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
        <div id="loader" class="center"></div>
        <div class="wrapper"'>
            <?php include "includes/main-nav.php"; ?>
            <div class="profile" style='display: flex; flex-direction: column; align-items: center;'>
                <h2 style='padding:0;'>Reset Password</h2>
                <?php echo $success; ?>
                <form  action='resetpassword.php' method='post'>
                <table <?php echo $display; ?>>
                    <tr>
                        <td colspan='2'><?php echo $texttest; ?></td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: center'><?php echo $error; ?></td>
                    </tr>
                    <tr>
                        <td><label for='currentpass'><b>Current Password:</b></label></td>
                        <td><input type='password' name='currentpass' /></td>
                    </tr>
                    <tr>
                        <td><label for='newpass'><b>New Password:</b></label></td>
                        <td><input type='password' name='newpass' /></td>
                    </tr>
                    <tr>
                        <td><label for='confirmpass'><b>Confirm Password:</b></label></td>
                        <td><input type='password' name='confirmpass' /></td>
                    </tr>
                    <tr>
                        <td colspan='2'><input type='submit' name='submit' class='profbtn' style='width: 100%; padding: .75rem 0rem; font-weight: bold;'/></td>
                    </tr>
                    </div>
                </table>
                </form>
            </div>
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
    <script src="./scripts/navigation.js" defer></script>
    </body>
</html>