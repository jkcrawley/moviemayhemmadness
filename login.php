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
        <title>Movie Mayhem Madness: Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/stylesheet.css">
        <link rel="stylesheet" href="./css/login-styles.css">
    </head>

<?php
$loginToggle = '';


//Error message
$errorMessage = '';

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //find username and password in SQL database
    $sqlLogin = "SELECT u_id, u_username, u_password, u_level FROM users WHERE u_username = '$username'";
    $logResult = mysqli_query($conn, $sqlLogin);
    $logRow = mysqli_fetch_array($logResult, MYSQLI_ASSOC);

    //get hashed password from database
    $hashPass = $logRow['u_password'];

    //return rows containing given username
    $count = mysqli_num_rows($logResult);

    $checkPassword = '';
    if($count == 1){

        

        if(password_verify($password, $hashPass)){
            $_SESSION['username'] = $logRow['u_username'];
            $_SESSION['userlevel'] = $logRow['u_level'];
            $_SESSION['userid'] = $logRow['u_id'];

            $sessionUser = $_SESSION['username'];
            $sessionLevel = $_SESSION['userlevel'];

            $loginToggle = "style='display: none;'";

            $memberTools = '';

            if($sessionLevel == 'admin'){
                $memberTools = '/admin/tools.php';
            }

            if($sessionLevel == 'member'){
                $memberTools = '/member/tools.php';
            }

            echo "<div class='logsuccess'><h2>Welcome $sessionUser</h2><p><b>Go to your <a href='.$memberTools'>$sessionLevel</a> page</b></p></div>";
        } else {
            $checkPassword = "<li>Password is invalid</li>";
            $errorMessage = "<div class='error-message'><ul>$checkPassword</ul></div>";
        }
    } else {
        $checkUser = '';


        if($username != $logRow['username']){
            $checkUser = '<li>Username does not exist</li>';
        }


        $errorMessage = "<div class='error-message'><ul>$checkUser</ul></div>";
    }


}

?>
    <body>
        <div class='login' id='login' <?php echo $loginToggle; ?>>
            <h2>Login</h2>
            <p><b>Don't have an account?</b> <a href='signup.php'>Sign up here.</a></p>
<?php
echo $errorMessage;
?>

            <form id='login-form' action="login.php" method="post">
                <table>
                    <tr>
                        <td>
                            <label for='username'><h4>Username</h4></label><br />
                            <input type='text' name='username' id='username' placeholder='Enter Username' required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for='password'><h4>Password</h4></label><br />
                            <input type='password' name='password' id='password' placeholder='Enter Password' required />
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

        
        <script src="" async defer></script>
    </body>
</html>