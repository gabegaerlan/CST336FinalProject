<?php

// database connection
include './database.php';
$conn = getDatabaseConnection();

// display cars
function displayAllCars()
{
    global $conn;
    $sql = "SELECT *
            FROM cars
            ORDER BY carName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}

// display parts
function displayAllParts()
{
    global $conn;
    $sql = "SELECT *
            FROM parts
            ORDER BY partName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}


?>