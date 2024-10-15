

<?php
function renderMenuToHTML($currentPageId) {
    $mymenu = array(
        'index' => array('Accueil'),
        'cv' => array('CV'),
        'projets' => array('Projets'),
        'infos-technique' => array('Infos Techniques')
    );

    echo '<nav class="menu">';
    echo '<ul class="menu">';  // Assurez-vous que la classe "menu" est bien appliquée ici
    foreach ($mymenu as $pageId => $pageParameters) {
        $class = ($currentPageId == $pageId) ? ' id="currentpage"' : '';
        echo '<li' . $class . '><a href="' . $pageId . '.php">' . $pageParameters[0] . '</a></li>';
    }
    echo '</ul>';
    echo '</nav>';
}
?>

