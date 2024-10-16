# API REST pour la gestion des utilisateurs

Cette API permet de gérer une liste d'utilisateurs en fournissant les opérations CRUD (Create, Read, Update, Delete).

## Endpoints

### 1. `GET /users.php`
- **Description** : Récupère la liste de tous les utilisateurs.
- **Paramètres** : Aucun.
- **Exemple de réponse** :
  ```json
  [
    {"id": 1, "name": "John Doe", "email": "john@example.com"},
    {"id": 2, "name": "Jane Doe", "email": "jane@example.com"}
  ]
