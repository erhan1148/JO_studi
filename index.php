<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['register'])) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);
        echo "Inscription réussie !";
    }

    if (isset($_POST['login'])) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header("Location: accueil.php");
            exit();
        } else {
            echo "Identifiants incorrects.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Connexion - Jeux Olympiques</title>
</head>
<body>

<div class="page1">
    <div class="main-container">
        <div class="icon-top">
            <i class="fa-solid fa-medal"></i>
        </div>
        <div class="titre">
            Bienvenue sur le site Des Jeux-Olympiques d'ERHANDEV
        </div>
        <div class="sous-titre">Connexion / <em>Inscription</em></div>

        <div class="form-container">
            <form method="POST">
                <div class="input-container">
                    <input type="text" name="username" placeholder="Email" required>
                </div>
                <div class="input-container">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="button-container">
                    <button type="submit" name="login">Connexion</button>
                </div>
                <div class="button-container">
                    <button type="submit" name="register">Inscription</button>
                </div>
            </form>
        </div>
    </div>
</div>




</body>
</html>