<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <?php
        session_start();
        include'./database.php';
        $conn = getDatabaseConnection();
        
        function searchCars()
        {
            global $conn;
            $np = array();
            
            $sql = "SELECT carName, carType, carCompany
                    FROM cars
                    WHERE 1";
            if(isset($_GET['submit']))
            {
                if(isset($_GET['search']))
                {
                    $sql .=" AND carName LIKE :carName";
                    $np[':carName'] = "%".$_GET['search']."%";
                }
                if(isset($_GET['search']))
                {
                    $sql .=" AND carType LIKE :carType";
                    $np[':carType'] = "%".$_GET['search']."%";
                }
                if(isset($_GET['search']))
                {
                    $sql .=" AND carCompany LIKE :carCompany";
                    $np[':carCompany'] = "%".$_GET['search']."%";
                }
                
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute($np);
            $records = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $records;
            // foreach($records as $r)
            // {
                
            // }
        }
        ?>
    </body>
</html>