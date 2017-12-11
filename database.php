<!--mysql://b1c99a7d25e2bd:b61f939a@us-cdbr-iron-east-05.cleardb.net/heroku_35421d9ff40f5d6?reconnect=true-->

<!--
username: b1c99a7d25e2bd
password: b61f939a
host: us-cdbr-iron-east-05.cleardb.net
heroku_35421d9ff40f5d6
-->

<?php
function getDatabaseConnection(){
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "b1c99a7d25e2bd";
    $password = "b61f939a";
    $dbname="heroku_35421d9ff40f5d6";

// Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
    
  }

?>