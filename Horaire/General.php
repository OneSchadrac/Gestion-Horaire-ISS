<?php

    #ANNEE ACTUELLE
    $Annee1 = date('Y');
    $AnneeCool = $Annee1 - 1 . '-' . $Annee1;
    #ANNEE ACTUELLE

    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $Promotion = isset($_GET['Promotion']) ? $_GET['Promotion'] : "G1";
    $req4=$pdo->prepare("SELECT * FROM Promotion WHERE Id_Promo='$Promotion'");
    $req4->execute(); 

    $Departement = isset($_GET['Departement']) ? $_GET['Departement'] : 1;
    $req10=$pdo->prepare("SELECT * FROM Departement");
    $req10->execute();

        //APPEL DE LA RECHERCHE DE COURS SUR L'HORAIRE ACTUEL
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\RecHorGlob.php');

        //RECHERCHEZ A SUPPRIMER DANS L'HORAIRE
    $reqC = $pdo->prepare(" SELECT * FROM Horaire, Cours, Promotion, Departement
                                WHERE Horaire . Id_Cours = Cours .Id_Cours
                                AND Cours . Id_Promo = Promotion . Id_Promo
                                AND Promotion . Id_Depart = Departement . Id_Depart
                                AND Promotion . Nom_promo = '$Promotion'
                                AND Departement . Id_Depart='$Departement'
                                AND Horaire  . AnneeA LIKE '$AnneeCool%'
                                GROUP BY Horaire . Id_Cours");
    $reqC->execute();

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
    <!-- IMPRESSION -->
    <script type="text/javascript">
        function Imprimer() {
            window.print();
        }
    </script>
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
                        <div class="row">
                            <div class="col-md-7 form-group">
                                <form method="GET" action="General.php" class="form-inline">
                                    <div class="row">
                                        <table>
                                         <thead>
                                            <tr>
                                                <td>
                                                    <label for="Promotion"><h6 style="font-family: monospace; margin-left:10px">Promotion</h6></label>
                                                </td>
                                                <td>
                                                    <label for="Departement"><h6 style="font-family: monospace">Département</h6></label>
                                                </td>
                                            </tr>
                                            <tr >
                                                <td>
                                                    <div class="col-md- form-group" style="margin-left:10px">
                                                        <select class=" form-control custom-select d-block w-100" name="Promotion" id="Promotion" onchange="this.form.submit()" required>                    
                                                            <!-- <option value="">Vide</option> -->
                                                            <option value="G1" <?php if ($Promotion == "G1") echo "selected"; ?>>G1</option>
                                                            <option value="G2" <?php if ($Promotion == "G2") echo "selected"; ?>>G2</option>
                                                            <option value="G3" <?php if ($Promotion == "G3") echo "selected"; ?>>G3</option>
                                                            <option value="L1" <?php if ($Promotion == "L1") echo "selected"; ?>>L1</option>
                                                            <option value="L2" <?php if ($Promotion == "L2") echo "selected"; ?>>L2</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-8 form-group">
                                                        <select class=" form-control custom-select d-block w-100" name="Departement" id="Departement" onchange="this.form.submit()" required>
                                                            <!-- <option value="">Vide</option> -->
                                                            <?php while ($Departement1 = $req10->fetch()) { ?>
                                                            <option value="<?php $Depart = $Departement1['Id_Depart'];
                                                                            echo $Depart ?>" <?php if ($Departement === $Depart) echo "selected"; ?>>
                                                                <?php echo $Departement1['Nom_Depart']; ?>
                                                            </option> <?php 
                                                                    } ?>
                                                        </select>
                                                    </DIV>
                                                </td>
                                            </tr>
                                        </thead>
                                        </table>
                                    </div>
                                </form>
                            </div> 
                            <div class="col-md-5 form-group">
                                <form method="GET" action="DeleteHor.php" class="form-inline">
                                    <div class="row">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td colspan="3">
                                                        <label for="CoursF"><h6 style="font-family: monospace">Retirez un Cours fini </h6></label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> 
                                                        <div class="col-md- form-group">
                                                            <select class=" form-control custom-select d-block w-100" name="CoursF" id="CoursF" required>
                                                                <option value="">Aucun</option>
                                                                    <?php while ($CoursF = $reqC->fetch()) { ?>
                                                                <option value="<?php $C = $CoursF['Id_Cours']; echo $C ?>">
                                                                    <?php echo $CoursF['Nom_Cours']; ?>
                                                                </option> <?php } ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md- form-group">
                                                            <button type="submit" class="btn btn-primary" role="button">
                                                                
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                                    <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="button" class="btn btn-secondary" role="button" style="margin-left:20px" value="Imprimer" Onclick="Imprimer()"></input>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                                            <strong>
                                                <?php $L1 = $Res1->fetch(); echo $L1['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L1['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L12 = $Res2->fetch(); echo $L12['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L12['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L13 = $Res3->fetch(); echo $L13['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L13['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L14 = $Res4->fetch(); echo $L14['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L14['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L15 = $Res5->fetch(); echo $L15['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L15['Nom_Cours']=="") { echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L16 = $Res6->fetch(); echo $L16['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L16['Nom_Cours']=="") { echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 style="color:green">11H00-14H00</h6></td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L10 = $Res10->fetch(); echo $L10['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L10['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L120 = $Res20->fetch(); echo $L120['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L120['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L130 = $Res30->fetch(); echo $L130['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L130['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L140 = $Res40->fetch(); echo $L140['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L140['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L150 = $Res50->fetch(); echo $L150['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L150['Nom_Cours']=="") { echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L160 = $Res60->fetch(); echo $L160['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L160['Nom_Cours']=="") { echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 style="color:green">14H00-17H00</h6></td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L100 = $Res100->fetch(); echo $L100['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L100['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L1200 = $Res200->fetch(); echo $L1200['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L1200['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L1300 = $Res300->fetch(); echo $L1300['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L1300['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L1400 = $Res400->fetch(); echo $L1400['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L1400['Nom_Cours']==""){ echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L1500 = $Res500->fetch(); echo $L1500['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L1500['Nom_Cours']=="") { echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <strong>
                                                <?php $L1600 = $Res600->fetch(); echo $L1600['Nom_Cours']; ?>
                                                <small style="color:red"><?php if($L1600['Nom_Cours']=="") { echo "Vide"; } ?></small>
                                            </strong>
                                        </div>
                                    </td>
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