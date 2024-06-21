<?php
require 'login.php';

try {
    // Connexion à la base de données
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation et exécution de la requête SQL pour récupérer les clients
    $stmt = $pdo->query('SELECT * FROM showtypes'); 
    $showtypes = $stmt->fetchAll(PDO::FETCH_ASSOC); // Correction de la variable
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste type spectacle</title>
</head>
<header>
<a href="limit_client.php">test</a>
</header>
<body>
    <h1>Liste type spectacle</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($showtypes)): ?> 
                <?php foreach ($showtypes as $showtype): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($showtype['id']); ?></td>
                        <td><?php echo htmlspecialchars($showtype['type']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Aucun type de spectacle trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
