<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {


    require 'login.php';

    $name = $_POST['name'];
    $difficulty = $_POST['difficulty'];
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $height_difference = $_POST['height_difference'];
}

try{
    $db = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo-> prepare('INSERT INTO hiking (name , difficulty, distance , duration , height_difference) 
    VALUES (:name, :difficulty,:distance,:duration, :height_difference)');

    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':difficulty',$difficulty);
    $stmt->bindParam(':distance',$distance);
    $stmt->bindParam(':duration',$duration);
    $stmt->bindParam(':height_difference',$height_difference);

    $stmt->execute();

    header('Location: read.php');
        exit();

}catch(PDOException $e){

}

?>