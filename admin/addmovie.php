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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="../css/admin.css">
        

<?php



$toggleDisplay = '';


//check if user level exists and clear if it doesn't.
if(!isset($_SESSION['userlevel'])){
    $_SESSION['userlevel'] = '';
}

//display error if user doesn't have correct privileges
if($_SESSION['userlevel'] != 'admin'){
    $toggleDisplay = 'display: none;';
    echo "<div style='display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%;'><div style=\"background-image: url('../images/stop.png'); width: 200px; height: 200px; background-size: cover;\"></div>";
    echo "<h1>You do not have access to this area</h1></div>";
    echo "<span style='position: absolute; bottom: 15%; left: 40px; padding: 0;'><a href='../login.php' style='text-decoration: none;' ><span style='font-size: 1.4rem'>&#9666;</span> Back to Website</a></span>";
}




//create variable to store error messages
$errMessage = '';

//create variable to alter if upload is successful.
$successMessage = '';

//check form has been submitted
if(isset($_POST['submitmovie'])){

    //store user input in variables
    $title = mysqli_real_escape_string($conn, $_POST['title']);

    //create data for poster upload
    $filename = $_FILES["imgupload"]["name"];
    $tempname = $_FILES["imgupload"]["tmp_name"];
    $poster = "../posters/" . $filename;

    $releaseDate = date("Y-m-d", strtotime($_POST['release']));
    $runtime = mysqli_real_escape_string($conn, $_POST['runtime']);
    $budget = mysqli_real_escape_string($conn, $_POST['budget']);
    $boxoffice = mysqli_real_escape_string($conn, $_POST['boxoffice']);
    $premise = mysqli_real_escape_string($conn, $_POST['premise']);

    //check to see if movie already exists by comparing title and date
    $checkDB = "SELECT m_title, m_release FROM movies WHERE m_title = '$title' AND  m_release = '$releaseDate';";
    $checkResult = mysqli_query($conn, $checkDB);
    $checkrows = mysqli_fetch_array($checkResult, MYSQLI_ASSOC);

    

    //check for all empty fields
    if(empty($_POST['title']) || empty($filename) || empty($_POST['release']) || empty($_POST['runtime']) || empty($_POST['budget']) || empty($_POST['boxoffice']) || empty($_POST['premise'])){
        

        if(empty($_POST['title'])){
            $errMessage = '<b style="background-color: red;">You must enter title.</b>';
        }

        if(empty($filename)){
            $errMessage = "<b style='background-color: red;'>You haven't chosen a poster.</b>";
        }

        if(empty($_POST['runtime'])){
            $errMessage = "<b style='background-color: red;'>You must enter a run time.</b>";
        }

        if(empty($_POST['budget'])){
            $errMessage = "<b style='background-color: red;'>You must enter a budget.</b>";
        }

        if(empty($_POST['boxoffice'])){
            $errMessage = "<b style='background-color: red;'>You must enter a box office.</b>";
        }

        if(empty($_POST['premise'])){
            $errMessage = "<b style='background-color: red;'>You must enter a premise.</b>";
        } 

    }  elseif($checkrows > 0){
        $errMessage = "<b style='background-color: red;'>Movie already exists!</b>";
    } else {
        

        $insertSQL = "INSERT INTO movies (m_title, m_poster, m_release, m_runtime, m_budget, m_boxoffice, m_premise) VALUES ('$title', '$filename', '$releaseDate', $runtime, $budget, $boxoffice, '$premise');";

        if($conn->query($insertSQL) === TRUE){
            $toggleDisplay = "style = 'display: none;";

            $successMessage = "<div class='content-wrapper'><h2>Upload was successfull!</h2></div>";
        } else {
            echo "Error: " . $insertSQL . "<br />" , $conn->error;
        }

        if(move_uploaded_file($tempname, $poster)){
        } else {
            echo "<h3>Failed to upload image!</h3>";
        }

        

    }
}

?>

    </head>
    <body>
        <?php echo $successMessage; ?>
       <div class='content-wrapper' <?php $toggleDisplay; ?>>
       <form action='addmovie.php' method='post' enctype='multipart/form-data'>
        <table>
            <tr>
                <td colspan="2"><h1>Add Movie</h1></td>
            </tr>
            <tr>
                <td colspan="2"><ul style='background-color: red;'><?php echo $errMessage; ?></ul></td>
            </tr>
            <tr>
                <td><b>Title:</b></td>
                <td><input type='text' name='title' required/></td>
            </tr>
            <tr>
                <td colspan='2' style='padding: 48px 0px; text-align: center;'>
                    <label for='imgupload' class='imgupload'><i class="fa-solid fa-upload" style='margin-right: 8px;'></i>   Upload Poster</label>
                    <input type='file' accept='.jpg, .jpeg, .png' id='imgupload' name='imgupload' value='' required /><br />
                    <img src="#" alt="Preview Uploaded Image" id="file-preview" width='400px'>
                </td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><b>Release Date:</b></td>
                <td>
                    <input type='date' name='release' required/>
                </td>
            </tr>
            <tr>
                <td><b>Run-Time:</b></td>
                <td><input name='runtime' type='text' placeholder='Total minutes' required/></td>
            </tr>
            <tr>
                <td><b>Budget:</b></td>
                <td><input name='budget' type='text' placeholder='$0' required /></td>
            </tr>
            <tr>
                <td><b>Box Office:</b></td>
                <td><input name='boxoffice' type='text' placeholder='$0' required/></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td><b>Premise:</b></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><textarea style='width:400px; height: 100px;' name='premise' placeholder='Maximum 60 characters' required><?php if(isset($_SESSION['summary'])){ echo $_SESSION['summary']; }?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan='2' style='text-align: right;'>
                    <input type='submit' class='subbtn' name='submitmovie' value='Add Movie'/>
                </td>
            </tr>
        </table>
        </form>
       </div>
       <script src="../scripts/admin.js" async defer></script>
    </body>
</html>