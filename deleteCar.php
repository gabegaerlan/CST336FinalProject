<?php

    include './database.php';
    $conn = getDatabaseConnection();
    
    $sql = "DELETE FROM cars
            WHERE id = ". $_GET['carId'];
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");

?>