<?php

require_once('template_header.php'); /** contenu de header */
require_once('template_menu.php');  /** contenu menu */ 
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';
$currentPageId = 'accueil';

if (isset($_GET['page'])) {
    $currentPageId = $_GET['page'];  
}
?>
<section class="top-page">
<header class="header">
        <img src="images/cv logo.jpg" alt="cv logo">
        <?php
        require_once('template_menu.php');
        renderMenuToHTML('index');
        ?>
</header>
    <?php

    $pageToInclude = $lang . "/" . $currentPageId . ".php";
    if (is_readable($pageToInclude)) {
        require_once($pageToInclude); 
    } else {
        require_once('error.php');    
    }
    ?>
</section>

<?php
require_once('template_footer.php'); 
