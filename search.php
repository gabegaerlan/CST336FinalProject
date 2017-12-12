<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <?php
        include'./database.php';
        $conn = getDatabaseConnection();
        $sql = "SELECT * 
                FROM cars
                JOIN parts
                JOIN companies";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($_GET['sort'] == 'desc') {
            $sql .= " ORDER BY carName desc";
        }
        if ($_GET['sort'] == 'asc') {
            $sql .= " ORDER BY carName asc";
        }
        
        ?>
    </body>
</html>