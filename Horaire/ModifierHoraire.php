<!-- SELECTION TOUTES LES PROMOTIONS ET TOUTES LES ANNEE ACADEMIQUES -->
<?php
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $req1=$pdo->prepare('SELECT * FROM Promotion');
    $req2=$pdo->prepare('SELECT * FROM AnneeAcad');
    $req1->execute();
    $req2->execute();

?>

<?php
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\RecheCoursHor.php');
?>

<!--RECHERCHE DE LA PROMOTION SELECTIONNéE-->
<?php
    $Promo = isset($_GET['Promotion']) ? $_GET['Promotion'] : "Vide";
    $req4=$pdo->prepare("SELECT * FROM Promotion WHERE Id_Promo='$Promo'");
    $req4->execute(); 
    $P=$req4->fetch();

    $Departement = isset($_GET['Departement']) ? $_GET['Departement'] : "Vide";
    $req10=$pdo->prepare("SELECT * FROM Departement");
    $req10->execute();
?>
<!-- RECHERCHE DE L'ANNEE ACADEMIQUE ACTUELLE -->
<?php

    //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET['Accueil']) ? $_GET['Accueil'] : 0;
    $Cours1 = isset($_GET['Cours1']) ? $_GET['Cours1'] : 0;
    $ModifierHoraire = isset($_GET['ModifierHoraire']) ? $_GET['ModifierHoraire'] : 2;
    $General = isset($_GET['General']) ? $_GET['General'] : 0;

    $An = isset($_GET['Annee']) ? $_GET['Annee'] : "Vide";

    #ANNEE ACTUELLE
    $Annee1=date('Y');
    #ANNEE ACTUELLE
    $req5=$pdo->prepare("SELECT * FROM AnneeAcad WHERE AnneeA LIKE '%-$Annee1'");
    $req5->execute();
    $AnneeAcad=$req5->fetch();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modifier l'horaire de cours</title>
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
                                    Modification de l'horaire de cours  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp
                                    Année Académique 
                                    (
                                        <?php
                                            // Ce code Affiche Année Actuelle - 1 et "-" ainsi que Annee Actuelle
                                            $AnneeCool= $Annee1 - 1 . '-' . $Annee1;
                                            echo $AnneeCool;
                                        ?>
                                    )
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="ModifierHoraire.php" class="form-inline">
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
                                                <option value="">Vide</option>
                                                <option value="G1" <?php if ($Promo == "G1") echo "selected"; ?>>G1</option>
                                                <option value="G2" <?php if ($Promo == "G2") echo "selected"; ?>>G2</option>
                                                <option value="G3" <?php if ($Promo == "G3") echo "selected"; ?>>G3</option>
                                                <option value="L1" <?php if ($Promo == "L1") echo "selected"; ?>>L1</option>
                                                <option value="L2" <?php if ($Promo == "L2") echo "selected"; ?>>L2</option>
                                        </select>
                                </div>
                                    <!-- Rechercher Par Departement -->
                                    <div class="col-md-4 form-group">
                                        
                                        <label for="Departement"><h5 style="font-family: monospace">Département</h5></label>
                                            <select class=" form-control custom-select d-block w-100" name="Departement" id="Departement" onchange="this.form.submit()" required>
                                                <option value="">Vide</option>
                                                <?php while ($Departement1 = $req10->fetch()) { ?>
                                                    <option value="<?php $Depart = $Departement1['Id_Depart']; echo $Depart ?>" <?php if ($Departement === $Depart) echo "selected"; ?>>
                                                        <?php echo $Departement1['Nom_Depart']; ?>
                                                    </option>
                                                <?php  } ?>
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
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Lundi" name="Jour" hidden>
                                                <input type="text" value="08H00-11H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqL1->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Mardi" name="Jour" hidden>
                                                <input type="text" value="08H00-11H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqM1->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Mercredi" name="Jour" hidden>
                                                <input type="text" value="08H00-11H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqME1->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Jeudi" name="Jour" hidden>
                                                <input type="text" value="08H00-11H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqJ1->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Vendredi" name="Jour" hidden>
                                                <input type="text" value="08H00-11H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqV1->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Samedi" name="Jour" hidden>
                                                <input type="text" value="08H00-11H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqS1->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 style="color:green">11H00-14H00</h6></td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Lundi" name="Jour" hidden>
                                                <input type="text" value="11H00-14H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqL2->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Mardi" name="Jour" hidden>
                                                <input type="text" value="11H00-14H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqM2->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Mercredi" name="Jour" hidden>
                                                <input type="text" value="11H00-14H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqME2->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Jeudi" name="Jour" hidden>
                                                <input type="text" value="11H00-14H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqJ2->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Vendredi" name="Jour" hidden>
                                                <input type="text" value="11H00-14H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqV2->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Samedi" name="Jour" hidden>
                                                <input type="text" value="11H00-14H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqS2->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 style="color:green">14H00-17H00</h6></td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Lundi" name="Jour" hidden>
                                                <input type="text" value="14H00-17H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqL3->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Mardi" name="Jour" hidden>
                                                <input type="text" value="14H00-17H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqM3->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Mercredi" name="Jour" hidden>
                                                <input type="text" value="14H00-17H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqME3->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Jeudi" name="Jour" hidden>
                                                <input type="text" value="14H00-17H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqJ3->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Vendredi" name="Jour" hidden>
                                                <input type="text" value="14H00-17H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqV3->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 sm-12">
                                            <form method="POST" action="SaveHoraire.php" class="form-inline">
                                                <input type="text" value="Samedi" name="Jour" hidden>
                                                <input type="text" value="14H00-17H00" name="Heure" hidden>
                                                <input type="text" value="<?php echo $AnneeCool ?>" name="Annee" hidden>
                                                <input type="text" value="<?php echo $Promo ?>" name="Promotion" hidden>
                                                <input type="text" value="<?php echo $Departement ?>" name="Departement" hidden>
                                                <select class=" form-control custom-select d-block w-100" name="Cours" required>
                                                    <option value="">Vide</option>
                                                    <?php while ($Cours = $reqS3->fetch()) { ?>
                                                        <option value="<?php echo $Cours['Id_Cours']; ?>">
                                                            <?php echo $Cours['Nom_Cours']; ?>
                                                        </option>
                                                    <?php 
                                                } ?>
                                                </select>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="submit">
                                                        <!--Icon de modification-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        <div>
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