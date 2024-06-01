<?php
SESSION_START();

include('../includes/config.php');


//push movies table into JSON object
include("../scripts/php-script.php");

//retrieve Movies object
$json_movie_data = file_get_contents("movie-data.json");

//convert movies object to array
$movies = json_decode($json_movie_data, JSON_OBJECT_AS_ARRAY);

//retrieve film makers/actors/etc.
$json_crew_data = file_get_contents("crew-data.json");
$filmmakers = json_decode($json_crew_data, JSON_OBJECT_AS_ARRAY);


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
        <div class="content-wrapper">
            <form action="addcrew.php" method="post">
                
                <table>

                    <tr>
                        <td colspan="2" align="center"><h1>Add Cast &amp; Crew</h1></td>
                    </tr>
                    
                    <tr>
                        <td><p id='text-test'></p></td>
                    </tr>
                    <tr class='movierow'>
                        <td><label for='searchmovie'><b>Search Movie:</b></label></td>
                        <td><input type='text' name='searchmovie' id='searchmovie' class='searchmovie' onkeyup='movieRes()'/></td>
                    </tr>

                    <tr class='moviedisplay'>
                        <td colspan='2' style='text-align: center;'>
                            <p id='movielist'></p>
                            <p id='movieinput'></p>
                            <p id='crewinput'>
                                <input type='hidden' name='crewid' />
                                <input type='hidden' name='crewrole' />
                            </p>
                        </td>
                    </tr>

                    <tr class='roleselect'>
                        <td>
                            <label for="role"><b>Select Role:  </b></label>
                        </td>
                        <td>
                            <select name='role' onchange='roleSelect()' id='role'>
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
                        <td colspan='2'>Can't find actor, director, producer, etc.? <a href="addmember.php" target="inewmember" onclick='openModal()'>Add Them here</a></td>
                    </tr>
                    <tr>
                        <td colspan='2'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan='2' style='padding: 40px;'>&nbsp;</td>
                    </tr>
                    <tr>

                        <td colspan='2'>
                            <input type='reset' name='reset' class='subbtn' />
                            <input type='submit' name='submit' id='submit' class='subbtn' value='Add Cast'/>
                        </td>
                    </tr>
                </table>

            </form>
            <div class='crew-display'>
                <h2 id='movietitle' style='text-align: center;'></h2>
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


<script defer>

//pass PHP arrays to Javascript objects

let movies = <?php echo json_encode($movies); ?>;
let crew = <?php echo json_encode($filmmakers); ?>;

console.log(crew);

//create array to be prepared for JSON
let crewObj = [];


</script>
        <script src="../scripts/admin.js" async defer></script>
    </body>
</html>