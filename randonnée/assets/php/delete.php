<?php
require 'login.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('DELETE FROM hiking WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Redirection vers la page read.php après suppression
            header('Location: read.php');
            exit();
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            exit();
        }
    } else {
        echo 'Erreur : ID de randonnée manquant.';
        exit();
    }
} else {
    echo 'Méthode de requête non autorisée.';
    exit();
}
?>
