<?php
// offres.php
// Ce fichier affiche la liste des épreuves disponibles et permet à l'utilisateur
// de les ajouter à son panier.

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "db.php"; // Assure-toi que ce fichier contient la connexion à ta base de données

// Initialise le panier s'il n'existe pas déjà.
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

try {
    $epreuves = $pdo->query("SELECT epreuves.*, categories.nom AS categorie_nom FROM epreuves LEFT JOIN categories ON epreuves.categorie = categories.id")->fetchAll();
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des épreuves : " . $e->getMessage();
    die();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Épreuves - Jeux Olympiques</title>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.ajout-panier').forEach(button => {
            button.addEventListener('click', () => {
                ajouterPanier(button.dataset.nom, button.dataset.prix);
            });
        });
    });

    function ajouterPanier(nom, prix) {
        fetch('panier.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'ajouter', nom, prix })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`L'épreuve "${nom}" a été ajoutée au panier !`);
                afficherPanier();
            } else {
                console.error('Erreur:', data.error);
                alert('Erreur lors de l\'ajout au panier. Veuillez réessayer.');
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
    </script>
</head>
<body>

    <header>
        <h1>Liste des épreuves</h1>
      
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
        <?php 
        $categories = [];
        foreach ($epreuves as $e) {
            $categories[$e['categorie_nom']][] = $e;
        }
        ?>

        <div class="categories-grid">
            <?php foreach ($categories as $categorie => $epreuves_cat): ?>
                <section class="category">
                    <h2><?= htmlspecialchars($categorie) ?></h2>
                    <div class="epreuves">
                        <?php foreach ($epreuves_cat as $e): ?>
                            <div class="cardoffres">
                                <p><?= htmlspecialchars($e['nom']) ?></p>
                                <img src="<?= htmlspecialchars($e['image']) ?>" alt="<?= htmlspecialchars($e['nom']) ?>">
                                <p><?= htmlspecialchars($e['description']) ?></p>
                                <button class="ajout-panier" data-nom="<?= htmlspecialchars($e['nom']) ?>" data-prix="<?= floatval($e['prix_solo']) ?>">Solo - <?= $e['prix_solo'] ?>€</button>
                                <button class="ajout-panier" data-nom="<?= htmlspecialchars($e['nom']) ?>" data-prix="<?= floatval($e['prix_duo']) ?>">Duo - <?= $e['prix_duo'] ?>€</button>
                                <button class="ajout-panier" data-nom="<?= htmlspecialchars($e['nom']) ?>" data-prix="<?= floatval($e['prix_famille']) ?>">Famille - <?= $e['prix_famille'] ?>€</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
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
