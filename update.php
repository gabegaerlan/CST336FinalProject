<?php
    session_start();
    if(!isset($_SESSION['username'])){
        
        header("Location: index.php");
    }
  include './database.php';
  $conn = getDatabaseConnection();
  
function getCarInfo() {
    global $conn;
    
    $sql = "SELECT * 
            FROM cars
            WHERE carId = " . $_GET['carId']; 
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // print_r($record);
    
    return $record;

}
    if(isset($_GET['updateCar'])){// checks whether admin has submitted form
    $conn = getDatabaseConnection();
    echo "Form has been submitted!";
    $sql = "UPDATE cars
            SET carName = :carName,
                carCompany = :carCompany,
                carType = :carType
            WHERE carId = :carId";
    $np = array();

    $np[':carId'] = $_GET['carId'];
    $np[':carName'] = $_GET['carName'];
    $np[':carCompany'] = $_GET['carCompany'];
    $np[':carType'] = $_GET['carType'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    
    
    
    echo"Record has been updated!";
    header("Location: delete.php");
    
}
if(isset($_GET['carId'])){
    $carInfo = getCarInfo();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Update Car </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        
        
        
        <span class="updatepage">
        <h3> <?php echo $_GET['carName'] ?></h3>
        <form method="GET">
            <input type="hidden" name="carId" value="<?=$carInfo['carId']?>"/>
            Car Name:<input type="text" name="carName" value="<?=$carInfo['carName']?>"/>
            <br>
            Car Company:<input type="text" name="carCompany" value="<?=$carInfo['carCompany']?>"/>
            <br>
            Car Type:<input type="text" name="carType" value="<?=$carInfo['carType']?>" />
            <br />

           </span>
            <br />
            </select>
            <input type="submit" value="Update Car" name="updateCar">
        </form>
        

    </body>
</html>