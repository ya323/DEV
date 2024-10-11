<?php
// On simule une base de données
$users = array(
    // login => password
    'yassir' => 'BENJANE',
    'yoda' => 'maitrejedi'
);

$login = "anonymous";
$errorText = "";
$successfullyLogged = false;

// Vérifier si les champs 'login' et 'password' ont été soumis via POST
if (isset($_POST['login']) && isset($_POST['password'])) {
    $tryLogin = $_POST['login'];
    $tryPwd = $_POST['password'];

    // Si le login existe et que le mot de passe correspond
    if (array_key_exists($tryLogin, $users) && $users[$tryLogin] == $tryPwd) {
        $successfullyLogged = true;
        $login = $tryLogin;
    } else {
        $errorText = "Erreur de login/password";
    }
} else {
    $errorText = "Merci d'utiliser le formulaire de login";
}

// Afficher les résultats
if (!$successfullyLogged) {
    echo $errorText;
} else {
    echo "<h1>Bienvenu " . $login . "</h1>";
}
?>

    

