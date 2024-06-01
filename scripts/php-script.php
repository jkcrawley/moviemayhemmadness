<?php

//movie data

$moviesSQL = "SELECT * FROM movies";
$movieResults = $conn->query($moviesSQL);

while($movie = $movieResults->fetch_assoc()){
    $movies[] = $movie;
}

$encoded_movies = json_encode($movies, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('movie-data.json', $encoded_movies);


//crew data

$crewSQL = "SELECT * FROM crew_members";
$crewResults = $conn->query($crewSQL);

while($crew = $crewResults->fetch_assoc()){
    $crewMembers[] = $crew;
}

$encoded_crew = json_encode($crewMembers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('crew-data.json', $encoded_crew);
?>