<?php 
require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $IdCours = $_POST['Id_Cours'];
    $NomCours = $_POST['Nom_Cours'];
    $Promotion = $_POST['Promotion'];
    $Matricule = $_POST['Matricule'];
    $VolH = $_POST['VolH'];

/* #CONDITION D'ENREGISTREMENT SI L'ENSEIGNANT EXISTE
    $req3 = $pdo->prepare('SELECT * from Enseignant WHERE Matricule=\'$Matricule\'');
    $req2 = $pdo->prepare('SELECT * FROM COURS, PROMOTION WHERE COURS . Idpromo = PROMOTION . idpromo AND IdCours=\'$IdCours\'');
    $req2->execute();
    $req3->execute();


    $Res = $req2->fetch();
    $Enseignant = $req3->fetch();
 */
    #if ($Matricule != $Enseignant['Matricule']) 
    #{
    /* if ($res['IdCours']==$IdCours) {

        $Msg="Impossible de doubler un cours !!!";
        header("location:Alert.php?message=$Msg");
    }
    else{ */
        $req1 = $pdo->prepare('INSERT INTO Cours(Id_Cours, Nom_Cours, Matricule_Ens, Id_Promo, Volume_Horaire) VALUES (?,?,?,?,?)');
        $params = array($IdCours, $NomCours, $Matricule , $Promotion, $VolH);
        $req1->execute($params);

        header("location:Cours.php");
        
    // }
    
?>