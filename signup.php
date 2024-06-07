<?php
SESSION_START();

//connect to database
include 'includes/config.php';

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
        <title>Movie Mayhem Madness: Signup</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/stylesheet.css">
        <link rel="stylesheet" href="./css/signup-styles.css">
    </head>
    <body onload="clearFields()">

<?php



//empty error messages
$errorMessage = '';
$userMatch = '';
$userEmpty = '';
$emailMatch = '';
$emailErr = '';
$passwordEmpty = '';
$passwordMatch = '';

//input fields to toggle success or failure display
$toggleMessage = "<input type='hidden' id='checkPHP' value='failure' />";
$registerDisplay = 'flex';


//check  if form has been submitted
if(isset($_POST['submit'])){

//set variables
    $username = mysqli_escape_string($conn, $_POST['username']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $conpassword = mysqli_escape_string($conn, $_POST['confirm-password']);
    $newsletter = 'no';
    $request = 'no';

    if(isset($_POST['newsletter'])){
        $newsletter = $_POST['newsletter'];
    }
    
    if(isset($_POST['request'])){
        $request = $_POST['request'];
    }
    

//Check if user already exists
    $checkuser = "SELECT u_username, u_email FROM users WHERE u_username = '$username' OR u_email='$email'";
    $checkresult = mysqli_query($conn, $checkuser);
    $checkrow = mysqli_fetch_array($checkresult, MYSQLI_ASSOC);

    if(mysqli_num_rows($checkresult)){
    if($username == $checkrow['u_username'] || empty($username) || empty($email) || $email == $checkrow['u_email'] || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password) || $password != $conpassword){
        if($username == $checkrow['u_username']){
            $userMatch = "<li>Username already exists.</li>";
        }

        if(empty($username)){
            $userEmpty = "<li>Must enter a username.</li>";
        }

        if($email == $checkrow['u_email']){
            $emailMatch = "<li>That email is already in use.<br /><p><a href='forgotpassword.php'>Forgot login?</a></p></li>";
        }

        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "<li>Email is not valid.</li>";
        }

        if(empty($password)){
            $passwordEmpty = '<li>You must enter a password.</li>';
        }

        if($password != $conpassword){
            $passwordMatch = '<li>Passwords do not match.</li>';
        }

        $errorMessage = "<div class='php-error'><ul>". $userMatch . $emailMatch . $userEmpty . $emailErr . $passwordEmpty . $passwordMatch . "</ul></div>";



        
    }
} else {
//sql injection prevention
        $sqluser = mysqli_real_escape_string($conn, $username);
        $sqlpass = mysqli_real_escape_string($conn, $password);

//hash password
        $hashpass = password_hash($sqlpass, PASSWORD_BCRYPT);

        $insertUser = "INSERT INTO users (u_username, u_password, u_email, u_newsletter, u_level, u_request, u_pic) VALUES ('$sqluser', '$hashpass', '$email', '$newsletter', 'member', '$request', 'profile-imgs/empty-prof8735.png');";

        if($conn->query($insertUser) === TRUE){
            $_SESSION['username'] = $sqluser;

        //set input to success.
            $toggleMessage = "<input type='hidden' id='checkPHP' value='success' />";
            $signupSuccess = "<div id='success-message' class='success-message'><h2>Welcome $username!</h2><h3><a href='login.php'>Log in</a> to access your account features.</h3></div>";
            $registerDisplay = "style='display:none;'";
            echo $signupSuccess;
        } else {
            echo "Error: " . $insertUser . "<br />" , $conn->error;
        }
        


        
    }

}


?>

        <div id='register' class="register" <?php echo $registerDisplay ?> >
            <h2>Sign up to be a member of <span style="color: #aa0000; font-family: melmacracked; font-size: 28px;" class='mobile-heading'>Movie Mayhem Madness</span></h2>
            <p><b>Already a member?</b> <a href='login.php'>Login</a></p>
<?php
echo $errorMessage;
echo $toggleMessage;
?>
        <form action="signup.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="username"><h4>Username</h4></label><br />
                        <input type="text" name="username" placeholder="Your Desired Username" id="username" required />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="email"><h4>Email</h4></label><br />
                        <input type="email" name="email" id="email" autocomplete="new-email" placeholder="Email Address" required />
                        <div class="email-message" id="email-message">
                            <p id="email-error" class="invalid">Email must be valid</p>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="password"><h4>Password</h4></label><br />
                        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autocomplete="new-password" placeholder="Enter Password" required /><br />
                        <input type="checkbox" onclick="showPassword()" /> <i>Show Password</i>
                        <div class="password-message" id='password-message'>
                            <h4>Password must contain the following:</h4>
                            <p id='letter' class='invalid'>A <b>lowercase</b> letter</p>
                            <p id='capital' class='invalid'>A <b>capital (uppercase)</b> letter</p>
                            <p id='number' class='invalid'>A <b>number</b></p>
                            <p id='length' class='invalid'>Minimum <b>8 characters</b></p>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="confirm-password"><h4>Confirm Password</h4></label><br />
                        <input type="password" name="confirm-password" id="confirm-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm Your Password" required /><br />
                        <input type="checkbox" onclick="showConfirmPassword()" /> <i>Show Password Confirmation</i>
                        <div class="confirm-message" id="confirm-message">
                            <p id='passmatch' class='invalid'>Passwords must match</p>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="checkbox" name="newsletter" id="newsletter" value="yes" /><label for="newsletter"> <i>I'd like to recieve updates about new features</i></label>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <input type="checkbox" name="request" id="request" value="yes" /><label for="request"> <i>I'd like to review movies for Movie Mayhem Madness</i></label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" id="submit" />
                    </td>
                </tr>
            </table>
        </form>
        </div>
        
        <script src="./scripts/signup-scripts.js" async defer></script>
    </body>
</html>