<?php

require '../connexion.php';


$sql = "SELECT 
            d.id,
            d.nom_institution,
            d.email,
            d.details_besoins,
            d.date_demande,
            GROUP_CONCAT(t.type_aide SEPARATOR ', ') as types_format
        FROM demandes_aide d
        LEFT JOIN demande_type_aide da ON d.id = da.aide_id
        LEFT JOIN type_aide t ON da.type_aide_id = t.id
        GROUP BY d.id
        ORDER BY d.date_demande DESC";

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
                <li><a href="../ONG/ong.htm">ONGs</a></li>
                <li><a href="help.php">Demande d'aide</a></li>
                <li><a href="../contact.htm">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Tableau des demandes d'aide</h1>
        <p>Voici la liste des institutions ayant sollicité l'aide de SchoolHelp.</p>
        
        <a href="../ONG/ong.htm" class="btn btn-outline">← Retour Espace ONG</a>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 15%;">Date</th>
                        <th style="width: 20%;">Institution</th>
                        <th style="width: 20%;">Besoins (Types)</th>
                        <th style="width: 30%;">Détails & Description</th>
                        <th style="width: 15%;">Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($demandes) > 0): ?>
                        <?php foreach ($demandes as $d): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($d['date_demande'])) ?></td>
                                
                                <td><strong><?= htmlspecialchars($d['nom_institution']) ?></strong></td>
                                
                                <td>
                                    <?php if($d['types_format']): ?>
                                        <span class="tag"><?= htmlspecialchars($d['types_format']) ?></span>
                                    <?php else: ?>
                                        <span style="color:#999;">Non spécifié</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= nl2br(htmlspecialchars($d['details_besoins'])) ?></td>
                                
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
