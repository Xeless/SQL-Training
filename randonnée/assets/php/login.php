<?php
$dsn = 'mysql:host=localhost;dbname=randonne;charset=utf8';
$username = 'root'; // Change this to your database username
$password = '';     // Change this to your database password

try {
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->prepare('SELECT * FROM hiking');
    $stmt->execute();

    $hiking = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e) {

    
}

?>