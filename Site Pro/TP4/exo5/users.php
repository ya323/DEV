<?php
require_once('init_db.php');

// Connexion à la base de données
$pdo = connectDB();
setHeaders();

// Gestion des requêtes HTTP
$method = $_SERVER['REQUEST_METHOD'];
switch($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Récupérer un utilisateur spécifique
            $user = getUserById($pdo, $_GET['id']);
            if ($user) {
                echo json_encode($user);
            } else {
                http_response_code(404);  // 404 Not Found
                echo "404 Not Found";
            }
        } else {
            // Récupérer tous les utilisateurs
            $users = getAllUsers($pdo);
            echo json_encode($users);
        }
        break;

    case 'POST':
        // Créer un nouvel utilisateur
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['name']) && isset($data['email'])) {
            $newUserId = createUser($pdo, $data['name'], $data['email']);
            http_response_code(201);  // 201 Created
            echo json_encode(['id' => $newUserId, 'message' => 'User created successfully']);
        } else {
            http_response_code(400);  // 400 Bad Request
            echo json_encode(['message' => 'Invalid input']);
        }
        break;

    case 'PUT':
        // Mettre à jour un utilisateur existant
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && isset($data['name']) && isset($data['email'])) {
            updateUser($pdo, $data['id'], $data['name'], $data['email']);
            http_response_code(200);  // 200 OK
            echo json_encode(['message' => 'User updated successfully']);
        } else {
            http_response_code(400);  // 400 Bad Request
            echo json_encode(['message' => 'Invalid input']);
        }
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
        http_response_code(405);  // 405 Method Not Allowed
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
?>

