<?php
SESSION_START();

include('../includes/config.php');

$disErr = '';

if(isset($_POST['addbtn'])){
    $crewSQL = "SELECT * FROM crew_members;";
    $crewResult = mysqli_query($conn, $crewSQL);
    $checkrow = mysqli_fetch_array($crewResult, MYSQLI_ASSOC);

    $fname = mysqli_escape_string($conn, strtolower($_POST['fname']));
    $lname = mysqli_escape_string($conn, strtolower($_POST['lname']));
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));


//check if film maker already exists and all fields have been filled
    if($fname == $checkrow['cr_fname'] && $lname == $checkrow['cr_lname'] && $birthdate == $checkrow['cr_dob']){
        $disErr = "<tr><td colspan='2'><p style='background-color: red;'>Film maker already exists in database.</p></td></tr>";
    } else if (empty($fname) || empty($lname) || empty($birthdate)){
        $disErr = "<tr><td colspan='2'><p style='background-color:red;'>Missing Fields</p></td></tr>";
    } else {
        $insertSQL = "INSERT INTO crew_members (cr_fname, cr_lname, cr_dob) VALUES ('$fname', '$lname', '$birthdate');";

        if($conn->query($insertSQL) === TRUE){
            $disErr = "<tr><td colspan='2'><p><b>Film maker has been successfully added to database!</b></p></td></tr>";
        } else {
            echo "Error: " . $insertSQL . "<br />" , $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/admin.css">
        <style type="text/css">
            form{
                display: flex;
                justify-content: center;
                align-items: center;
            }

            table{
                margin-top: 65px;
            }

            td{
                padding: 10px;
            }
        </style>
    </head>
    <body>

            <form action='addmember.php' method='post'>
                <table>
                    <tr>
                        <td colspan="2" align="center"><h1>Add Film Maker</h1></td>
                    </tr>
                    <tr>
                        <td><b><label for="fname">First Name:  </label></b></td>
                        <td><input type='text' name='fname' id='fname' required /></td>
                    </tr>
                    <tr>
                        <td><b><label for="lname">Last Name:</label></td>
                        <td><input type='text' name='lname' id='lname' required /></td>
                    </tr>
                    <tr>
                        <td><b><label for='birthdate'>DOB:</label></b></td>
                        <td><input type='date' name='birthdate' id='birthdate' required /></td>
                    </tr>
<?php
echo $disErr;
?>

                    <tr>
                        <td colspan="2" align='right'><input type='submit' name='addbtn' value='Add Member' class='nextbtn' /></td>
                    </tr>
                </table>
            </form>
       </div>
       <script src="../scripts/admin.js" async defer></script>
    </body>
</html>