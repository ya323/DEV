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

// Créer un utilisateur (CREATE)
function createUser($pdo, $name, $email) {
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['name' => $name, 'email' => $email]);
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

// Vérifier les actions CRUD à partir des paramètres de la requête
$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        createUser($pdo, $_POST['name'], $_POST['email']);
    } elseif (isset($_POST['update'])) {
        updateUser($pdo, $_POST['id'], $_POST['name'], $_POST['email']);
    } elseif (isset($_POST['delete'])) {
        deleteUser($pdo, $_POST['id']);
    }
}

$users = getAllUsers($pdo);
?>

<!-- Formulaire HTML pour les actions CRUD -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
</head>
<body>
    <h1>Liste des Utilisateurs</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <!-- Formulaire de mise à jour -->
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <input type="text" name="name" value="<?= $user['name'] ?>" required>
                        <input type="email" name="email" value="<?= $user['email'] ?>" required>
                        <button type="submit" name="update">Modifier</button>
                    </form>

                    <!-- Formulaire de suppression -->
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="submit" name="delete">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Ajouter un nouvel utilisateur</h2>
    <form method="POST">
        <label for="name">Nom :</label>
        <input type="text" name="name" required><br>
        <label for="email">Email :</label>
        <input type="email" name="email" required><br>
        <button type="submit" name="create">Ajouter</button>
    </form>
</body>
</html>

