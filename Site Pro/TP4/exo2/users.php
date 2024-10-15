<?php
require_once('config.php');

$connectionString = "mysql:host=" . _MYSQL_HOST . ";port=" . _MYSQL_PORT . ";dbname=" . _MYSQL_DBNAME;

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$pdo = null;

try {
    // Se connecter à la base de données
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Exécuter la requête SQL pour sélectionner tous les utilisateurs
    $request = $pdo->prepare("SELECT * FROM users");
    $request->execute();

    // Afficher les résultats dans un tableau HTML
    $users = $request->fetchAll(PDO::FETCH_OBJ);
    
    if (count($users) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";

        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$user->id}</td>";
            echo "<td>{$user->name}</td>";
            echo "<td>{$user->email}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun utilisateur trouvé dans la base de données.";
    }
} catch (PDOException $error) {
    echo 'Erreur : ' . $error->getMessage();
} finally {
    // Fermer la connexion
    $pdo = null;
}
?>
