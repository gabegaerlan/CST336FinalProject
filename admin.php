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
        <title>Auto Mall</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            @import url("css/styles.css");
        </style>
        
        
        <!--JAVASCRIPT-->
        <script>
            function confirmDelete() 
            {
                return confirm("Are you sure you want to delete this user?");
            }
        </script>
        <!--JAVASCRIPT END-->
        
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
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
    </ul>
      </div>
    </nav>
    <!--End Navigation Bar-->
    
    <h2> Welcome <?=$_SESSION['adminName']?>!</h2>
    
    

    
    
    
    </body>
</html>


         
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
              color:white;
              font-family: 'Fugaz One', cursive;
              text-align:center;
            }
            
        </style>
    </head>
    <body>
            <h1>Admin Main</h1>

            
            <!--<form action="addUser.php">-->
                
            <!--    <input type="submit" value="Add New User" />-->
                
            <!--</form>-->
            
            <form action="addCar.php" class="addCar">
                <center><input type="submit" value="Add New Car" /></center>
            </form>

            <br />
          <?php
         include'display.php';
        //   $users = userList();
        //   foreach($users as $user) 
        //   {
        //         echo $user['id'] . "  " . $user['firstName'] . " " . $user['lastName'];
        //         //  echo "[<a href='updateUser.php?userId=".$user['id']."'> Update </a>] ";
        //         //  echo "[<a onclick='return confirmDelete()' href='deleteUser.php?userId=".$user['id']."'> Delete </a>] <br />";
        //   }
          displayAll();
         ?>
     
    </body>
</html>