<?php
function getDatabaseConnection(){
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "b1c99a7d25e2bd";
    $password = "b61f939a";
    $dbname="heroku_35421d9ff40f5d6";

// Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
    
  }

function getMatchingID() {
    
    $carId = $_GET['carId']; 

    
     $conn = getDatabaseConnection(); 

     $sql = "SELECT * from cars WHERE carId='$carId'"; 
     
     $statement = $conn->prepare($sql); 
    
     $statement->execute(); 
     $records = $statement->fetchAll(); 
     echo json_encode($records); 
}


getMatchingID(); 

?>