
<?php
require 'login.php';

try {

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->query('SELECT * FROM shows'); 
    $shows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Liste des Spectacles</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<header>
    <a href="card_fideliter.php">test</a>
</header>
<body>
    <h1>Liste des Spectacles</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Anniversaire</th>
                <th>durée</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($shows)): ?>
            <?php foreach ($shows as $show): ?>
                <tr>
                    <td><?php echo htmlspecialchars($show['id']); ?></td>
                    <td><?php echo htmlspecialchars($show['title']); ?></td>
                    <td><?php echo htmlspecialchars($show['performer']); ?></td>
                    <td><?php echo htmlspecialchars($show['date']); ?></td>
                    <td><?php echo htmlspecialchars($show['duration']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td>Aucun Spectacle trouvé.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>