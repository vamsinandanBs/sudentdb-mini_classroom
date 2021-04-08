<?php
    global $pdo;
    
    $dsn = "mysql: host=localhost; dbname=studentdb";
    try{
        $pdo = new PDO($dsn,'root....','********password');
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
   

   
?>
