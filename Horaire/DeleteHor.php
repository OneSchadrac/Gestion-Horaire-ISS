<?php

    $CoursF = isset($_GET['CoursF']) ? $_GET['CoursF'] : "01";

    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $reqC = $pdo->prepare('DELETE FROM Horaire  WHERE horaire . Id_Cours = ?');
    $params = array($CoursF);
    $reqC->execute($params);
    header("location:..\Message\SuppressionEffectHor.php"); 
?>