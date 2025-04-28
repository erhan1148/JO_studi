<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Jeux Olympiques - Page d'Accueil</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <header>
    <img src="Images/Olympic_rings_without_rims.svg.png" alt="Anneaux Olympiques" class="logo-olympique">

        <h1>Les Jeux Olympiques</h1>
        <p class="sous-titre">Citius, Altius, Fortius - Plus vite, Plus haut, Plus fort</p>
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
        <section class="section accueil">
            <h2>Bienvenue sur le portail des Jeux Olympiques</h2>
            <p>Découvrez l'histoire, les disciplines et les athlètes qui ont marqué les Jeux Olympiques modernes depuis leur création en 1896. Des premiers Jeux à Athènes, marqués par l'idéal de Pierre de Coubertin de rassembler les nations dans une compétition pacifique, aux éditions contemporaines qui mettent en lumière des performances athlétiques exceptionnelles et de nouvelles disciplines passionnantes, explorez l'esprit de compétition, de camaraderie et d'excellence qui anime cet événement mondial. Plongez au cœur des moments les plus mémorables, apprenez-en davantage sur les valeurs fondamentales de l'Olympisme, telles que l'excellence, l'amitié et le respect, et suivez avec nous les préparatifs des prochaines éditions, qu'il s'agisse des Jeux d'été ou d'hiver.</p>

            <div class="annees-olympiques">
            <div class="annee-card tokyo-2020">
                    <h3>Tokyo 2020</h3>
                    <p>Jeux d'été</p>
                </div>
                <div class="annee-card pekin-2022">
                    <h3>Pékin 2022</h3>
                    <p>Jeux d'hiver</p>
                </div>
                <div class="annee-card paris-2024">
                    <h3>Paris 2024</h3>
                    <p>Jeux d'été</p>
                </div>
                <div class="annee-card milan-cortina-2026">
                    <h3>Milan-Cortina 2026</h3>
                    <p>Jeux d'hiver</p>
                </div>
                <div class="annee-card los-angeles-2028">
                    <h3>Los Angeles 2028</h3>
                    <p>Jeux d'été</p>
                </div>
               
                <div class="annee-card jeux-hiver-2030">
                    <h3>Jeux d'hiver 2030</h3>
                    <p>Ville hôte à déterminer</p>
                </div>
                
            </div>
        </section>
        
        <section class="section actualites">
    <h2>Actualités Olympiques</h2>
    <article>
        <h3>Retour sur Tokyo 2020 (Reporté en 2021)</h3>
        <p>Les Jeux Olympiques de Tokyo 2020, reportés en raison de la pandémie mondiale, ont été un symbole de résilience et d'unité, malgré le contexte particulier.</p>
        <p><strong>Faits marquants:</strong> La performance exceptionnelle des athlètes dans des conditions inédites, l'introduction de nouvelles épreuves et l'engagement envers la durabilité.</p>
    </article>
    <article>
        <h3>Préparation pour Paris 2024</h3>
        <p>Les préparatifs pour les Jeux Olympiques de Paris 2024 sont en cours avec la construction de nouvelles infrastructures et la rénovation de sites existants, plaçant l'accent sur l'innovation et l'accessibilité.</p>
        <p><strong>À suivre:</strong> Les derniers développements concernant le village olympique, les épreuves tests et les initiatives culturelles autour des Jeux.</p>
    </article>
    <article>
        <h3>Nouvelles disciplines</h3>
        <p>Le breakdance et l'escalade sportive feront leur apparition aux JO de Paris 2024, marquant une évolution vers des sports plus urbains et engageant une nouvelle génération de participants et de spectateurs.</p>
        <p><strong>En perspective:</strong> L'intégration potentielle d'autres nouvelles disciplines pour les futurs Jeux, reflétant l'évolution constante du paysage sportif.</p>
    </article>
    <article>
        <h3>Perspectives pour Los Angeles 2028</h3>
        <p>Les Jeux Olympiques de Los Angeles 2028 se profilent déjà, avec des discussions autour de l'héritage que ces Jeux laisseront à la ville et à la promotion du sport chez les jeunes aux États-Unis.</p>
        <p><strong>Attentes:</strong> Une forte emphase sur la technologie, le développement durable et l'engagement communautaire pour ces Jeux américains.</p>
    </article>
</section>

<section class="section athletes">
    <h2>Athlètes Olympiques à Suivre</h2>
    <article>
        <h3>Performances Historiques Passées</h3>
        <p>Revivez les moments de gloire d'athlètes légendaires tels que Jesse Owens aux Jeux de Berlin en 1936, marquant l'histoire par ses performances et son courage face à l'adversité.</p>
        <p><strong>Autres figures emblématiques:</strong> Michael Phelps et ses records en natation, Usain Bolt et sa domination en athlétisme, Simone Biles et son excellence en gymnastique.</p>
    </article>
    <article>
        <h3>Étoiles Montantes pour Paris 2024</h3>
        <p>Gardez un œil sur les jeunes talents qui se préparent pour briller à Paris 2024. De nouvelles figures émergent dans diverses disciplines, promettant des compétitions passionnantes.</p>
        <p><strong>Exemples potentiels (à suivre selon l'actualité):</strong> Des athlètes prometteurs en athlétisme, natation, gymnastique, et les nouveaux sports comme le breakdance et l'escalade.</p>
    </article>
    <article>
        <h3>Histoires Inspirantes</h3>
        <p>Découvrez les parcours d'athlètes qui ont surmonté des défis incroyables pour atteindre le plus haut niveau du sport, incarnant la persévérance et la détermination.</p>
        <p><strong>Thèmes récurrents:</strong> Le dépassement de soi, la résilience face aux blessures, l'engagement envers leurs communautés.</p>
    </article>
</section>

<section class="section epreuves">
    <h2>Épreuves Olympiques Phares</h2>
    <article>
        <h3>Les Classiques Indémodables</h3>
        <p>Les épreuves d'athlétisme comme le 100 mètres, le marathon et le saut en hauteur continuent de captiver le public par leur intensité et la quête de records.</p>
        <p><strong>Autres épreuves emblématiques:</strong> La natation (relais, papillon, nage libre), la gymnastique artistique (concours général, agrès), et les sports d'équipe comme le football et le basketball.</p>
    </article>
    <article>
        <h3>Nouveautés et Évolutions</h3>
        <p>L'ajout du breakdance et de l'escalade sportive à Paris 2024 témoigne de la volonté du CIO de moderniser les Jeux et d'attirer un public plus jeune.</p>
        <p><strong>Évolutions notables:</strong> L'intégration de disciplines mixtes, l'accent sur la durabilité dans l'organisation des épreuves, et l'adaptation des formats pour une meilleure expérience spectateur.</p>
    </article>
    <article>
        <h3>Moments Historiques par Épreuve</h3>
        <p>Revivez des moments marquants de l'histoire des Jeux pour des épreuves spécifiques, comme les duels légendaires en athlétisme, les performances inoubliables en natation ou les surprises des sports d'équipe.</p>
        <p><strong>Exemples:</strong> Le "Miracle sur glace" en hockey sur glace, les records du monde battus en athlétisme, les finales de basketball épiques.</p>
    </article>
</section>

<section class="section valeurs">
    <h2>Valeurs Olympiques et l'Esprit Coubertin</h2>
    <p>Les valeurs fondamentales de l'Olympisme, promues par le Baron Pierre de Coubertin, le père des Jeux Olympiques modernes, sont plus que de simples mots. Elles incarnent une philosophie de vie axée sur l'épanouissement de l'individu à travers le sport et la rencontre pacifique des peuples.</p>
    <ul>
        <li><strong>Excellence:</strong> Donner le meilleur de soi-même, non seulement dans la compétition, mais aussi dans la vie de tous les jours. Selon Coubertin, l'important n'est pas de gagner, mais de participer et de progresser constamment.</li>
        <li><strong>Amitié:</strong> Construire un monde meilleur grâce au sport, en favorisant la compréhension mutuelle, le respect des différences culturelles et la création de liens durables entre les nations. Coubertin voyait dans les Jeux un moyen de promouvoir la paix et la coopération internationale.</li>
        <li><strong>Respect:</strong> Respect de soi, des autres et des règles. Cela inclut l'éthique sportive, l'intégrité et la reconnaissance de la dignité de chaque participant. Pour Coubertin, le sport devait être une école de moralité et de fair-play.</li>
    </ul>
    <p><strong>L'Esprit Coubertin:</strong> Cet esprit englobe l'ensemble de ces valeurs et met en lumière l'importance de l'effort, du fair-play, de la joie de la participation et du respect mutuel au-delà de la simple quête de la victoire. Il s'agit d'une invitation à vivre les Jeux comme une célébration de l'humanité et de ses capacités.</p>
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
