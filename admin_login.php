<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['password'] === 'admin123') {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo "Mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  
</head>
<body>

    <header>
        <h1>Connexion Administrateur</h1>
        
    </header>
    <nav>
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="offres.php">Épreuves</a></li>
                <li><a href="panier.php">Panier</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>
    <main class="container">
        <section class="login-form">
            <h2>Accès Administrateur</h2>
            <div id="erreur" style="color: red; display: none;"></div>
            <form id="admin-form" method="POST">
                <label for="password">Mot de passe admin :</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required autocomplete="off">
                <button type="submit" class="btn-connexion">Connexion</button>

            </form>
        </section>
    </main>

    <footer>
    <div class="reseaux-sociaux">
        <a href="https://x.com/jeuxolympiques" target="_blank" aria-label="X">
            <i class="fa-brands fa-x-twitter"></i>
        </a>

        <a href="https://www.youtube.com/@Olympics" target="_blank" aria-label="YouTube">
            <i class="fa-brands fa-youtube"></i>
        </a>
    </div>

    <p class="copyright">© 2025 Comité Olympique - Tous droits réservés</p>
</footer>


</body>
</html>
