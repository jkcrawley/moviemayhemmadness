<?php
SESSION_START();

include('../includes/config.php');

$usersSQL = "SELECT * FROM users;";
if(isset($_POST['sort'])){

if($_POST['sort'] == 'showusers'){
    $usersSQL = "SELECT * from users;";
}

if($_POST['sort'] == 'username'){
    $usersSQL = "SELECT * from users ORDER BY u_username;";
}

if($_POST['sort'] == 'members'){
    $usersSQL = "SELECT * from users WHERE u_level = 'member';";
}

if($_POST['sort'] == 'reviewers'){
    $usersSQL = "SELECT * from users WHERE u_level = 'reviewer';";
}

if($_POST['sort'] == 'admins'){
    $usersSQL = "SELECT * from users WHERE u_level = 'admin';";
}

if($_POST['sort'] == 'suspended'){
    $usersSQL = "SELECT * from users WHERE u_level = 'suspended';";
}

if($_POST['sort'] == 'newsletter'){
    $usersSQL = "SELECT * from users WHERE u_newsletter = 'yes';";
}



if($_POST['sort'] == 'request'){
    $usersSQL = "SELECT * from users WHERE u_request = 'yes';";
}

}


$resultsDisplay = '';

if(!empty($_POST['search'])){
    $searchResults = mysqli_escape_string($conn, $_POST['search']);

    $usersSQL = "SELECT * FROM users WHERE u_username LIKE '%" . $searchResults . "%';";
    
    $resultsDisplay = "<h2 style='text-align: center;' >Search results for \"" . $_POST['search'] . "\"</h2>";

    $_POST['search'] = '';
    
}

$usersResult = mysqli_query($conn, $usersSQL) or die("Bad Query: $usersSQL");





//show all sql

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
        <script>
            let username = '';
            let userid = '';
        </script>
    </head>
    <body>
        <form action='editmembers.php' method='post'>
        <h1 style='margin-bottom: 80px;'>Edit Members</h1>
            <label for='sort' style='margin-left: 80px;'><b>Sort by:</b></label> 
            <div class='custom-select' <?php echo $toggleDisplay; ?>>
                <select name='sort' id='sort' onchange="this.form.submit();">
                    <option value='showusers' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'showusers'){echo "selected";}?>>Show All</option>
                    <option value='username' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'username'){echo "selected";}?>>Name</option>
                    <option value='members' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'members'){echo "selected";}?>>Only Members</option>
                    <option value='reviewers' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'reviewers'){echo "selected";}?>>Only Reviewers</option>
                    <option value='admins' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'admins'){echo "selected";}?>>Only Admins</option>
                    <option value='suspended' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'suspended'){echo "selected";}?>>Suspended</option>
                    <option value='newsletter' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'newsletter'){echo "selected";}?>>Subscribed to Newsletter</option>
                    <option value='request' <?php if(isset($_POST['sort']) && $_POST['sort'] == 'request'){echo "selected";}?>>Requests to be Reviewer</option>
                </select>
                <span class='custom-arrow'></span>
            </div>
            <p style='margin: 20px; margin-left: 80px;'><b>Search:</b>
            <input name='search' type='text' <?php if(isset($_POST['search'])){echo "value='" . $_POST['search'] . "'";}?> style='width: 210px; padding: .4rem 2rem .4rem .4rem;'/>
            <input type='submit' value='Go'  class='member-search'/>
            <?php echo $resultsDisplay; ?>
            </form>
        <div class="members-list">
            
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><b>User name</b></th>
                        <th><b>User level</b></th>
                        <th><b>Email</b></th>
                        <th><b>Newsletter</b></th>
                        <th><b>Level Request</b></th>
                    </tr>
                </thead>
                <tbody>
<?php


while($userRow = mysqli_fetch_array($usersResult, MYSQLI_ASSOC)){
    $u_id = $userRow['u_id'];
    $u_username = $userRow['u_username'];
    $u_email = $userRow['u_email'];
    $u_newsletter = $userRow['u_newsletter'];
    $u_level = $userRow['u_level'];
    $u_request = $userRow['u_request'];

?>

<script>
    


    function confirmDelete(username, userid){
        var ask=confirm(`Are you sure you want to delete ${username}?`);

        if(ask == true){
            window.location.assign(`deleteuser.php?userid=${userid}`);
        }
    }
</script>


<tr>
    <td>
        <a href='useredit.php?userid=<?php echo $u_id; ?>' class='editbtn'>Edit</a>
    </td>
    <td>
        <a href='' onclick="confirmDelete('<?php echo $u_username; ?>', '<?php echo $u_id; ?>')" class='editbtn'>Delete</button>
    </td>
   
    <td>
<?php
echo $u_username;

?>
    </td>
    <td>
<?php
echo $u_level;

?>

    </td>
    <td>
<?php
echo $u_email;

?>
    </td>
    <td>
<?php
echo $u_newsletter;

?>
    </td>
    <td>
<?php
echo $u_request;

?>
    </td>
</tr>
<?php

}

?>
                </tbody>
            </table>
        </div>
        <script src="../scripts/editmembers.js" async defer>

        </script>
    </body>
</html>