<?php
require '../connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = ($_POST['nom_inst']);
    $email = ($_POST['email_inst']);
    $details = ($_POST['details_besoins']);
     
    try {
        $pdo->beginTransaction();

        // 1. Insertion dans la table principale 'demandes_aide'
        // Note : J'utilise NOW() pour la date automatique
        $sql = "INSERT INTO demandes_aide (nom_institution, email, details_besoins, date_demande) 
                VALUES (:nom, :email, :details, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':details' => $details
        ]);

        // 2. Récupération de l'ID de la demande
        $last_demande_id = $pdo->lastInsertId();

        // 3. Insertion dans la table de liaison 'demande_type_aide'
        // Attention : Dans votre formulaire HTML, assurez-vous que les checkbox s'appellent name="besoin[]"
        if (isset($_POST['besoin']) && is_array($_POST['besoin'])) {
            
            // D'après votre schéma, les colonnes sont 'aide_id' et 'type_aide_id'
            $sql_lien = "INSERT INTO demande_type_aide (aide_id, type_aide_id) VALUES (:demande_id, :type_id)";
            $stmt_lien = $pdo->prepare($sql_lien);

            foreach ($_POST['besoin'] as $type_id) {
                $stmt_lien->execute([
                    ':demande_id' => $last_demande_id,
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
                    <li><a href="../ONG/ong.htm">ONGs</a></li>
                    <li><a href="./help.php">Demande d'aide</a></li>
                    <li><a href="../contact.htm">Contactez-nous</a></li>
                </ul>
            </nav>
        </header>
        <div style="padding: 30px" class="hero-text">
        <h1>Inscription réussie !</h1><p>La demande d'aide a bien été enregistré.</p>
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
