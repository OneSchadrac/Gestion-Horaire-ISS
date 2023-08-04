<?php 

require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');
        
#Recherche de l'anneée Actuelle
for ($i = 0; $i < 8760; $i = $i + 8760) {
    $date = Date("20" . "y", time() + $i * 3600);
}
    #-1 c'est pour trouver l'année academique actuelle, Nous sommes en 2023 Mais c'est L'année Acad 2022, 
    #Donc il faut faire 2023-1
$A = $date - 1;
$AnneeAcad = isset($_GET['AnneeAcad']) ? $_GET['AnneeAcad'] : $A;


#RECHERCHE DU DEPARTEMENT SELECTIONNé-->
$Cours = isset($_GET['Cours']) ? $_GET['Cours'] : "";

    #RECHERCHE DU DEPARTEMENT SELECTIONNé-->
    $req9 = $pdo->prepare('SELECT * FROM Departement');
    $req9->execute();

    $Departement = isset($_GET['Departement']) ? $_GET['Departement'] : 1;
    $req8 = $pdo->prepare("SELECT * FROM Departement WHERE Id_Depart='$Departement'");
    $req8->execute();
    $D = $req8->fetch();

    #RECHERCHE DE LA PROMOTION SELECTIONNéE-->
    $req1 = $pdo->prepare('SELECT * FROM Promotion');
    $req1->execute();

    $Promo = isset($_GET['Promotion']) ? $_GET['Promotion'] : "G1";
    $req4 = $pdo->prepare("SELECT * FROM Promotion WHERE Nom_Promo='$Promo'");
    $req4->execute();
    $P = $req4->fetch();

        #RECHERCHE DU JOUR SELECTIONNé-->
    $req3 = $pdo->prepare('SELECT * FROM Jours GROUP BY Jour Asc');
    $req3->execute();

    $Jour = isset($_GET['Jour']) ? $_GET['Jour'] : "Lundi";
    $req5 = $pdo->prepare("SELECT * FROM Jours WHERE Jour='$Jour'");
    $req5->execute();
    $Jr = $req5->fetch();

        #RECHERCHE DE L'HEURE SELECTIONNéE-->

    $req6 = $pdo->prepare('SELECT * FROM Heures');
    $req6->execute();

    $Heure = isset($_GET['Heure']) ? $_GET['Heure'] : "14H00-17H00";
    $req7 = $pdo->prepare("SELECT * FROM Heures WHERE Heure='$Heure'");
    $req7->execute();
    $Hr = $req7->fetch();
?>

<?php
require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

$req2 = $pdo->prepare("SELECT * FROM Horaire, Enseignant, Cours, Promotion, Departement
                WHERE Enseignant . matricule_ens = Cours . matricule_ens 
                AND Horaire . Id_Cours = Cours .Id_Cours
                AND Cours . Id_Promo = Promotion . Id_Promo
                AND Promotion . Id_Depart = Departement . Id_Depart
                AND Promotion . Nom_promo = '$Promo'
                AND Departement . Id_Depart='$Departement'
                AND Horaire . Heure = '14H00-17H00'
                AND Horaire . Jour = '$Jour'
                AND Horaire  . AnneeA LIKE '$AnneeAcad%'
                AND Cours . Nom_Cours LIKE '%$Cours%'");

$req2->execute();
$horaire2 = $req2->fetch();


?>