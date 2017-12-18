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
    displayAllParts();
        // DISPLAY CARS FUNCTION
    echo "<table align = 'center' border = 2 >";
    echo "<tr>";
    echo"<th><b>Part Id</b></th>";
    echo"<th><b>Part Name</b></th>";
    echo"<th><b>Part Type</b></th>";
    echo"<th><b>Price</b></th>";
    echo'</tr>';
    
    $display = displayAllParts();
    foreach($display as $d)
    {
        echo'<tr>';
        echo'<td>'.$d['partId'].'</td>';
        echo'<td>'.$d['partName'].'</td>';
        echo'<td>'.$d['partType'].'</td>';
        echo'<td>'.$d['price'].'</td>';
        echo'</tr>';
    }
    echo'</table>';
    // END DISPLAY CARS
    ?> 
    </body>
</html>
