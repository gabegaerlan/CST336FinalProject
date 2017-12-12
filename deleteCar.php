<?php
    include'./database.php';
    $conn = getDatabaseConnection();
    
    $sql = "DELETE FROM cars
            WHERE carId = ". $_GET['carId'];
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: delete.php");

?>