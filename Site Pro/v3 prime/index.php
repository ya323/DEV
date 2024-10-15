<?php
require_once("template_header.php");
require_once("template_menu.php");
// Définition de la page courante
$currentPageId = 'accueil'; // Par défaut, la page d'accueil
if (isset($_GET['page'])) {
    $currentPageId = $_GET['page'];
}
?>
    <header>
        <?php
            require_once('template_menu.php');
            renderMenuToHTML('index');

        ?>
    </header>
    <div class="container">
        <h2>" BIENVENUE SUR MON SITE WEB PROFESSIONNEL " </h2>
        <p>"La première impression est souvent la dernière."</p>
        <p>- Yassir BENJANE</p>
        
    </div>
    <?php
        // Affichage du menu avec la page courante sélectionnée
        renderMenuToHTML($currentPageId);
    ?>
    <section class="corps">
    <?php
    // Inclusion du contenu de la page en fonction de la page courante
    $pageToInclude = $currentPageId . ".php";
    if (is_readable($pageToInclude)) {
        require_once($pageToInclude);
    } else {
        require_once("error.php"); // Affiche une page d'erreur si la page n'existe pas
    }
    ?>
</section>

<?php
require_once("template_footer.php");
?>









