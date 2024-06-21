



<?php
require './assets/php/login.php';

try {
    // Connexion à la base de données
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation et exécution de la requête SQL pour récupérer les clients
    $stmt = $pdo->query('SELECT * FROM clients'); // Change 'clients' selon le nom de ta table
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit();
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Change selon ton chemin de fichier CSS -->
</head>
<header>
    <a href="assets/php/type_spectacle.php">test</a>
</header>
<body>
    <h1>Liste des Clients</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Anniversaire</th>
                <th>Card</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($clients)): ?>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?php echo htmlspecialchars($client['id']); ?></td>
                    <td><?php echo htmlspecialchars($client['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($client['firstName']); ?></td>
                    <td><?php echo htmlspecialchars($client['birthDate']); ?></td>
                    <td><?php echo htmlspecialchars($client['card']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td>Aucun client trouvé.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>