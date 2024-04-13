<?php
SESSION_START();

include('../includes/config.php');

$userid = $_GET['userid'];
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
        <link rel="stylesheet" href="">
    </head>
    <body>
<?php
 
echo "<h1>Delete " . $userid . "</h1>";

$deleteQuery = "DELETE FROM users WHERE u_id = '$userid';";



if ($conn->query($deleteQuery) === TRUE) {
        header('Location: editmembers.php');
    } else {
    echo "Error updating record: " . $conn->error;
    echo $deleteQuery;
    }

?>

        
        <script src="" async defer></script>
    </body>
</html>