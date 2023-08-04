<?php 
require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $Matricule = $_POST['Matricule'];
    $Nom = $_POST['Nom'];
    $Postnom = $_POST['Postnom'];
    $Prenom = $_POST['Prenom'];
    $Grade = $_POST['Grade'];
    $Telephone = $_POST['Telephone'];

    $req1 = $pdo->prepare('INSERT INTO Enseignant(Matricule_Ens, Nom_Ens, Postnom_Ens, Prenom_Ens, Grade_Ens, Telephone_Ens) VALUES (?,?,?,?,?,?)');
    $params = array($Matricule, $Nom, $Postnom, $Prenom, $Grade, $Telephone);
    $req1->execute($params);
    
    header("location:Enseignant.php");
?>