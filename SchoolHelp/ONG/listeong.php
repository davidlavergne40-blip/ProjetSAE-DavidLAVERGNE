<?php

require '../connexion.php';

$sql = "SELECT 
            ong.id,
            ong.nom,
            ong.email,
            ong.description,
            ong.effectif,
            ong.budget,
            ong.date_inscription,
            GROUP_CONCAT(type_aide.type_aide SEPARATOR ', ') as types_format
        FROM ong
        JOIN ong_type_aide ON ong.id = ong_type_aide.ong_id
        JOIN type_aide ON ong_type_aide.type_aide_id = type_aide.id
        GROUP BY ong.id
        ORDER BY ong.date_inscription DESC";

try {
    $stmt = $pdo->query($sql);
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de récupération : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Demandes - SchoolHelp</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>

    <header>
        <div class="logo-container">
            <img src="../images/img3.png" alt="Logo">
        </div>
        <h1>SchoolHelp</h1>
        <nav>
            <ul>
                <li><a href="../index.htm">Accueil</a></li>
                <li><a href="../benevole/benevole.htm">Bénévoles</a></li>
                <li><a href="./ong.htm">ONGs</a></li>
                <li><a href="../DemandeAide/help.php">Demande d'aide</a></li>
                <li><a href="../contact.htm">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Tableau des ONGs participantes</h1>
        <p>Voici la liste des ONGs participant au programme SchoolHelp.</p>
        
        <a href="../benevole/benevole.htm" class="btn btn-outline">← Retour Espace Bénévole</a>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 12%;">Date</th>
                        <th style="width: 15%;">ONG</th>
                        <th style="width: 12%;">Actions possibles</th>
                        <th style="width: 25%;">Détails & Description</th>
                        <th style="width: 12%;">Budget</th>
                        <th style="width: 12%;">Effectif</th>
                        <th style="width: 12%;">Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($demandes) > 0): ?>
                        <?php foreach ($demandes as $d): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($d['date_inscription'])) ?></td>
                                
                                <td><strong><?= htmlspecialchars($d['nom']) ?></strong></td>
                                
                                <td>
                                    <?php if($d['types_format']): ?>
                                        <span class="tag"><?= htmlspecialchars($d['types_format']) ?></span>
                                    <?php else: ?>
                                        <span style="color:#999;">Non spécifié</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= nl2br(htmlspecialchars($d['description'])) ?></td>
                                
                                <td>
                                    <?= nl2br(htmlspecialchars($d['effectif'])) ?>
                                </td>
                                
                                <td>
                                    <?= nl2br(htmlspecialchars($d['budget'])) ?>€
                                </td>
                                
                                <td>
                                    <a href="mailto:<?= htmlspecialchars($d['email']) ?>" class="btn" style="padding: 5px 10px; font-size: 0.8rem;">Contacter</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-msg">Aucune demande d'aide enregistrée pour le moment.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <div class="copyright">&copy; 2025 SchoolHelp</div>
    </footer>

</body>
</html>
