<?php
session_start();   //starts or resumes a session

function loginProcess() {

    if (isset($_POST['loginForm'])) {  //checks if form has been submitted
    
        include './database.php';
        $conn = getDatabaseConnection();
      
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            
            $sql = "SELECT *
                    FROM users
                    WHERE username = :username 
                    AND   password = :password ";
            
            $namedParameters = array();
            $namedParameters[':username'] = $username;
            $namedParameters[':password'] = $password;

            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $record = $stmt->fetch();
            
            if (empty($record)) {
                
                echo "Incorrect Username or Password";
                
            } else {
                
               $_SESSION['username'] = $record['username'];
            //   $_SESSION['password'] = $record['password'];
               $_SESSION['adminName'] = $record['firstName'] . "  " . $record['lastName'];
               //echo $record['firstName'];
               header("Location: admin.php"); //redirecting to admin.php
                
            }
           // print_r($record);
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>ADMIN LOGIN</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            @import url("css/styles.css");
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
          <li><a href="#">Part</a></li>
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
      <!--<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
    </ul>
      </div>
    </nav>
    <!--End Navigation Bar--> 
   
    <!--ADMIN LOGIN-->
    <div class="admin-login">
     <h1> Admin Login </h1>
        
        <form method="post">
            
            Username: <input type="text" name="username"/> <br />
            
            Password: <input type="password" name="password" /> <br />
            
            <input type="submit" name="loginForm" value="Login!"/>
            
        </form>

        <br />
        
        <?=loginProcess()?>
        </div>
        <!--END ADMIN LOGIN-->
    </body>
</html>