<?php
// panier.php
// Ce fichier gère le contenu du panier de l'utilisateur (ajout, suppression, affichage, etc.).
// Il est appelé via des requêtes AJAX depuis script.js.

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "db.php"; // Assure-toi que ce fichier contient la connexion à ta base de données

// Initialise le panier s'il n'existe pas déjà.
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Fonctions pour manipuler le panier.
function ajouterArticle($nom, $prix) {
    $articleExiste = false;
    foreach ($_SESSION['panier'] as &$article) {
        if ($article['nom'] === $nom && $article['prix'] === $prix) {
            $article['quantite'] += 1;
            $articleExiste = true;
            break;
        }
    }
    if (!$articleExiste) {
        $_SESSION['panier'][] = ['nom' => $nom, 'prix' => $prix, 'quantite' => 1];
    }
}

function supprimerArticle($nom, $prix) {
    error_log("supprimerArticle appelé avec nom: " . $nom . ", prix: " . $prix);
    
    foreach ($_SESSION['panier'] as $key => &$article) {
        if ($article['nom'] === $nom && $article['prix'] == $prix) {
            if ($article['quantite'] > 1) {
                $article['quantite'] -= 1; // Diminue la quantité de 1
            } else {
                unset($_SESSION['panier'][$key]); // Supprime l'entrée si quantité = 1
                $_SESSION['panier'] = array_values($_SESSION['panier']); // Réindexe le tableau
            }
            return; // Quitte la fonction après modification
        }
    }
}



function viderPanier() {
    $_SESSION['panier'] = [];
}

// Gestion des actions.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $postData = json_decode(file_get_contents('php://input'), true);

    if (isset($postData['action'])) {
        $action = $postData['action'];

        switch ($action) {
            case 'ajouter':
                if (isset($postData['nom']) && isset($postData['prix'])) {
                    ajouterArticle($postData['nom'], floatval($postData['prix']));
                    echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Nom et prix requis']);
                }
                break;
            case 'supprimer':
                if (isset($postData['nom']) && isset($postData['prix'])) {
                    supprimerArticle($postData['nom'], floatval($postData['prix']));
                    echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Nom et prix requis pour supprimer']);
                }
                break;
            case 'vider':
                viderPanier();
                echo json_encode(['success' => true, 'panier' => []]);
                break;
            case 'afficher': // Added to show the cart
                echo json_encode($_SESSION['panier']);
                break;
            default:
                echo json_encode(['success' => false, 'error' => 'Action invalide']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Action non spécifiée']);
    }
    exit();
}

// Si la requête n'est pas un POST, on affiche le contenu du panier (c'est-à-dire si on accède directement à panier.php)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Panier</title>
    

<script>
    // script.js (inclus dans panier.php)
    // Ce fichier contient les fonctions JavaScript pour interagir avec le panier
    // de manière asynchrone (sans recharger la page).

    document.addEventListener('DOMContentLoaded', () => {
        const viderPanierBtn = document.getElementById('vider-panier');
        if (viderPanierBtn) {
            viderPanierBtn.addEventListener('click', () => {
                fetch('panier.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ action: 'vider' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        afficherPanier();
                    } else {
                        console.error('Erreur lors de la suppression du panier:', data.error);
                    }
                })
                .catch(error => console.error('Erreur lors de la suppression du panier:', error));
            });
        }
        afficherPanier(); // Initialise l'affichage du panier au chargement de la page
    });

    function afficherPanier() {
        fetch('panier.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ action: 'afficher' }) // Ajoute une action pour afficher
        })
        .then(response => response.json())
        .then(data => {
            const panierListe = document.getElementById('panier-liste');
            const panierTotalDiv = document.getElementById('panier-total');
            let total = 0;
            panierListe.innerHTML = ''; // Clear existing content

            if (data && data.length > 0) {
                data.forEach(article => {
                    const li = document.createElement('li');
                    li.textContent = `${article.nom} - ${article.prix}€ x ${article.quantite}`;

                    const supprimerBtn = document.createElement('button');
                    supprimerBtn.textContent = 'Supprimer';
                    supprimerBtn.classList.add('supprimer-article');
                    supprimerBtn.dataset.nom = article.nom;
                    supprimerBtn.dataset.prix = article.prix; // Ajouter le prix comme dataset
                    supprimerBtn.addEventListener('click', () => {
                        supprimerArticle(article.nom, article.prix); // Passer le nom et le prix
                        afficherPanier();
                    });

                    li.appendChild(supprimerBtn);
                    panierListe.appendChild(li);
                    total += article.prix * article.quantite;
                });
                panierTotalDiv.textContent = `Total: ${total.toFixed(2)}€`;
            } else {
                panierListe.innerHTML = '<li>Votre panier est vide</li>';
                panierTotalDiv.textContent = 'Total: 0€';
            }
        })
        .catch(error => console.error('Erreur lors de l\'affichage du panier:', error));
    }


    function ajouterPanier(nom, prix) {
        fetch('panier.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ action: 'ajouter', nom: nom, prix: prix })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                afficherPanier();
            } else {
                console.error('Erreur lors de l\'ajout au panier:', data.error);
            }
        })
        .catch(error => console.error('Erreur lors de l\'ajout au panier:', error));
    }

    function supprimerArticle(nom, prix) { // Inclure le prix
        fetch('panier.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ action: 'supprimer', nom: nom, prix: prix }) // Inclure le prix
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                afficherPanier();
            } else {
                console.error('Erreur lors de la suppression de l\'article:', data.error);
            }
        })
        .catch(error => console.error('Erreur lors de la suppression de l\'article:', error));
    }
    </script>
</head>
<body>

    <header>
        <h1>Votre Panier</h1>
       
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
    <section class="panier-section">
    <h2>🛒 Votre Panier</h2>
   
    <ul id="panier-liste"></ul>
    <div id="panier-total" class="total-container"></div>
    <button id="vider-panier" class="btn-vider">🗑️ Vider le Panier</button>
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

