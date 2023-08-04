<!-- RECHERCHE DES COURS PAR PROMOTION -->

<?php 
require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');
require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\ModifierHoraire.php');
    
    $Promo = isset($_GET['Promotion']) ? $_GET['Promotion'] : "Vide";
    $Departement = isset($_GET['Departement']) ? $_GET['Departement'] : "Vide";
    
    
    $reqL1=$pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqL2 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqL3 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqM1 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqM2 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqM3 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqME1 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqME2 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqME3 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqJ1 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqJ2 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqJ3 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqV1 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqV2 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqV3 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqS1 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqS2 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");
    $reqS3 = $pdo->prepare("SELECT * FROM Cours, Enseignant, Promotion WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens and Cours . Id_Promo = Promotion . Id_Promo and Promotion . Nom_Promo = '$Promo' and Promotion . Id_Depart = '$Departement'");


    $reqL1->execute();
    $reqL2->execute();
    $reqL3->execute();
    $reqM1->execute();
    $reqM2->execute();
    $reqM3->execute();
    $reqME1->execute();
    $reqME2->execute();
    $reqME3->execute();
    $reqJ1->execute();
    $reqJ2->execute();
    $reqJ3->execute();
    $reqV1->execute();
    $reqV2->execute();
    $reqV3->execute();
    $reqS1->execute();
    $reqS2->execute();
    $reqS3->execute();

?>