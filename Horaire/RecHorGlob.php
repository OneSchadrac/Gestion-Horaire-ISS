<?php 
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');
    $Res1 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '08H00-11H00'
                                AND Horaire . Jour = 'Lundi'");
    $Res2 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '08H00-11H00'
                                AND Horaire . Jour = 'Mardi'");
    $Res3 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '08H00-11H00'
                                AND Horaire . Jour = 'Mercredi'");
    $Res4 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '08H00-11H00'
                                AND Horaire . Jour = 'Jeudi'");
    $Res5 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '08H00-11H00'
                                AND Horaire . Jour = 'Vendredi'");
    $Res6 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '08H00-11H00'
                                AND Horaire . Jour = 'Samedi'");
    $Res1->execute();
    $Res2->execute();
    $Res3->execute();
    $Res4->execute();
    $Res5->execute();
    $Res6->execute();

    $Res10 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '11H00-14H00'
                                AND Horaire . Jour = 'Lundi'");
    $Res20 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '11H00-14H00'
                                AND Horaire . Jour = 'Mardi'");
    $Res30 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '11H00-14H00'
                                AND Horaire . Jour = 'Mercredi'");
    $Res40 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '11H00-14H00'
                                AND Horaire . Jour = 'Jeudi'");
    $Res50 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '11H00-14H00'
                                AND Horaire . Jour = 'Vendredi'");
    $Res60 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '11H00-14H00'
                                AND Horaire . Jour = 'Samedi'");
    $Res10->execute();
    $Res20->execute();
    $Res30->execute();
    $Res40->execute();
    $Res50->execute();
    $Res60->execute();

    $Res100 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '14H00-17H00'
                                AND Horaire . Jour = 'Lundi'");
    $Res200 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '14H00-17H00'
                                AND Horaire . Jour = 'Mardi'");
    $Res300 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '14H00-17H00'
                                AND Horaire . Jour = 'Mercredi'");
    $Res400 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '14H00-17H00'
                                AND Horaire . Jour = 'Jeudi'");
    $Res500 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '14H00-17H00'
                                AND Horaire . Jour = 'Vendredi'");
    $Res600 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                AND Horaire . Heure = '14H00-17H00'
                                AND Horaire . Jour = 'Samedi'");
    $Res100->execute();
    $Res200->execute();
    $Res300->execute();
    $Res400->execute();
    $Res500->execute();
    $Res600->execute();
?>