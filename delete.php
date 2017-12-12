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
            @import url('css/styles.css');
            .deletePage{
                text-align:center;
                font-family: 'Fugaz One', cursive;
            }
          body{
                background-image: url("/finalproject/img/typer.jpg");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center; 
            }
        </style>
        <script language="javascript">
            function confirmDelete() 
                {
                    return confirm("Are you sure you want to delete this user?");
                }

        </script>
    </head>
    <body>
        <title>ADMIN DELETE CAR</title>
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
    
    
    
            <?php
            session_start();
            
            if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
                header("Location: index.php");
            }
            include './database.php';
            
            function carList()
            {
                $conn = getDatabaseConnection();
                $sql = "SELECT *
                        FROM cars";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                return $records;
            }
            
            echo'<span class="deletePage">';
            
            $cars = carList();
            echo'<table>';
            echo'<tr>';
            echo'<th>ID</th>';
            echo'<th>Name</th>';
            echo'<th>Company</th>';
            echo'<th>Type</th>';
            echo'<th>Delete/Update</th>';
            echo'</tr>';
            
            foreach($cars as $c)
            {
                echo'<tr>';
                echo'<td>'.$c['carId'].'</td>';
                echo'<td>'.$c['carName'].'</td>';
                echo'<td>'.$c['carCompany'].'</td>';
                echo'<td>'.$c['carType'].'</td>';
                echo'<td>'."[<a onclick='return confirmDelete()' href='deleteCar.php?carId=".$c['carId']."'> Delete </a>]"."[<a href='update.php?carId=".$c['carId']."'>Update </a>] ".'</td>';
                // echo'<td>'.'"[<a href='update.php?carId=".$c['carId']."'> Update </a>] "'.'</td>';
                echo'</tr>';
                // echo $c['carId']." ".$c['carName']." ".$c['carCompany']." ".$c['carType'];
                // echo "[<a onclick='return confirmDelete()' href='deleteCar.php?carId=".$c['carId']."'> Delete </a>] <br />";
                
            }
            
            echo'</table>';
            echo'</span>';
                
            ?>
        </span>
    </body>
</html>


