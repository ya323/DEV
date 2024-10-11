<?php
function renderMenuToHTML($currentPageId) {
    // Définition du tableau qui structure le site
    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';
    $mymenu = array(
        'accueil' => array('Accueil'),
        'cv' => array('CV'),
        'projets' => array('Mes projets'),
        'infos-technique' => array('Infos Techniques'),
        'contact'=> array('Contact')
    );

    // Génération du code HTML du menu
    echo '<nav class="menu">';
    echo '<ul>';
    
    foreach ($mymenu as $pageId => $pageParameters) {
        // Si la page actuelle est égale à la page du tableau, ajouter une classe active
        $class = ($currentPageId == $pageId) ? ' class="active"' : '';
        echo '<li' . $class . '><a href="index.php?page=' . $pageId . '&lang=' . $lang . '">' . $pageParameters[0] . '</a></li>';
    }
    
    echo '</ul>';
    echo '</nav>';
}
?>

    



    