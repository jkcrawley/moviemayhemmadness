<?php
SESSION_START();

include('../includes/config.php');


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
       <div class='content-wrapper' <?php $toggleDisplay; ?>>
        <table>
            <tr>
                <td colspan="2"><h1>Add Movie</h1></td>
            </tr>
            <tr>
                <td><b>Title:</b></td>
                <td><input type='text' name='title' /></td>
            </tr>
        </table>
       </div>
        <script src="" async defer></script>
    </body>
</html>