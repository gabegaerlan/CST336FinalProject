<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <?php
include './database.php';
$conn = getDatabaseConnection();

// GETS ALL CARS IN DATABASE
    function displayAllCars()
    {
      
        global $conn;
        
        $sql = "SELECT * 
                FROM cars
                ORDER BY carId ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    // END FUNCTION
    
    // GETS ALL PARTS IN DATABASE
    function displayAllParts()
    {
        global $conn;
        
        $sql = "SELECT * 
                FROM parts
                ORDER BY partId ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    // END FUNCTION
    
    // DISPLAYS ALL CARS
    function getAllCars(){
        $records = displayAllCars();
        echo "<table align = 'center' border = 2 >";
        echo "<tr>";
        echo"<th><b>Car Id</b></th>";
        echo"<th><b>Car Name</b></th>";
        echo"<th><b>Car Company</b></th>";
        echo"<th><b>Car Type</b></th>";
        echo'</tr>';
 

        foreach($records as $d)
        {
            echo'<tr>';
            echo'<td>'.$d['carId'].'</td>';
            echo'<td>'.$d['carName'].'</td>';
            echo'<td>'.$d['carCompany'].'</td>';
            echo'<td>'.$d['carType'].'</td>';
            echo'</tr>';
        }
        echo'</table>';
        
    }
    
    
    // DISPLAYS ALL PARTS
    function getAllParts(){
        $records = displayAllParts();
        echo "<table align = 'center' border = 2 >";
        echo "<tr>";
        echo"<th><b>Part Name</b></th>";
        echo"<th><b>Part Type</b></th>";
        echo"<th><b>Price</b></th>";
        echo'</tr>';
 

        foreach($records as $d)
        {
            echo'<tr>';
            echo'<td>'.$d['partName'].'</td>';
            echo'<td>'.$d['partType'].'</td>';
            echo'<td>'.$d['price'].'</td>';
            echo'</tr>';
        }
        echo'</table>';        
    }

?>
    
    </body>
</html>
