<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription ONG - SchoolHelp</title>
    <link rel="stylesheet" href="../style.css"> </head>
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
                <li><a href="ong.htm">ONGs</a></li>
                <li><a href="../DemandeAide/help.php">Demande d'aide</a></li>
                <li><a href="../contact.htm">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Inscription ONG</h1>
        <p>Remplissez ce formulaire pour proposer vos services.</p>

        <form action="./ong_table.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Nom de l'ONG :</label>
                <input type="text" name="nom_ong" size="300" required>
            </div>

            <div class="form-group">
                <label>Adresse Email :</label>
                <input type="email" name="email_ong" size="300" required>
            </div>

            <div class="form-group checkbox-group">
                <label style="display:block; margin-bottom:10px;">Type d'aide proposée :</label>
    
                <input type="checkbox" id="aide_financiere" name="aide[]" value="1">
                <label for="aide_financiere">Aide Financière</label><br>

                <input type="checkbox" id="aide_materielle" name="aide[]" value="2">
                <label for="aide_materielle">Aide Matérielle</label><br>

                <input type="checkbox" id="aide_place" name="aide[]" value="3">
                <label for="aide_place">Opération sur place</label>
            </div>

            <div class="form-group">
                <label>Objectifs et description :</label>
                <textarea name="description" rows="5" placeholder="Décrivez votre mission..." size="2000" required></textarea>
            </div>

            <div class="form-group">
                <label>Taille de l'effectif :</label>
                <input type="number" name="effectif" size="10" required>
            </div>

            <div class="form-group">
                <label>Budget annuel approximatif (€) :</label>
                <input type="number" name="budget" size="10" required>
            </div>

            <hr>
            
          
            <button type="submit" class="btn">Soumettre l'inscription</button>
        </form>
    </main>

    <footer>
        <div class="copyright">&copy; 2025 SchoolHelp</div>
    </footer>

</body>
</html>