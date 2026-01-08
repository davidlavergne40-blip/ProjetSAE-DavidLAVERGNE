<?php

require '../connexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = ($_POST['nom_ong']);
    $email = ($_POST['email_ong']);
    $description = ($_POST['description']);
    $effectif = (int)$_POST['effectif'];
    $budget = (float)$_POST['budget'];

    try {
        
        $pdo->beginTransaction();

        $sql = "INSERT INTO ong (nom, email, description, effectif, budget, date_inscription) 
                VALUES (:nom, :email, :desc, :eff, :budget, NOW())";
        
        $laRequete = $pdo->prepare($sql);
        $laRequete->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':desc' => $description,
            ':eff' => $effectif,
            ':budget' => $budget
        ]);

        $last_ong_id = $pdo->lastInsertId();

        if (isset($_POST['aide']) && is_array($_POST['aide'])) {
            
            $sql_lien = "INSERT INTO ong_type_aide (ong_id, type_aide_id) VALUES (:ong_id, :type_id)";
            $laRequete_lien = $pdo->prepare($sql_lien);

            foreach ($_POST['aide'] as $type_id) {
                $laRequete_lien->execute([
                    ':ong_id' => $last_ong_id,
                    ':type_id' => (int)$type_id
                ]);
            }
        }

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
                    <li><a href="../benevole/benevole.htm">Bénévoles</a></li>
                    <li><a href="./ong.htm">ONGs</a></li>
                    <li><a href="../DemandeAide/help.php">Demande d'aide</a></li>
                    <li><a href="../contact.htm">Contactez-nous</a></li>
                </ul>
            </nav>
        </header>
        <div style="padding: 30px" class="hero-text">
        <h1>Inscription réussie !</h1><p>Le profil de l'ONG a bien été enregistré.</p>
        </div>
        <a style="padding: 30px" href='../index.htm'>Retour à l'accueil</a>
    </body>       

        <?php
    } 
    catch (PDOException $e) {
        
        $pdo->rollBack();
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}
?>