<?php
// Inclure la configuration de la base de données
require_once('config.php');

try {
    // Connexion à la base de données avec PDO
    $connectionString = "mysql:host=" . _MYSQL_HOST . ";port=" . _MYSQL_PORT . ";dbname=" . _MYSQL_DBNAME;
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lire le contenu du fichier SQL
    $sql = file_get_contents('create_db.sql');

    if ($sql === false) {
        throw new Exception("Impossible de lire le fichier SQL.");
    }

    // Exécuter les requêtes SQL
    $pdo->exec($sql);

    echo "Base de données créée avec succès.";

} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
