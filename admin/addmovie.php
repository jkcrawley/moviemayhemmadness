<?php
SESSION_START();

include('../includes/config.php');


$errMessage = '';

$nextPg = '';

if(isset($_POST['nextBtn'])){
    $title = $_POST['title'];
    $releaseDate = date('Y-m-d', strtotime($_POST['release']));

    $mTitleSql = "SELECT * FROM movies WHERE m_title = '" . $title . "' AND m_release = '" . $releaseDate . "';";
    $mResult = mysqli_query($conn, $mTitleSql);
    
    if(mysqli_num_rows($mResult) > 0){
        $errMessage = "<p style='color:red;'>" . $title . " released on " . $releaseDate . " already exists.</p>";
    } else {
        $_SESSION['title'] = $title;
        $_SESSION['date'] = $releaseDate;
        $_SESSION['runtime'] = $_POST['runtime'];
        $_SESSION['summary'] = $_POST['summary'];

        echo "<script>window.location.href='addcrew.php';</script>";
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
        <link rel="stylesheet" href="../css/admin.css">
        
    </head>
    <body>
       <div class='content-wrapper' <?php $toggleDisplay; ?>>
       <form action='addmovie.php' method='post'>
        <table>
            <tr>
                <td colspan="2"><h1>Add Movie</h1></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $errMessage; ?></td>
            </tr>
            <tr>
                <td><b>Title:</b></td>
                <td><input type='text' name='title' value='<?php if(isset($_SESSION['title'])){echo $_SESSION['title'];} ?>' required/></td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><b>Release Date:</b></td>
                <td>
                    <input type='date' name='release' value='<?php if(isset($_SESSION['date'])){echo $_SESSION['date'];} ?>' required/>
                </td>
            </tr>
            <tr>
                <td><b>Run-Time</b></td>
                <td><input name='runtime' type='text' placeholder='Total minutes' value='<?php if(isset($_SESSION['runtime'])){echo $_SESSION['runtime'];} ?>' required/></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td><b>Summary:</b></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><textarea style='width:400px; height: 100px;' name='summary' placeholder='Maximum 60 characters' required><?php if(isset($_SESSION['summary'])){ echo $_SESSION['summary']; }?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan='2' style='text-align: right;'>
                    <input type='submit' id='next' name='nextBtn' class='nextbtn' value='Next &rarr;'/>
                </td>
            </tr>
        </table>
        </form>
       </div>
    </body>
</html>