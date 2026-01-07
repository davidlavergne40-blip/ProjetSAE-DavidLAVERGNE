<?php

$host = 'localhost';        
$dbname = 'dbProjet'; 
$username = 'etudiant';    
$password = 'IsaNum1'; 

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
   
    die("<h3>Erreur de connexion :</h3> " . $e->getMessage());
}
?>