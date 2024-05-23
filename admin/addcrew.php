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

//display results for film makers in database.
while($crewRow= mysqli_fetch_array($crewResult, MYSQLI_ASSOC)){
   $c_id= $crewRow['cr_id'];
   $fname = $crewRow['cr_fname'];
   $lname = $crewRow['cr_lname'];
   $fullname = $fname . ' ' . $lname;
?>
crewArr.push(["<?php echo $c_id; ?>", "<?php echo $fullname; ?>"]);




<?php
}


?>

//show and add crew to array

function showCrew(){
    const crewDis = document.querySelector('.crew-display');
    let crewSection = document.querySelectorAll('.crewsection');
    
    for(let i = 0; i < crewSection.length; i++){
        crewSection[i].style.display = 'none';
    } 
    document.getElementById('crewSearch').innerHTML = '';
    crewDis.style.display = 'block';
    document.getElementById('role').value = '';
    document.getElementById('crewname').value = '';
}


<?php

//populate added crew

if(isset($_POST['addcrew'])){

}


?>

console.log(crewArr);





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
                        <td><input type='button' class='nextbtn' value='Next &rarr;'/>
                    </tr>
                </table>

            </form>
            <div class='crew-display'>
                <div class="crew-roles directors">
                    <h3>Directors</h3>
                    <ul id='directors-list'></ul>
                </div>
                <div class="crew-roles actors">
                    <h3>Actors</h3>
                    <ul id='actors-list'></ul>
                </div>
                <div class="crew-roles producers">
                    <h3>Producers</h3>
                    <ul id='producers-list'></ul>
                </div>
                <div class="crew-roles screenwriters">
                    <h3>Screenwriters</h3>
                    <ul id='screenwriters-list'></ul>
                </div>
            </div>
        </div>
        <div class="modal" id='modal'>
            <button id='modalbtn' onclick='closeModal(), location.reload()'>x</button>
            <iframe name='inewmember' id='inewmember' class='inewmember' title='New Member Window'></iframe>
        </div>
        <div class="overlay" onclick="closeModal(), location.reload()"></div>
        
        <script src="../scripts/admin.js" async defer></script>
    </body>
</html>