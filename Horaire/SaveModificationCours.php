<?php 
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $IdCours = $_POST['Id_Cours'];
    $NomCours = $_POST['Nom_Cours'];
    $Promotion = $_POST['Promotion'];
    $Matricule=$_POST['Matricule'];
    $VolH = $_POST['VolH'];

    $req1 = $pdo->prepare('UPDATE Cours SET Nom_Cours=?, Matricule_Ens=?, Id_Promo=?, Volume_Horaire=? WHERE Id_Cours=?');
    $params = array($NomCours, $Matricule, $Promotion, $VolH, $IdCours);
    $req1->execute($params);

    header("location:Cours.php");
    
?>