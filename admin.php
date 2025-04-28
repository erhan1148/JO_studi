<?php
session_start();
include "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Gestion des catégories
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ajouter_categorie'])) {
        $stmt = $pdo->prepare("INSERT INTO categories (nom) VALUES (?)");
        $stmt->execute([$_POST['nom_categorie']]);
    }

    if (isset($_POST['supprimer_categorie'])) {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$_POST['id_categorie']]);
    }

    if (isset($_POST['modifier_categorie'])) {
        $stmt = $pdo->prepare("UPDATE categories SET nom = ? WHERE id = ?");
        $stmt->execute([$_POST['nom_categorie'], $_POST['id_categorie']]);
    }

    // Gestion des épreuves
    if (isset($_POST['ajouter_epreuve'])) {
        $stmt = $pdo->prepare("INSERT INTO epreuves (nom, description, prix_solo, prix_duo, prix_famille, image, categorie) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['nom'], $_POST['description'], $_POST['prix_solo'], $_POST['prix_duo'], $_POST['prix_famille'], $_POST['image'], $_POST['categorie']]);
    }

    if (isset($_POST['supprimer_epreuve'])) {
        $stmt = $pdo->prepare("DELETE FROM epreuves WHERE id = ?");
        $stmt->execute([$_POST['id_epreuve']]);
    }

    if (isset($_POST['modifier_epreuve'])) {
        $stmt = $pdo->prepare("UPDATE epreuves SET nom = ?, description = ?, prix_solo = ?, prix_duo = ?, prix_famille = ?, image = ?, categorie = ? WHERE id = ?");
        $stmt->execute([$_POST['nom'], $_POST['description'], $_POST['prix_solo'], $_POST['prix_duo'], $_POST['prix_famille'], $_POST['image'], $_POST['categorie'], $_POST['id_epreuve']]);
    }
}

// Récupération des données
$epreuves = $pdo->query("SELECT epreuves.*, categories.nom as categorie_nom FROM epreuves LEFT JOIN categories ON epreuves.categorie = categories.id")->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin - Gestion des épreuves et catégories</title>
    
    <script>
        function afficherFormulaireModificationEpreuve(id, nom, description, prix_solo, prix_duo, prix_famille, image, categorie) {
            document.getElementById('modification-epreuve-form').style.display = 'block';
            document.getElementById('mod-id-epreuve').value = id;
            document.getElementById('mod-nom-epreuve').value = nom;
            document.getElementById('mod-description-epreuve').value = description;
            document.getElementById('mod-prix_solo-epreuve').value = prix_solo;
            document.getElementById('mod-prix_duo-epreuve').value = prix_duo;
            document.getElementById('mod-prix_famille-epreuve').value = prix_famille;
            document.getElementById('mod-image-epreuve').value = image;
            document.getElementById('mod-categorie-epreuve').value = categorie;
        }

        function afficherFormulaireModificationCategorie(id, nom) {
            document.getElementById('modification-categorie-form').style.display = 'block';
            document.getElementById('mod-id-categorie').value = id;
            document.getElementById('mod-nom-categorie').value = nom;
        }
    </script>
</head>
<body>
    <h1>Gestion des épreuves et catégories</h1>

    <h2>Gestion des catégories</h2>
    <form method="POST">
        <input type="text" name="nom_categorie" placeholder="Nom de la catégorie" required>
        <button type="submit" name="ajouter_categorie">Ajouter catégorie</button>
    </form>

    <h2>Liste des catégories</h2>
    <ul>
        <?php foreach ($categories as $categorie): ?>
            <li>
                <?= $categorie['nom'] ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_categorie" value="<?= $categorie['id'] ?>">
                    <button type="submit" name="supprimer_categorie">Supprimer</button>
                </form>
                <button onclick="afficherFormulaireModificationCategorie('<?= $categorie['id'] ?>', '<?= htmlspecialchars($categorie['nom'], ENT_QUOTES) ?>')">Modifier</button>
            </li>
        <?php endforeach; ?>
    </ul>

    <div id="modification-categorie-form" style="display:none;">
        <h2>Modifier une catégorie</h2>
        <form method="POST">
            <input type="hidden" id="mod-id-categorie" name="id_categorie">
            <input type="text" id="mod-nom-categorie" name="nom_categorie" placeholder="Nom de la catégorie" required>
            <button type="submit" name="modifier_categorie">Modifier</button>
        </form>
    </div>

    <h2>Gestion des épreuves</h2>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom de l'épreuve" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="number" name="prix_solo" placeholder="Prix Solo" required>
        <input type="number" name="prix_duo" placeholder="Prix Duo" required>
        <input type="number" name="prix_famille" placeholder="Prix Famille" required>
        <input type="text" name="image" placeholder="URL de l'image" required>
        <select name="categorie">
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="ajouter_epreuve">Ajouter épreuve</button>
    </form>

    <h2>Liste des épreuves</h2>
    <ul>
    <?php foreach ($epreuves as $e): ?>
    <li>
        <?= $e['nom'] ?> - Catégorie : <?= htmlspecialchars($e['categorie_nom'], ENT_QUOTES) ?> - <?= $e['prix_solo'] ?>€ / <?= $e['prix_duo'] ?>€ / <?= $e['prix_famille'] ?>€
        <form method="POST" style="display:inline;">
            <input type="hidden" name="id_epreuve" value="<?= $e['id'] ?>">
            <button type="submit" name="supprimer_epreuve">Supprimer</button>
        </form>
        <button onclick="afficherFormulaireModificationEpreuve('<?= $e['id'] ?>', '<?= htmlspecialchars($e['nom'], ENT_QUOTES) ?>', '<?= htmlspecialchars($e['description'], ENT_QUOTES) ?>', '<?= $e['prix_solo'] ?>', '<?= $e['prix_duo'] ?>', '<?= $e['prix_famille'] ?>', '<?= htmlspecialchars($e['image'], ENT_QUOTES) ?>', '<?= $e['categorie'] ?>')">Modifier</button>
    </li>
<?php endforeach; ?>
    </ul>

    <div id="modification-epreuve-form" style="display:none;">
        <h2>Modifier une épreuve</h2>
        <form method="POST">
            <input type="hidden" id="mod-id-epreuve" name="id_epreuve">
            <input type="text" id="mod-nom-epreuve" name="nom" placeholder="Nom de l'épreuve" required>
            <input type="text" id="mod-description-epreuve" name="description" placeholder="Description" required>
            <input type="number" id="mod-prix_solo-epreuve" name="prix_solo" placeholder="Prix Solo" required>
            <input type="number" id="mod-prix_duo-epreuve" name="prix_duo" placeholder="Prix Duo" required>
            <input type="number" id="mod-prix_famille-epreuve" name="prix_famille" placeholder="Prix Famille" required>
            <input type="text" id="mod-image-epreuve" name="image" placeholder="URL de l'image" required>
            <select id="mod-categorie-epreuve" name="categorie">
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="modifier_epreuve">Modifier</button>
        </form>
    </div>

    <div class="admin-footer">
    <a href="admin_logout.php" class="btn-logout">Déconnexion Admin</a>
    </div>
    
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