<?php
SESSION_START();
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
        <title>MMM: Admins Tools</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/admin.css">
<?php

$toggleDisplay = '';

if($_SESSION['userlevel'] != 'admin'){
    $toggleDisplay = 'display: none;';
    echo "<div style='display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%;'><div style=\"background-image: url('../images/stop.png'); width: 200px; height: 200px; background-size: cover;\"></div>";
    echo "<h1>You do not have access to this area</h1></div>";
    echo "<span style='position: absolute; bottom: 15%; left: 40px; padding: 0;'><a href='../login.php' style='text-decoration: none;' ><span style='font-size: 1.4rem'>&#9666;</span> Back to Website</a></span>";
}

?>
    </head>
    <body>
        <main style='<?php echo $toggleDisplay ?> height: 100%;'>
        <nav>
            <ul>
                <li><a href='editmembers.php' target='iframe_content'>Edit Members</a></li>
                <li><a href='newsletter.php' target='iframe_content'>Send Newsletter</a></li>
                <li><a href='addmovie.php' target='iframe_content'>Add Movie</a></li>
                <li><a href='editmovie.php' target='iframe_content'>Edit Movie</a></li>
            </ul>

            <span style='position: absolute; bottom: 15%; left: 40px; padding: 0;'><a href='../login.php' class='backtosite'>Back to Website</a></span>
        </nav>

        <iframe name='iframe_content' id='iframe_content' class='tool-display' title='Tools Display'></iframe>

        </main>
        
        <script src="../scripts/admin.js" async defer></script>
    </body>
</html>