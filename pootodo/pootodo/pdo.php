<?php

try{
    $pdo = new PDO("mysql:dbname=tache;host=localhost",'root','');
    
    }
    catch(PDOException $e){
        echo "Erreur !:" . $e->getMessage() . "<br>";
        die();
    }


?>