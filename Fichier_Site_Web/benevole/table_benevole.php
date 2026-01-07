<?php

require '../connexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = ($_POST['nom_benevole']);
    $email = ($_POST['email_benevole']);
    $dispo = ($_POST['dispo_benevole']);
    $motivation = ($_POST['motivation']);

    try {
        
        $checkSql = "SELECT id FROM benevole WHERE email = :email"; 
        $stmtCheck = $pdo->prepare($checkSql);
        $stmtCheck->execute([':email' => $email]); 

        if ($stmtCheck->rowCount() > 0) {
            
            echo "Attention : Cette adresse email est déjà inscrite !";
        } 
        else {
        
        $pdo->beginTransaction();

        $sql = "INSERT INTO benevole (nom, email, dispo, motivation) 
                VALUES (:nom, :email, :disp, :motiv)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':disp' => $dispo,
            ':motiv' => $motivation,
        ]);
        
      
        $pdo->commit();
        
        ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SchoolHelp - Accueil</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <header>
        <div class="logo-container">
            <img src="../images/img3.png" alt="Logo SchoolHelp"> 
        </div>
        <h1>SchoolHelp</h1>
        <nav>
            <ul>
                <li><a href="../index.htm">Accueil</a></li>
                <li><a href="./benevole.htm">Bénévoles</a></li>
                <li><a href="../ONG/ong.htm">ONGs</a></li>
                <li><a href="../DemandeAide/help.php">Demande d'aide</a></li>
                <li><a href="../contact.htm">Contactez-nous</a></li>
            </ul>
        </nav>
    </header>
    <div style="padding: 30px" class="hero-text">
    <h1>Inscription réussie !</h1><p>Le profil du bénévole a bien été enregistré. Nous vous recontacterons par mail pour finaliser votre inscription, puis pour vous recommander des ONG.</p>
    </div>
    <a style="padding: 30px" href='../index.htm'>Retour à l'accueil</a>
</body>       
    <?php
        }
    } 
    catch (PDOException $e) {
        
        $pdo->rollBack();
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}
?>