<?php
include './database.php';
$conn = getDatabaseConnection();

// gets everything in cars
    function carList(){
      
        global $conn;
        
        $sql = "SELECT carName,carCompany,carType 
                FROM cars
                ORDER BY carName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
// end cars


// once add car is clicked this adds another car
if (isset($_GET['addCar'])) {  //the add form has been submitted

    $sql = "INSERT INTO cars
             (carName, carCompany, carType, carId) 
             VALUES
             (:carName, :carCompany, :carType, :carId)";
    $np = array();
    
    
    $np[':carName'] = $_GET['carName'];
    $np[':carCompany'] = $_GET['carCompany'];
    $np[':carType'] = $_GET['carType'];
    $np[':carId'] = $_GET['carId'];
    
    $stmt=$conn->prepare($sql);
    $stmt->execute($np);
    
    echo "Car Was Added!";
    // add car end
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Add Car</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
    // using ajax to validate car id
        function validateCarId(){
            $.ajax({
                type: "get",
                url: "api.php",
                dataType: "json",
                data: {
                    'carId': $('#carId').val(),
                    'action': 'validate-carId'
                },
                success: function(data,status) {
                     $('#carId-valid').css("color", "black");
                    if ($('#carId').val()== data.val()) 
                    {
                        $('#carId-valid').html("ID IS NOT AVAILABLE"); 
                        $('#carId-valid').css("color", "red");
                    } else {
                        $('#carId-valid').html("CarId is available");
                    }
                    
                  },
                complete: function(data,status) { //optional, used for debugging purposes
                     //alert(status);
                }
            });
                }
    // end validate car id
    </script>
    </head>
    <body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Auto Mall</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="guest.php">Guest</a></li>
          <li><a href="carPage.php">Cars</a></li>
          <li><a href="partsPage.php">Parts</a></li>
          <li><a href="search.php">Search</a></li>
          
        </ul>
      <ul class="nav navbar-nav navbar-right">
      <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
      </div>
    </nav>
    <!--End Navigation Bar-->
    <div class="addCar">
            <h1> Adding New Car </h1>

    
            <form method="GET">
                Car Name <input type="text" name="carName" />
                <br />
                Car Company <input type="text" name="carCompany"/>
                <br/>
                Car Type <input type= "text" name ="carType"/>
                <br/>
                Car ID <input onchange="validateCarId();" type="number" id="carId" name="carId" min="1" max="255"/><span id="carId-valid"></span>
                <br />
                <input type="submit" value="Add Car" name="addCar">
            </form>
            <?php
            echo "<table align = 'center' border = 2 >";
            echo "<tr>";
            echo"<td><b>Name</b></td>";
            echo"<td><b>Company</b></td>";
            echo"<td><b>Type</b></td>";
            $car = carList();
            foreach($car as $c)
            {
                echo'<tr>';
                echo'<td>'.$c['carName'].'</td>';
                echo'<td>'.$c['carCompany'].'</td>';
                echo'<td>'.$c['carType'].'</td>';
                echo'</tr>';
                
                
            }
            echo'</table>';
            
            ?>
        </div>
    </body>
</html>