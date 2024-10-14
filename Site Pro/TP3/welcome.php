<?php
session_start(); // Démarrer la session

if (isset($_SESSION['login'])) {
    echo "<h1>Bienvenue sur mon site internet, " . $_SESSION['login'] . "</h1>";
    echo "<a href='logout.php'>Se déconnecter</a>";
} else {
    echo "<p>Vous n'êtes pas connecté. <a href='login.php'>Se connecter</a></p>";
}
?>
