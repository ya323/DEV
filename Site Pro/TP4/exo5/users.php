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

// Récupérer tous les utilisateurs
function getAllUsers($pdo) {
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un utilisateur par ID
function getUserById($pdo, $id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

// Créer un utilisateur
function createUser($pdo, $name, $email) {
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['name' => $name, 'email' => $email]);
    return $pdo->lastInsertId();
}

// Mettre à jour un utilisateur
function updateUser($pdo, $id, $name, $email) {
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['name' => $name, 'email' => $email, 'id' => $id]);
}

// Supprimer un utilisateur
function deleteUser($pdo, $id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
}

// Définir les en-têtes HTTP
function setHeaders() {
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
}

// Connexion à la base de données
$pdo = connectDB();

// Traitement de la requête HTTP
$method = $_SERVER['REQUEST_METHOD'];
setHeaders();

switch($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Récupérer un utilisateur spécifique
            $user = getUserById($pdo, $_GET['id']);
            echo json_encode($user);
        } else {
            // Récupérer tous les utilisateurs
            $users = getAllUsers($pdo);
            echo json_encode($users);
        }
        break;

    case 'POST':
        // Créer un nouvel utilisateur
        $data = json_decode(file_get_contents('php://input'), true);
        $newUserId = createUser($pdo, $data['name'], $data['email']);
        http_response_code(201);  // 201 Created
        echo json_encode(['id' => $newUserId]);
        break;

    case 'PUT':
        // Mettre à jour un utilisateur existant
        $data = json_decode(file_get_contents('php://input'), true);
        updateUser($pdo, $data['id'], $data['name'], $data['email']);
        http_response_code(200);  // 200 OK
        echo json_encode(['message' => 'User updated successfully']);
        break;

    case 'DELETE':
        // Supprimer un utilisateur
        if (isset($_GET['id'])) {
            deleteUser($pdo, $_GET['id']);
            http_response_code(200);  // 200 OK
            echo json_encode(['message' => 'User deleted successfully']);
        } else {
            http_response_code(400);  // 400 Bad Request
            echo json_encode(['message' => 'User ID is required']);
        }
        break;

    default:
        // Méthode non supportée
        http_response_code(405);  // 405 Method Not Allowed
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
?>
