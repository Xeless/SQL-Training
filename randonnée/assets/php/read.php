<?php
require 'login.php'; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Document</title>
</head>
<header>
<a href="read.php">List Randonnées</a>
<a href="create.php">create</a>
<a href="update.php">modifier la randonnée</a>
</header>
<body>

<h1>Liste des Randonnées</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Distance (km)</th>
                <th>Difficulté</th>
                <th>Durée</th>
                <th>Dénivelé (m)</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($hiking)): ?>
            <?php foreach ($hiking as $hike): ?>
                <tr>
                <td><?php echo htmlspecialchars($hike['id']); ?></td>
                <td><a href="update.php?id=<?php echo htmlspecialchars($hike['id']); ?>"><?php echo htmlspecialchars($hike['name']); ?></a></td>
                <td><?php echo htmlspecialchars($hike['name']); ?></td>
                <td><?php echo htmlspecialchars($hike['difficulty']); ?></td>
                <td><?php echo htmlspecialchars($hike['distance']); ?></td>
                <td><?php echo htmlspecialchars($hike['duration']); ?></td>
                <td><?php echo htmlspecialchars($hike['height_difference']); ?></td>
                <td>
                        <a href="update.php?id=<?php echo htmlspecialchars($hike['id']); ?>">Modifier</a>
                        <form action="delete.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($hike['id']); ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucune randonnée trouvée.</td>
                </tr>
            <?php endif; ?>

        </tbody>
    
</body>
</html>

