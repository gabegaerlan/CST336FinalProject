<!DOCTYPE html>
<html>
    <head>
       <style>
           @import url("css/styles.css");
       </style> 
    </head>
    
    <body>
        <?php
include './database.php';
$conn = getDatabaseConnection();

// gets everything in cars
    function displayAll()
    {
      
        global $conn;
        
        $sql = "SELECT carName,carCompany,carType,partName,partType,price 
                FROM cars
                JOIN parts
                ORDER BY carName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
        echo "<table align = 'center' border = 2 >";
        echo "<tr>";
        echo"<th><b>Car Name</b></th>";
        echo"<th><b>Car Company</b></th>";
        echo"<th><b>Car Type</b></th>";
        echo"<th><b>Part Name</b></th>";
        echo"<th><b>Part Type</b></th>";
        echo"<th><b>Price</b></th>";
        echo'</tr>';
 
        $display = displayAll();
        foreach($display as $d)
        {
            echo'<tr>';
            echo'<td>'.$d['carName'].'</td>';
            echo'<td>'.$d['carCompany'].'</td>';
            echo'<td>'.$d['carType'].'</td>';
            echo'<td>'.$d['partName'].'</td>';
            echo'<td>'.$d['partType'].'</td>';
            echo'<td>'.$d['price'].'</td>';
            echo'</tr>';
            
            
        }
        echo'</table>';
    
?>
    </body>
</html>
