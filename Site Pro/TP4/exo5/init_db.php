<?php
require_once('config.php');

// Connexion à la base de données via PDO
function connectDB() {
    try {
        $connectionString = "mysql:host=" . _MYSQL_HOST . ";port=" . _MYSQL_PORT . ";dbname=" . _MYSQL_DBNAME;
        $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

// Récupérer tous les utilisateurs (READ)
function getAllUsers($pdo) {
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un utilisateur par ID (READ)
function getUserById($pdo, $id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

// Créer un utilisateur (CREATE)
function createUser($pdo, $name, $email) {
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['name' => $name, 'email' => $email]);
    return $pdo->lastInsertId(); // Retourne l'ID du nouvel utilisateur
}

// Mettre à jour un utilisateur (UPDATE)
function updateUser($pdo, $id, $name, $email) {
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['name' => $name, 'email' => $email, 'id' => $id]);
}

// Supprimer un utilisateur (DELETE)
function deleteUser($pdo, $id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
}

// Définir les en-têtes HTTP pour les réponses JSON
function setHeaders() {
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
}
?>

