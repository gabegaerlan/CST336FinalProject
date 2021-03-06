<?php
session_start();

if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

function userList(){
  include './database.php';
  $conn = getDatabaseConnection();
 
  $sql = "SELECT *
          FROM users
          WHERE 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
  return $records;
}
?>
<!DOCTYPE html>
<html>
    <head>
      <title>AUTO MALL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
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
        <h2> Welcome <?=$_SESSION['adminName']?>!</h2>
      
      
      <div class="admin">
            <h1>Admin Main</h1>
            
            <form action="addCar.php" class="addCar">
                <center><input type="submit" value="Add New Car" /></center>
            </form>
            
            <form action="delete.php" class="deleteCar">
              <center><input type="submit" value="Update/Delete Car"/></center>
            </form>
            
            <form action="avg.php" class="deleteCar">
              <input type="submit" name="reports" value="Generate Reports"/>
            </form>
      </div>
            <br />
          <?php
          include'display.php';
          getAllCars();
          getAllParts();
                 
         ?>
     
    </body>
</html>