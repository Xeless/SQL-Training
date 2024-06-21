<?php
require 'login.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT * FROM hiking WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $hike = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$hike) {
            throw new Exception('Randonnée non trouvée.');
        }
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
        exit();
    }
} else {
    echo 'Erreur : ID de randonnée manquant.';
    exit();
}

// Vérification que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $distance = $_POST['distance'];
    $difficulty = $_POST['difficulty'];
    $duration = $_POST['duration'];
    $height_difference = $_POST['height_difference'];

    try {
        // Préparation de la requête SQL pour la mise à jour
        $stmt = $pdo->prepare('UPDATE hiking SET name = :name, distance = :distance, difficulty = :difficulty, duration = :duration, height_difference = :height_difference WHERE id = :id');
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':height_difference', $height_difference);

        // Exécution de la requête
        $stmt->execute();

        // Redirection vers la page des randonnées après la modification
        header('Location: read.php');
        exit();
    } catch(PDOException $e) {
        // Gestion des erreurs PDO
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modifier la randonnée</title>
    <link rel="stylesheet" href="../css/styles.css" media="screen" title="no title" charset="utf-8">
</head>
<header>
    <a href="read.php">Liste des Randonnées</a>
    <a href="create.php">Créer</a>
    <a href="update.php">Modifier la randonnée</a>
</header>
<body>
    <h1>Modifier la Randonnée</h1>
    <form action="update.php?id=<?php echo htmlspecialchars($hike['id']); ?>" method="post">
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($hike['name']); ?>" required>
        </div>
        <div>
            <label for="difficulty">Difficulté</label>
            <select name="difficulty" required>
                <option value="très facile" <?php if($hike['difficulty'] == 'très facile') echo 'selected'; ?>>Très facile</option>
                <option value="facile" <?php if($hike['difficulty'] == 'facile') echo 'selected'; ?>>Facile</option>
                <option value="moyen" <?php if($hike['difficulty'] == 'moyen') echo 'selected'; ?>>Moyen</option>
                <option value="difficile" <?php if($hike['difficulty'] == 'difficile') echo 'selected'; ?>>Difficile</option>
                <option value="très difficile" <?php if($hike['difficulty'] == 'très difficile') echo 'selected'; ?>>Très difficile</option>
            </select>
        </div>
        <div>
            <label for="distance">Distance</label>
            <input type="text" name="distance" value="<?php echo htmlspecialchars($hike['distance']); ?>" required>
        </div>
        <div>
            <label for="duration">Durée</label>
            <input type="text" name="duration" value="<?php echo htmlspecialchars($hike['duration']); ?>" required>
        </div>
        <div>
            <label for="height_difference">Dénivelé</label>
            <input type="text" name="height_difference" value="<?php echo htmlspecialchars($hike['height_difference']); ?>" required>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
