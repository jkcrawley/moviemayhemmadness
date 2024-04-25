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

<?php
$crewSQL = "SELECT * FROM crew_members";
$crewResult = mysqli_query($conn, $crewSQL);
?>

<script defer>
let crewArr = [];

<?php
while($crewRow= mysqli_fetch_array($crewResult, MYSQLI_ASSOC)){
   $c_id= $crewRow['cr_id'];
   $fname = $crewRow['cr_fname'];
   $lname = $crewRow['cr_lname'];
   $fullname = "<button style='padding: 6px; margin: 8px; width: auto;'>" . $fname . ' ' . $lname . '</button>';
?>
crewArr.push("<?php echo $fullname; ?>")


<?php
}
?>

console.log(crewArr);

function searchRes(){
    const filtered = crewArr.filter(v => v.includes(document.getElementById('crewname').value));

    console.log(filtered);

    if(filtered.length === 0 || document.getElementById('crewname').value == '' || document.getElementById('crewname').value == ' '){
        document.getElementById('crewSearch').innerHTML = "<i>No Results for </i>'" + document.getElementById('crewname').value + "'";
    } else {
        document.getElementById('crewSearch').innerHTML = filtered.join('<br />');
    }

    
}



</script>
    <body>
        <div class="content-wrapper">
            <form action="addcrew.php" method="post">
                <table>

                    <tr>
                        <td colspan="2" align="center"><h1>Add Cast &amp; Crew</h1></td>
                    </tr>
                    <tr>
                        <td><b><label for="role"><b>Select Role:  </b></label></td>
                        <td>
                            <select name='role'  onchange='roleSelect()' id='role'>
                                <option value=''>-</option>
                                <option value='director'>Director</option>
                                <option value='actor'>Actor</option>
                                <option value='producer'>Producer</option>
                                <option value='screenwriter'>ScreenWriter</option>
                            </select>
                        </td>
                    </tr>
                    <tr class='crewsection'>
                        <td><b><label for="fname">Search for Name:  </label></b></td>
                        <td><input type='text' name='crewname' id='crewname' onkeyup='searchRes()'/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p id='crewSearch'></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>&nbsp;</td>
                    </tr>
                    <tr class='crewsection'>
                        <td colspan='2'>Can't find actor, director, producer, etc.? <a href="addmember.php" target="inewmember" onclick='openModal()'>Add Them here</a>
                    </tr>
                    <tr>
                        <td colspan='2'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan='2' style='padding: 40px;'>&nbsp;</td>
                    </tr>
                    <tr>

                        <td><input type='button' class='backbtn' onclick="location.href='addmovie.php'" value='&larr; Back' /></td>
                        <td><input type='submit' class='nextbtn' value='Next &rarr;'/>
                    </tr>
                </table>
                <div class='crew-display'>

                </div>
            </form>
        </div>
        <div class="modal" id='modal'>
            <button id='modalbtn' onclick='closeModal(), location.reload()'>x</button>
            <iframe name='inewmember' id='inewmember' class='inewmember' title='New Member Window'></iframe>
        </div>
        <div class="overlay" onclick="closeModal(), location.reload()"></div>
        
        <script src="../scripts/admin.js" async defer></script>
    </body>
</html>