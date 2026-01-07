<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande d'Aide - SchoolHelp</title>
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
        <h1>Faire une demande d'aide</h1>
        <p>Votre institution a besoin de soutien ? Dites-nous en plus.</p>
       
        <form action="./demande_table.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Nom de l'Institution / École :</label>
                <input type="text" name="nom_inst" size="300" required>
            </div>

            <div class="form-group">
                <label>Adresse Email de contact :</label>
                <input type="email" name="email_inst" size="300" required>
            </div>

            <div class="form-group checkbox-group">
                <label style="display:block; margin-bottom:10px;">Type d'aide demandée :</label>
                <input type="checkbox" id="1" name="besoin[]" value="1">
                <label for="1">Aide Financière</label><br>
                
                <input type="checkbox" id="2" name="besoin[]" value="2">
                <label for="2">Aide Matérielle (Colis/Objets)</label><br>
                
                <input type="checkbox" id="3" name="besoin[]" value="3">
                <label for="3">Opération sur place (Déplacement)</label>
            </div>

            <div class="form-group">
                <label>Description des besoins :</label>
                <textarea name="details_besoins" rows="5" size="2000" required></textarea>
            </div>

            <button type="submit" class="btn">Envoyer la demande</button>
        </form>
        
    </main>

    <footer>
        <div class="copyright">&copy; 2025 SchoolHelp</div>
    </footer>
</body>
</html>