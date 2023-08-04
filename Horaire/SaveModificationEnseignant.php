<?php
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

$Matricule = $_POST['Matricule'];
$Nom = $_POST['Nom'];
$Postnom = $_POST['Postnom'];
$Prenom = $_POST['Prenom'];
$Grade = $_POST['Grade'];
$Telephone = $_POST['Telephone'];


$req1 = $pdo->prepare('UPDATE Enseignant SET Nom_Ens=?, Postnom_Ens=?, Prenom_Ens=?, Grade_Ens=?, Telephone_Ens=? WHERE Matricule_Ens=?');
$params = array($Nom, $Postnom, $Prenom, $Grade, $Telephone, $Matricule);
$req1->execute($params);

header("location:Enseignant.php");

?>