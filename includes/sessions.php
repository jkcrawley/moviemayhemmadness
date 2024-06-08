<?php

$loggedin ='';
$loggedout ='';

if(isset($_SESSION['userid'])){
    $loggedin = "style='display: inline-block;'";
    $loggedout = "style='display: none;'";
} else {
    $loggedin = "style='display: none;'";
    $loggedout = "style='display: table-cell;vertical-align: middle;'";
}

//logout menu
$tools = '';
$review = '';
$article = '';


//display links according to user level and privileges.

if(isset($_SESSION['userlevel'])){
    $userlevel = $_SESSION['userlevel'];

    if($userlevel == 'admin'){
        $tools = "<a href='admin/tools.php'>Admin Tools</a>";
        $review = "<a href='#'>Write Review</a>";
        $article = "<a href='#'>Write Article</a>";
    }

    if($userlevel == 'reviewer'){
        $tools = "";
        $review = "<a href='#'>Write Review</a>";
        $article = "<a href='#'>Write Article</a>";
    }
}

?>