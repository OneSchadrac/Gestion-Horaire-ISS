<?php

    #ANNEE ACTUELLE
$Annee1 = date('Y');
$AnneeCool = $Annee1 - 1 . '-' . $Annee1;
    #ANNEE ACTUELLE

require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

$Promotion = isset($_GET['Promotion']) ? $_GET['Promotion'] : "G1";
$req4 = $pdo->prepare("SELECT * FROM Promotion WHERE Id_Promo='$Promotion'");
$req4->execute();

$Departement = isset($_GET['Departement']) ? $_GET['Departement'] : 1;
$req10 = $pdo->prepare("SELECT * FROM Departement");
$req10->execute();

$Res1 = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'");
$Res1->execute();

        //GESTION DE LA BARRE DE NAVIGATION
$Accueil = isset($_GET['Accueil']) ? $_GET['Accueil'] : 0;
$Cours1 = isset($_GET['Cours1']) ? $_GET['Cours1'] : 0;
$ModifierHoraire = isset($_GET['ModifierHoraire']) ? $_GET['ModifierHoraire'] : 0;
$General = isset($_GET['General']) ? $_GET['General'] : 4;


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Horaire général des cours</title>
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
                                     Horaire général des cours  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                    Année Académique 
                                    (
                                        <?php
                                            // Ce code Affiche Année Actuelle - 1 et "-" ainsi que Annee Actuelle
                                        echo $AnneeCool;
                                        ?>
                                    )
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="General.php" class="form-inline">
                            <div class="row">
                                <!-- Affichage de la Promotion et Du Departement -->
                                <div class="col-md-2 form-group">
                                    <h4>
                                        
                                    </h4>
                                </div>
                                <!-- Rechercher Par Promotion -->
                                <div class="col-md-4 form-group">
                                    <label for="Promotion"><h5 style="font-family: monospace">Promotion</h5></label>
                                        <select class=" form-control custom-select d-block w-100" name="Promotion" id="Promotion" onchange="this.form.submit()" required>                    
                                                <!-- <option value="">Vide</option> -->
                                                <option value="G1" <?php if ($Promotion == "G1") echo "selected"; ?>>G1</option>
                                                <option value="G2" <?php if ($Promotion == "G2") echo "selected"; ?>>G2</option>
                                                <option value="G3" <?php if ($Promotion == "G3") echo "selected"; ?>>G3</option>
                                                <option value="L1" <?php if ($Promotion == "L1") echo "selected"; ?>>L1</option>
                                                <option value="L2" <?php if ($Promotion == "L2") echo "selected"; ?>>L2</option>
                                        </select>
                                </div>
                                    <!-- Rechercher Par Departement -->
                                    <div class="col-md-4 form-group">
                                        
                                        <label for="Departement"><h5 style="font-family: monospace">Département</h5></label>
                                            <select class=" form-control custom-select d-block w-100" name="Departement" id="Departement" onchange="this.form.submit()" required>
                                                <!-- <option value="">Vide</option> -->
                                                <?php while ($Departement1 = $req10->fetch()) { ?>
                                                    <option value="<?php $Depart = $Departement1['Id_Depart'];
                                                                    echo $Depart ?>" <?php if ($Departement === $Depart) echo "selected"; ?>>
                                                        <?php echo $Departement1['Nom_Depart']; ?>
                                                    </option>
                                                <?php 
                                            } ?>
                                            </select>
                                    </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                     <th>
                                        <h8 style="color:green">Heures</h8> \ <h8 style="color:blue">Jours</h8>
                                     </th>
                                    <th><h6 style="color:blue">LUNDI</h6></th> <th><h6 style="color:blue">MARDI</h6></th> <th><h6 style="color:blue">MERCREDI</h6></th> <th><h6 style="color:blue">JEUDI</h6></th> <th><h6 style="color:blue">VENDREDI</h6></th> <th><h6 style="color:blue">SAMEDI</h6></th>
                                </tr>
                            <thead>
                            <tbody>
                                <tr>
                                    <td><h6 style="color:green">08H00-11H00</h6></td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong><?php while ($L1L = $Res1->fetch()) { ?>
                                                <?php 
                                                if ($L1L['Jour'] == "Lundi" and $L1L['Heure'] == "08H00-11H00") {
                                                    echo $L1L['Nom_Cours'];
                                                    break;
                                                } else {
                                                    ?> <smoll style="Color:red"><?php echo "Vide";
                                                                                break; ?> </smoll><?php

                                                                                                                }
                                                                                                                ?>
                                            <?php 
                                        } ?></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong><?php while ($L1M = $Res1->fetch()) { ?>
                                                <?php 
                                                if ($L1M['Jour'] == "Mardi" and $L1M['Heure'] == "08H00-11H00") {
                                                    echo $L1M['Nom_Cours'];
                                                    break;
                                                } else {
                                                    ?> <small style="Color:red"><?php echo "Vide";
                                                                                break; ?> </small><?php

                                                                                                                }
                                                                                                                ?>
                                            <?php 
                                        } ?></strong>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong><?php while ($L1E = $Res1->fetch()) { ?>
                                                <?php 
                                                if ($L1E['Jour'] == "Mercerdi" and $L1E['Heure'] == "08H00-11H00") {
                                                    echo $L1E['Nom_Cours'];
                                                    break;
                                                } else {
                                                    ?> <smoll style="Color:red"><?php echo "Vide";
                                                                                break; ?> </smoll><?php

                                                                                                                }
                                                                                                                ?>
                                            <?php 
                                        } ?></strong>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong><?php while ($L1J = $Res1->fetch()) { ?>
                                                <?php 
                                                if ($L1J['Jour'] == "Jeudi" and $L1J['Heure'] == "08H00-11H00") {
                                                    echo $L1J['Nom_Cours'];
                                                    break;
                                                } else {
                                                    ?> <smoll style="Color:red"><?php echo "Vide";
                                                                                break; ?> </smoll><?php

                                                                                                                }
                                                                                                                ?>
                                            <?php 
                                        } ?></strong>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong><?php while ($L1V = $Res1->fetch()) { ?>
                                                <?php 
                                                if ($L1V['Jour'] == "Vendredi" and $L1V['Heure'] == "08H00-11H00") {
                                                    echo $L1V['Nom_Cours'];
                                                    break;
                                                } else {
                                                    ?> <smoll style="Color:red"><?php echo "Vide";
                                                                                break; ?> </smoll><?php

                                                                                                                }
                                                                                                                ?>
                                            <?php 
                                        } ?></strong>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong><?php while ($L1S = $Res1->fetch()) { ?>
                                                <?php 
                                                if ($L1S['Jour'] == "Samedi" and $L1S['Heure'] == "08H00-11H00") {
                                                    echo $L1S['Nom_Cours'];
                                                    break;
                                                } else {
                                                    ?> <smoll style="Color:red"><?php echo "Vide";
                                                                                break; ?> </smoll><?php

                                                                                                                }
                                                                                                                ?>
                                            <?php 
                                        } ?></strong>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 style="color:green">11H00-14H00</h6></td>
                                </tr>
                                <tr>
                                    <td><h6 style="color:green">14H00-17H00</h6></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>