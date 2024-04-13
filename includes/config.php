<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "cinema";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if(mysqli_connect_error()){
    die("database connection failed: " . mysqli_connect_error());
} 


//PHP Handler

define('MAILHOST', "smtp.gmail.com");

define('USERNAME', "jcrawl6554@gmail.com");

define('PASSWORD', "zegdgovrsqgjelce");

define('SEND_FROM', "jcrawl6554@gmail.com");

define('SEND_FROM_NAME', "Movie Mayhem Madness");

define('REPLY_TO', 'jcrawl6554@gmail.com');

define('REPLY_TO_NAME', "James");


?>