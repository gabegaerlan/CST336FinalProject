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
    
    echo "$sql";
    
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
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Fugo+One" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
    
    <style>
        @import url('css/styles.css');
    </style>
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
          <li><a href="#">Cars</a></li>
          <li><a href="#">Parts</a></li>
        </ul>
        <form class="navbar-form navbar-left" action="/action_page.php">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </form>
      <ul class="nav navbar-nav navbar-right">
      <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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