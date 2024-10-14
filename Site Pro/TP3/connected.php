<?php
session_start(); // Démarre la session

// Simuler une base de données
$users = array(
    'riri' => 'fifi',
    'yoda' => 'maitrejedi'
);

$login = "anonymous";
$errorText = "";
$successfullyLogged = false;

// Vérifier si les champs login et password existent
if (isset($_POST['login']) && isset($_POST['password'])) {
    $tryLogin = $_POST['login'];
    $tryPwd = $_POST['password'];

    // Vérification des identifiants
    if (array_key_exists($tryLogin, $users) && $users[$tryLogin] == $tryPwd) {
        $successfullyLogged = true;
        $login = $tryLogin;

        // Enregistrer le login dans la session
        $_SESSION['login'] = $login;

        // Rediriger l'utilisateur vers la page d'accueil ou une autre page
        header("Location: welcome.php");
        exit();
    } else {
        $errorText = "Erreur de login/password";
    }
} else {
    $errorText = "Merci d'utiliser le formulaire de login";
}

if (!$successfullyLogged) {
    echo $errorText;
}
?>
