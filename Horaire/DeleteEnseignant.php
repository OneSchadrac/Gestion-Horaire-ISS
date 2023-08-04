<?php
    $Matricule =$_GET['Matricule_Ens'];

    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $req = $pdo->prepare("SELECT * FROM Cours WHERE Matricule_Ens=?");
    $params = array($Matricule);
    $req->execute($params);
    $Reponse = $req->fetch();

    if($Reponse['Matricule_Ens'] == $Matricule){
        header("location:..\Message\SuppressionImpoEns.php"); 
    } else {
        $req1 = $pdo->prepare('DELETE FROM Enseignant WHERE Matricule_Ens=?');
        $params = array($Matricule);
        $req1->execute($params);
        header("location:..\Message\SuppressionEffect.php"); 
    }
    
?>