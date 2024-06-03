<?php
SESSION_START();

if(isset($_POST)){
    $data = file_get_contents("php://input");

    file_put_contents('../json/movie-crew.json', $data);

    $crewObj = json_decode($data, true);

    try{
        $crewObj = json_decode($data);
        if($crewObj === false){
            throw new Exception('invalid json');
        }
    } catch (Exception $e){
        // Handle invalid JSON case
    }
}

?>