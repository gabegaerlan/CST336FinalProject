<?php
session_start();
include 'database.php';
$conn = getDatabaseConnection();

function getAllTypes() {
    global $conn;
    $sql = "SELECT DISTINCT carType 
            FROM cars";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $classes = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($classes as $cl) {
      echo "<option value='" . $cl['carType'] . "'>" . $cl['carType'] . "</option>";
    }
}

function getCars() {
    global $conn;
    $namedParameters = array();
    
    $sql = "SELECT carName, carType, carCompany
            FROM cars 
            WHERE 1"; 
    if(isset($_GET['submit'])) {
        if (isset($_GET['search'])) {
            $sql .= " AND carName LIKE :carName";
            $namedParameters[':carName'] = "%" . $_GET['search'] . "%";
        }
        if (isset($_GET['cartype'])) {
            $sql .= " AND carType = :carType ";
            $namedParameters[':carType'] = $_GET['cartype'];
        }
        // if (isset($_GET['cartype'])) {
        //     $sql .= " AND carCompany = :carCompany ";
        //     $namedParameters[':carCompany'] = $_GET['cartype'];
        // }

        if ($_GET['sort'] == 'desc') {
            $sql .= " ORDER BY carName desc";
        }
        if ($_GET['sort'] == 'asc') {
            $sql .= " ORDER BY carName asc";
        }
    }
            
    
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($records as $r) {
        echo "<div class='cars'>";
        echo    "<details>";
        echo        "<summary>" . $r['carName'] . "</summary>";
        echo        "<p> Type: " . $r['carType'] . "</p>";
        echo        "<p> Company: " . $r['carCompany'] . "</p>";
        // echo        "<form action='addToCart.php' method='GET'>";
        echo            "<input type='hidden' name='val' value='".$r['carName']."'>";
        // echo            "<input type='submit' value='Add to cart' style='position:relative; top:-10px'>";
        echo        "</form>";
        echo    "</details>";
        echo "</div>";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Auto Mall</title>
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
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
      </div>
    </nav>
    <!--End Navigation Bar-->
    
 <h1>Car List</h1>
        <!--<a href="checkout.php">Shopping Cart</a>-->
        <form method="GET">
            <fieldset style='border-radius:35px;
                             width:300px;
                             margin: 0 auto;'>
            <select name="cartype">
                <option disabled selected value value>Choose a type</option>
                <?=getAllTypes()?>
            </select></br>

            Sort Products By:</br>
            <select name="sort">
                <option value="desc">Descending</option>
                <option value="asc" selected>Ascending</option>
            </select>
            <br>

            <!--<input type="radio" name="sort" value="desc" > Descending </br>-->
            <!--<input type="radio" name="sort" value="asc" checked> Ascending </br></br>-->
            <input type="submit" name="submit" value="Search!">
            </fieldset>        
        </form>
        <center><?=getCars()?></center>    
    </body>
</html>