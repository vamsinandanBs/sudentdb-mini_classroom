<?php
    global $pdo;
    
    $dsn = "mysql: host=localhost; dbname=studentdb";
    try{
        $pdo = new PDO($dsn,'root','142840');
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
   

   
?>