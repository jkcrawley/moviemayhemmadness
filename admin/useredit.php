<?php
SESSION_START();
$userid = $_GET['userid'];

include('../includes/config.php');

if(isset($_POST['updatelevel'])){
    $updatedRole = $_POST['updatelevel'];
    $updateSQL = "UPDATE users SET u_level = '$updatedRole', u_request = 'no' WHERE u_id = '$userid';";

    if ($conn->query($updateSQL) === TRUE) {
      } else {
        echo "Error updating record: " . $conn->error;
      }
}

if(isset($_POST['updateNewsletter'])){
    $updatedNews = $_POST['updateNewsletter'];
    $updateQuery = "UPDATE users SET u_newsletter = '$updatedNews' WHERE u_id = '$userid';";

    if ($conn->query($updateQuery) === TRUE) {
      } else {
        echo "Error updating record: " . $conn->error;
        echo $updateQuery;
      }
}


$userSQL = "SELECT * FROM users WHERE u_id = '$userid' LIMIT 1;";
$userResult = mysqli_query($conn, $userSQL) or die("Bad query:$userSQL");


$toggleDisplay = '';

if($_SESSION['userlevel'] != 'admin'){
    $toggleDisplay = 'display: none;';
    echo "<div style='display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%;'><div style=\"background-image: url('../images/stop.png'); width: 200px; height: 200px; background-size: cover;\"></div>";
    echo "<h1>You do not have access to this area</h1></div>";
    echo "<span style='position: absolute; bottom: 15%; left: 40px; padding: 0;'><a href='../login.php' style='text-decoration: none;' ><span style='font-size: 1.4rem'>&#9666;</span> Back to Website</a></span>";
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
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class='content-wrapper' <?php $toggleDisply; ?>>
        <table>
            
<?php

while($row = mysqli_fetch_array($userResult, MYSQLI_ASSOC)){
?>
<tr>
    <td colspan='2'><h1><?php echo $row['u_username']; ?></h1></td>
</tr>
<?php
echo "<tr><td><b>Username:</b></td><td>" . $row['u_username'] . "</td></tr>";
echo "<tr><td><b>Email:</b></td><td>" . $row['u_email'] . "</td></tr>";
echo "<tr><td><b>User Level:</b></td><td>" . $row['u_level'] . "</td></tr>";
echo "<tr><td><b>Request to be Reviewer:</b></td><td>" . $row['u_request'] . "</td></tr>";
?>

<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<form name='updateuser' method='post' action='useredit.php?userid=<?php echo $userid; ?>'>
        <tr>
            <td><b>Update Level:</b></td>
            <td>
            <select name='updatelevel' onchange="this.form.submit();">
                <option value='suspended' <?php if($row['u_level'] == 'suspended'){ echo "selected"; }?>>Suspended</option>
                <option value='member' <?php if($row['u_level'] == 'member'){ echo "selected"; }?>>Member</option>
                <option value='reviewer' <?php if($row['u_level'] == 'reviewer'){ echo "selected"; }?>>Reviewer</option>
                <option value='admin' <?php if($row['u_level'] == 'admin'){ echo "selected"; }?>>Admin</option>
            </select>
            </td>
        </tr>
        <tr>
            <td colspan='2'>&nbsp;</td>
        </tr>
        
<?php
echo "<tr><td><b>Newsletter:</b></td><td>" . $row['u_newsletter'] . "</td></tr>";
?>

<tr>
        <td></td>
        <td>
            <select name='updateNewsletter' onchange="this.form.submit();">
                <option value='yes' <?php if($row['u_newsletter'] == 'yes'){ echo "selected"; }?>>Yes</option>
                <option value="no" <?php if($row['u_newsletter'] == 'no'){ echo "selected"; }?>>No</option>
            </select>
         </td>
    </tr>
</form>

<?php

}


?>
           
            <tr>
                <td colspan='2' style='padding: 80px;'>&nbsp;</td>
            </tr>
            <tr>
                <td colspan='2' style='text-align: center;'><a href='editmembers.php'><button>Finished</button></a></td>
            </tr>
        </table>
        </div>
        <script src="" async defer></script>
    </body>
</html>