<?php
SESSION_START();

//connect to database
include 'includes/config.php';


//PHP Handler
require('sendemail.php');

//retrieve user input for email.
$email = '';
if(isset($_POST['email'])){
    $email = mysqli_escape_string($conn, $_POST['email']);
}

//empty variable to display if new password has been sent or if user email exists.
$toggle = '';

//variable to display errors
$header = '<h2>Forgot Password?</h2>';
$error ='';

//compare user input to sql
$sql = "SELECT * FROM users WHERE u_email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


if(isset($_POST['submit'])){

    if($result->num_rows > 0){
        $newpass = array();

        //generate random password
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+=-';
    
        $alphaLength = strlen($alphabet) - 1;

        for($i = 0; $i < 16; $i++){
            $n = rand(0, $alphaLength);
            $newpass[] = $alphabet[$n];
        }

        $randPass = implode($newpass);

        //hash new password for database
        $hashPass = password_hash($randPass, PASSWORD_BCRYPT);

        $updateSQL = "UPDATE users SET u_password = '$hashPass'";

        if($conn->query($updateSQL) == TRUE){
            $header = "<h2>Password has been sent!</h2><p>Be sure to check your junk mail if it is not found in your inbox.</p>";

            $username = $row['u_username'];

            $textbody = "<h1 style='font-family: melmacracked; font-size: 3rem;'>Movie Mayhem Madness</h1><p>You can <a href='https://www.jkcrawley.com/moviemayhemmadness/login.php' style='text-decoration: none; font-weight: bold; padding: .375rem .75rem; background-color: #00aa00; color: #ccc;'>Log in</a> with your new password and reset it from your profile page.</p><p><b>Username:</b> $username<br /><b>Your new password is:</b> $randPass</p>";
            sendMail($email, 'Your password has been reset', $textbody);

            $toggle = "style='display:none'";
        } else {
            $error = "<p style='background-color: red; color: white'>Something went wrong!</p>";
        }

    } else {
        $error = "<p style='background-color: red; color: white'>Email not found</p>";
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
        <title>Movie Mayhem Madness</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/stylesheet.css">
        <link rel="stylesheet" href="./css/login-styles.css">
        <style>
           html, body{ height: 100%;}

          

            .wrapper{
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .content{
                background-color: white;
                width: 67.5rem;
                padding: 4rem;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .content table{
                margin-top: 3rem;
            }

            input[type='text']{
                padding: .375rem .75rem;
            }
        </style>
    </head>
    <body>
        <div class='wrapper'>
            <div class='content'>
                <?php echo $header;
                echo $error; ?>
                <form action='forgotpassword.php' method='post' <?php echo $toggle; ?>>
                    <table>
                        <tr>
                            <td>
                                <label for='email'><h3>Enter email to recover username and password:</h3></label><br />
                                <input type='text' name='email' />
                            </td>
                        </tr>
                        <tr>
                            <td style='padding-top: 4rem;'>
                                <input type='submit' name='submit' value='Send Password' />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>