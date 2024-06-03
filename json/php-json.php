<?php

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if(mysqli_connect_error()){
    die("database connection failed: " . mysqli_connect_error());
} 

//movie data

$moviesSQL = "SELECT * FROM movies";
$movieResults = $conn->query($moviesSQL);

while($movie = $movieResults->fetch_assoc()){
    $movies[] = $movie;
}

$encoded_movies = json_encode($movies, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('../json/movies.json', $encoded_movies);


//crew data

$crewSQL = "SELECT * FROM crew_members";
$crewResults = $conn->query($crewSQL);

while($crew = $crewResults->fetch_assoc()){
    $crewMembers[] = $crew;
}

$encoded_crew = json_encode($crewMembers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('../json/crew-members.json', $encoded_crew);
?>