<?php 
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $Promotion= $_POST['Promotion'];
    $Departement = $_POST['Departement'];
    $Heure = $_POST['Heure'];
    $Jour = $_POST['Jour'];
    $Annee = $_POST['Annee'];
    $Cours = $_POST['Cours'];

    /* $req3=$pdo->prepare("SELECT * FROM Horaire");
    $req3->execute();
    $Cours1=$req3->fetch();
    $Id_Cours=$Cours1['Id_Cours']; */

    //Mis à Jour
    $Res1 = $pdo->prepare(" SELECT Id_Horaire FROM Horaire, Cours, Promotion, Departement
                            WHERE Horaire . Id_Cours = Cours .Id_Cours
                            AND Cours . Id_Promo = Promotion . Id_Promo
                            AND Promotion . Id_Depart = Departement . Id_Depart
                            AND Promotion . Nom_promo = '$Promotion'
                            AND Departement . Id_Depart='$Departement'
                            AND Horaire . Heure = '$Heure'
                            AND Horaire . Jour = '$Jour'
                            AND Horaire  . AnneeA LIKE '$Annee%'");
    $Res1->execute();
    $Hor = $Res1->fetch();
    $Id_Horaire = $Hor['Id_Horaire'];

    if ($Id_Horaire == null)
    {
        $req1 = $pdo->prepare(' INSERT INTO Horaire1(Jour, Heure, Id_Cours, AnneeA, Date_Horaire) 
                                VALUES (?,?,?,?,Now())');
        $params = array($Jour, $Heure, $Cours, $Annee);
        $req1->execute($params);

        $req11 = $pdo->prepare('INSERT INTO Horaire(Jour, Heure, Id_Cours, AnneeA, Date_Horaire) 
                                VALUES (?,?,?,?,Now())');
        $params1 = array($Jour, $Heure, $Cours, $Annee);
        $req11->execute($params1);

        header("location:Horaire2.php");
    }
    else
    {
        //INSERT+++
        $Res=$pdo->prepare("SELECT * FROM Horaire WHERE Jour = '$Jour' AND Heure = '$Heure' AND Id_Cours = '$Cours' AND AnneeA = '$Annee'");
        $Res->execute();
        $Ho = $Res->fetch();
        
        if ($Cours == $Ho['Id_Cours']) {
            header("location:..\Message\ImpossibleHor.php");
        } 
        else 
        {
            //Enregistrement
            $req1 = $pdo->prepare(' INSERT INTO Horaire1(Jour, Heure, Id_Cours, AnneeA, Date_Horaire) 
                                    VALUES (?,?,?,?,Now())');
            $params = array($Jour, $Heure, $Cours, $Annee);
            $req1->execute($params);

            ///UPDATE
            $req = $pdo->prepare('UPDATE Horaire SET Jour=?, Heure=?, Id_Cours=?, AnneeA=?, Id_Salle=10, Date_Horaire=Now() WHERE Id_Horaire=?');
            $params1 = array($Jour, $Heure, $Cours, $Annee, $Id_Horaire);
            $req->execute($params1);
            
            header("location:Horaire2.php");
        }
    }
    
?>