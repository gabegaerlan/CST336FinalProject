<!DOCTYPE html>
<html>
    <head>
        <title>Auto Mall</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
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
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
      </div>
    </nav>
    <!--End Navigation Bar-->
        
       <?php
        include'./functions.php';
        displayAllCars();
            // DISPLAY CARS FUNCTION
        echo "<table align = 'center' border = 2 >";
        echo "<tr>";
        echo"<th><b>Car Id</b></th>";
        echo"<th><b>Car Name</b></th>";
        echo"<th><b>Car Company</b></th>";
        echo"<th><b>Car Type</b></th>";
        echo'</tr>';
     
        $display = displayAllCars();
        foreach($display as $d)
        {
            echo'<tr>';
            echo'<td>'.$d['carId'].'</td>';
            echo'<td>'.$d['carName'].'</td>';
            echo'<td>'.$d['carCompany'].'</td>';
            echo'<td>'.$d['carType'].'</td>';
            echo'</tr>';
        }
        echo'</table>';
        // END DISPLAY CARS
        ?> 
    </body>

</html>
