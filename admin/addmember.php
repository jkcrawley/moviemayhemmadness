<?php
SESSION_START();

include('../includes/config.php');

$disErr = '';

if(isset($_POST['addbtn'])){

    $fname = mysqli_escape_string($conn, strtolower($_POST['fname']));
    $lname = mysqli_escape_string($conn, strtolower($_POST['lname']));
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));

    $crewSQL = "SELECT * FROM crew_members WHERE cr_fname = '$fname' AND cr_lname = '$lname' AND cr_dob = '$birthdate'";
    $crewResult = $conn->query($crewSQL);
    $checkrow = mysqli_fetch_array($crewResult, MYSQLI_ASSOC);


//check if film maker already exists and all fields have been filled
    if($checkrow['cr_fname'] == $fname && $checkrow['cr_lname'] == $lname && $checkrow['cr_dob'] == $birthdate){
        $disErr = "<tr><td colspan='2'><p style='background-color: red;'>Film maker already exists in database.</p></td></tr>";
    } else if (empty($fname) || empty($lname) || empty($birthdate)){
        $disErr = "<tr><td colspan='2'><p style='background-color:red;'>Missing Fields</p></td></tr>";
    } else {
        $insertSQL = "INSERT INTO crew_members (cr_fname, cr_lname, cr_dob) VALUES ('$fname', '$lname', '$birthdate');";
        

        if($conn->query($insertSQL) === TRUE){
            $disErr = "<tr><td colspan='2'><p><b>Film maker has been successfully added to database!</b></p></td></tr>";

            $jsonSql = "SELECT * FROM crew_members WHERE cr_fname = '$fname' AND cr_lname = '$lname' AND cr_dob = '$birthdate'";
            $result = $conn -> query($jsonSql);

            $row = $result -> fetch_assoc();

            $crewJson = file_get_contents("../json/crew-members.json");
            $crewArr = json_decode($crewJson, JSON_OBJECT_AS_ARRAY);

            $crewArr[] = array('cr_id' => $row['cr_id'], 'cr_fname' => $row['cr_fname'], 'cr_lname' => $row['cr_lname'], 'cr_dob' => $row['cr_dob']);

            $encoded_crew = json_encode($crewArr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents('../json/crew-members.json', $encoded_crew);
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