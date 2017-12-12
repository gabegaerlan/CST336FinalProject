<!DOCTYPE html>
<html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            @import url("css/styles.css");
            h1{
              color:black;
              font-family: 'Fugaz One', cursive;
              text-align:center;
            }
            body{
                text-align: center;
            }
            .generatedReports{
                font-size:3em;
                color:black;
                font-family: 'Fugaz One', cursive;
                
            }
            
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
          <li class="active"><a href="admin.php">Home</a></li>
          <li><a href="carPage.php">Cars</a></li>
          <li><a href="partsPage.php">Parts</a></li>
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
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
    </ul>
      </div>
    </nav>
    <!--End Navigation Bar-->  
    
    <span class="generatedReports">
        <?php
            session_start();
            if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
                header("Location: index.php");
            }
            
            include'./database.php';
            function avgPrice() {
                $conn = getDatabaseConnection();
                $sql = "SELECT AVG(price) AS p
                        FROM parts";
                        
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                           
                return $records;
                // print_r($records);
            }
            function numOfCars() {
                $conn = getDatabaseConnection();
                $sql = "SELECT COUNT(carName) AS c 
                        FROM cars";
                
                //echo $sql;
                            
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                //print_r($records);
                           
                return $records;
            }
            function numOfCarParts(){
                    $conn = getDatabaseConnection();
                $sql = "SELECT COUNT(partName) AS pa 
                        FROM parts";
                
                //echo $sql;
                            
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                //print_r($records);
                           
                return $records;
            }
            
                if(isset($_GET['reports'])){
                echo "Number Of Cars In Shop: ";
                $amount = numOfCars();
                echo $amount[0][c];
                echo '<br>';
                echo "Average Price of All Car Parts: ";
                $price = avgPrice();
                echo $price[0][p];
                echo '<br>';
                echo "Number Of Car Parts In Stock: ";
                $parts = numOfCarParts();
                echo $parts[0][pa];
                echo'<br>';
                }
        ?>
        </span>
    </body>
</html>
