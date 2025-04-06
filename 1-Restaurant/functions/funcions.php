<?php

//TODO mirar aquests enllaços per entendre la connexió a BD
#https://www.youtube.com/watch?v=IcQdeghJHis&ab_channel=CodePH
#https://www.youtube.com/watch?v=QfSX6-my164&ab_channel=DigitalFox

//class funcions{

// $username="root";
// $password="mdb";
// $host="localhost";
// $database="restaurantDB";

// TODO POSAR COM A VARIABLES??????


function getConnexio(){

    $usuari="root";
    $password="mdb";
    $host="localhost";
    $database="restaurantDB";
    
    $connexio = new mysqli($host, $usuari, $password, $database);
    
    if($connexio->connect_errno != 0){
        
        die("Error al connectar amb la base de dades restaurant ".$connexio->connect_errno);
    }
    
    return $connexio;
}

                           
?>