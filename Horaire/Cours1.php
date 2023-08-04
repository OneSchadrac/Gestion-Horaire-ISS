<?php 
    #PAGINATION
     ################PAGINATION LOGICIEL
$lim1 = isset($_GET['lim1']) ? $_GET['lim1'] : 4;
$page1 = isset($_GET['page1']) ? $_GET['page1'] : 1;
$off1 = ($page1 - 1) * ($lim1);

$Departement = isset($_GET['Departement']) ? $_GET['Departement'] : "All";
$Promotion = isset($_GET['Promotion']) ? $_GET['Promotion'] : "All";
$Cours = isset($_GET['NomCours']) ? $_GET['NomCours'] : "";
$Nom = isset($_GET['Nom']) ? $_GET['Nom'] : "";

require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

if ($Promotion == "All" and $Departement == "All") {
    $requete = "SELECT * FROM cours, Enseignant, Promotion , Departement
                                WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens 
                                AND Promotion . Id_Promo = Cours . id_promo
                                AND Departement . Id_Depart = Promotion . Id_Depart
                                AND Nom_Cours LIKE '%$Cours%'
                                AND Nom_Ens LIKE '%$Nom%'
                                GROUP BY Id_Cours ASC 
                                LIMIT $off1,$lim1";

    $Compteur = "SELECT COUNT(*) CompteCours FROM cours, Enseignant, Promotion , Departement
                                WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens 
                                AND Promotion . Id_Promo = Cours . id_promo
                                AND Departement . Id_Depart = Promotion . Id_Depart
                                AND Nom_Cours LIKE '%$Cours%'
                                AND Nom_Ens LIKE '%$Nom%'";
} elseif ($Promotion == "All" and $Departement != "All") {
    $requete = "SELECT * FROM cours, Enseignant, Promotion , Departement
                                    WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens 
                                    AND Promotion . Id_Promo = Cours . id_promo
                                    AND Departement . Id_Depart = Promotion . Id_Depart
                                    AND Departement . Id_Depart = '$Departement'
                                    AND Nom_Cours LIKE '%$Cours%'
                                    AND Nom_Ens LIKE '%$Nom%'
                                    GROUP BY Id_Cours ASC 
                                    LIMIT $off1,$lim1";

    $Compteur = "SELECT COUNT(*) CompteCours FROM cours, Enseignant, Promotion , Departement
                                    WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens 
                                    AND Promotion . Id_Promo = Cours . id_promo
                                    AND Departement . Id_Depart = Promotion . Id_Depart
                                    AND Departement . Id_Depart = '$Departement'
                                    AND Nom_Cours LIKE '%$Cours%'
                                    AND Nom_Ens LIKE '%$Nom%'";
} elseif ($Promotion != "All" and $Departement == "All") {
    $requete = "SELECT * FROM cours, Enseignant, Promotion , Departement
                                        WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens 
                                        AND Promotion . Id_Promo = Cours . id_promo
                                        AND Departement . Id_Depart = Promotion . Id_Depart
                                        AND Promotion . Nom_Promo='$Promotion'
                                        AND Nom_Cours LIKE '%$Cours%'
                                        AND Nom_Ens LIKE '%$Nom%'
                                        GROUP BY Id_Cours ASC 
                                        LIMIT $off1,$lim1";

    $Compteur = "SELECT COUNT(*) CompteCours FROM cours, Enseignant, Promotion , Departement
                                        WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens 
                                        AND Promotion . Id_Promo = Cours . id_promo
                                        AND Departement . Id_Depart = Promotion . Id_Depart
                                        AND Promotion . Nom_Promo='$Promotion'
                                        AND Nom_Cours LIKE '%$Cours%'
                                        AND Nom_Ens LIKE '%$Nom%'";
} else {
    $requete = "SELECT * FROM cours, Enseignant, Promotion , Departement
                                WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens
                                AND Promotion . Id_Promo = Cours . id_promo
                                AND Departement . Id_Depart = Promotion . Id_Depart
                                AND Promotion . Nom_Promo='$Promotion'
                                AND Departement . Id_Depart = '$Departement'
                                AND Nom_Cours LIKE '%$Cours%'
                                AND Nom_Ens LIKE '%$Nom%' 
                                
                                GROUP BY Id_Cours ASC
                                LIMIT $off1,$lim1";

    $Compteur = "SELECT COUNT(*) CompteCours 
                        FROM cours, Enseignant, Promotion, Departement
                        WHERE Enseignant . Matricule_Ens = Cours . Matricule_Ens
                            AND Promotion . Id_Promo = Cours . id_promo
                            AND Departement . Id_Depart = Promotion . Id_Depart
                            AND Promotion . Nom_Promo='$Promotion'
                            AND Departement . Id_Depart = '$Departement'
                            AND Nom_Cours LIKE '%$Cours%'
                            AND Nom_Ens LIKE '%$Nom%' ";
}
$res1 = $pdo->query($requete);


$ResultatCompte = $pdo->query($Compteur);
$tabCompte = $ResultatCompte->fetch();
$NbreCours = $tabCompte['CompteCours'];

    #PAGINATION ENSEIGNANT
$Reste1 = $NbreCours % $lim1; // Operateur Modulo ou reste de la division
if ($Reste1 == 0) { // Si le nombre d'enseignants est multiple de LIM
    $NbrePage1 = $NbreCours / $lim1;
} else {
    $NbrePage1 = floor($NbreCours / $lim1) + 1; // Floor recupere la partie entiere d'un nombre decimal
}
?>

<!-- SELECTIONNER PROMOTIONS ET ANNEES ACADEMIQUES-->

<?php
    //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET['Accueil']) ? $_GET['Accueil'] : 0;
    $Cours1 = isset($_GET['Cours1']) ? $_GET['Cours1'] : 3;
    $ModifierHoraire = isset($_GET['ModifierHoraire']) ? $_GET['ModifierHoraire'] : 0;
    $General = isset($_GET['General']) ? $_GET['General'] : 0;

require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');
    // Affichage des promotion pour la recherche
$req2 = $pdo->prepare('SELECT * FROM Promotion');
$req2->execute();
    // Affichage des D"partement pour la recherche
$req3 = $pdo->prepare('SELECT * FROM Departement');
$req3->execute();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Liste des cours</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css1/bootstrap.min.css" />
    <script src="main.js"></script>
</head>

<body>
    <!-- Barre de Navigation -->
        <?php require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\NavBarreApp.php'); ?>
    <!--FIN BARRE DE NAVIGATIION-->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:rgb(81, 168, 240);">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <h4>                            
                                </h4>
                            </div>
                            <div class="col-md-8 form-group">
                                <h6 style="color:white">
                                    Recherchez les Cours...  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp
                                    Année Académique 
                                    (
                                        <?php
                                            #ANNEE ACTUELLE
                                        $Annee1 = date('Y');
                                            #ANNEE ACTUELLE
                                            // Ce code Affiche Année Actuelle - 1 et "-" ainsi que Annee Actuelle
                                        $AnneeCool = $Annee1 - 1 . '-' . $Annee1;
                                        echo $AnneeCool;
                                        ?>
                                    )
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="Cours1.php" class="form-inline">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <input type="text" name="NomCours" class="form-control" id="NomCours" value="<?php echo $Cours ?>" placeholder="Nom Cours">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" name="Nom" class="form-control" id="Nom" value="<?php echo $Nom ?>" placeholder="Nom Enseignant">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select class=" form-control custom-select d-block w-100" name="Promotion" id="Promotion" onchange="this.form.submit()">
                                        <option value="All" >Promotions</option>
                                        <option value="G1" <?php if ($Promotion == "G1") echo "selected"; ?>>G1</option>
                                        <option value="G2" <?php if ($Promotion == "G2") echo "selected"; ?>>G2</option>
                                        <option value="G3" <?php if ($Promotion == "G3") echo "selected"; ?>>G3</option>
                                        <option value="L1" <?php if ($Promotion == "L1") echo "selected"; ?>>L1</option>
                                        <option value="L2" <?php if ($Promotion == "L2") echo "selected"; ?>>L2</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <select class=" form-control custom-select d-block w-100" name="Departement" id="Departement" onchange="this.form.submit()">
                                        <option value="All">Departement</option>
                                        <?php while ($Departement1 = $req3->fetch()) { ?>
                                            <option value="<?php $Depart = $Departement1['Id_Depart'];
                                                            echo $Depart ?>" <?php if ($Departement === $Depart) echo "selected"; ?>>
                                                <?php echo $Departement1['Nom_Depart']; ?>
                                            </option>
                                        <?php 
                                    } ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" href="#" role="button">
                                            <!-- icône de la recherche-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>...
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" style="margin-top:20px;">
                    <div class="card-header" style="background-color:rgb(81, 168, 240);">
                        <h6 style="color:white">Liste des Cours [<?php echo $NbreCours ?> Cours]</h6>
                    </div>
                    <div class="card-body">
                         <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Cours</th><th>Cours</th><th>Volume H.</th><th>Promotion</th><th>Département</th><th>Voir l'Enseignant</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($Cours = $res1->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $Cours['Id_Cours']; ?></td>
                                        <td><?php echo $Cours['Nom_Cours']; ?></td>
                                        <td><?php echo $Cours['Volume_Horaire']; ?></td>
                                        <td><?php echo $Cours['Nom_Promo']; ?></td>
                                        <td><?php echo $Cours['Nom_Depart']; ?></td>
                                        <td>
                                            <select class=" form-control custom-select d-block w-100" name="Enseignant" id="Enseignant">
                                                <option value="" >...</option>
                                                <option value="">MATRICULE :<?php echo $Cours['Matricule_Ens']; ?></option>
                                                <option value="">MOM       :<?php echo $Cours['Nom_Ens']; ?></option>
                                                <option value="">POST-NOM  :<?php echo $Cours['PostNom_Ens']; ?></option>
                                                <option value="">PRENOM    :<?php echo $Cours['Prenom_Ens']; ?></option>
                                                <option value="">GRADE     :<?php echo $Cours['Grade_Ens']; ?></option>
                                            </select>
                                        </td>
                                        <td>
                                            <!-- iconne du Calendrier-->
                                            <a href="../Horaire/ModifierHoraire.php?IdCours=<?php echo $Cours['Id_Cours']; ?>" class="btn btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                    <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                                    <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>  
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-8 mb-8">
                                    <ul class="pagination pagination-xs">
                                        <div class="btn-group btn-group-sm">
                                            <!--PAGINATION-->
                                            <?php for ($i1 = 1; $i1 <= $NbrePage1; $i1++) { ?>
                                                <li type="button" class="btn btn-outline-dark <?php if ($i1 == $page1) {
                                                                                                    echo "active";
                                                                                                } ?>">
                                                    <a href="Cours1.php?page1=<?php echo $i1 ?>" style="text-decoration:none;">
                                                        <?php echo "Page " . $i1; ?>
                                                    </a>
                                                </li>
                                            <?php 
                                        } ?>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>