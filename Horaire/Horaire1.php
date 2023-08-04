<?php
    //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET['Accueil']) ? $_GET['Accueil'] : 1;
    $NCours = isset($_GET['Cours']) ? $_GET['Cours'] : 0;
    $Enseignant = isset($_GET['Enseignant']) ? $_GET['Enseignant'] : 0;
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\Hor8.php');
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\Hor11.php');
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\Hor14.php');
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Horaire de cours</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css1/bootstrap.min.css" />
    <script src="main.js"></script>
</head>

<body>
       <!-- Barre de Navigation -->
       <?php require('C:\wamp\www\My Project\Gestion des Horaires\Horaire\NavBarre.php'); ?>
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
                                    Recherchez l'horaire...  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                             &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp
                                    Année Académique (
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
                            </div></div>
                    </div>
                    <form method="GET" action="Horaire1.php?" class="form-inline">
                        <div class="card-body" style="margin:auto">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <h4>
                                        <?php echo $P['Nom_Promo'] . " " . $D['Nom_Depart'] ?>
                                    </h4>
                                </div>
                                <!-- Rechercher Par Promotion -->
                                <div class="col-md-1 form-group">
                                    <select class=" form-control custom-select d-block w-100" name="Promotion" onchange="this.form.submit()">                    
                                        <option value="G1" <?php if ($Promo == "G1") echo "selected"; ?>>G1</option>
                                        <option value="G2" <?php if ($Promo == "G2") echo "selected"; ?>>G2</option>
                                        <option value="G3" <?php if ($Promo == "G3") echo "selected"; ?>>G3</option>
                                        <option value="L1" <?php if ($Promo == "L1") echo "selected"; ?>>L1</option>
                                        <option value="L2" <?php if ($Promo == "L2") echo "selected"; ?>>L2</option>
                                    </select>
                                </div>
                                <!-- Rechercher Par Departement -->
                                <div class="col-md-3 form-group">
                                    <select class=" form-control custom-select d-block w-100" name="Departement" id="Departement" onchange="this.form.submit()">
                                        <?php while ($Departement1 = $req9->fetch()) { ?>
                                            <option value="<?php $Depart = $Departement1['Id_Depart'];
                                                            echo $Depart ?>" <?php if ($Departement === $Depart) echo "selected"; ?>>
                                                <?php echo $Departement1['Nom_Depart']; ?>
                                            </option>
                                        <?php 
                                    } ?>
                                    </select>
                                </div>
                                <!-- Rechercher Par Jour -->
                                <div class="col-md-1 form-group">
                                    <select class=" form-control custom-select d-block w-100" name="Jour" onchange="this.form.submit()">                    
                                        <option value="Lundi" <?php if ($Jour == "Lundi") echo "selected"; ?>>Lundi</option>
                                        <option value="Mardi" <?php if ($Jour == "Mardi") echo "selected"; ?>>Mardi</option>
                                        <option value="Mercredi" <?php if ($Jour == "Mercredi") echo "selected"; ?>>Mercredi</option>
                                        <option value="Jeudi" <?php if ($Jour == "Jeudi") echo "selected"; ?>>Jeudi</option>
                                        <option value="Vendredi" <?php if ($Jour == "Vendredi") echo "selected"; ?>>Vendredi</option>
                                        <option value="Samedi" <?php if ($Jour == "Samedi") echo "selected"; ?>>Samedi</option>
                                    </select>
                                </div>
                                <!-- Rechercher Par Cours -->
                                <div class="col-md-2 form-group">
                                    <input type="text" name="Cours" class="form-control" id="Cours" value="<?php echo $Cours ?>" placeholder="Cours">
                                </div>
                                <div class="col-md-1 form-group">
                                    <button type="submit" class="btn btn-primary" href="#" role="button">
                                        <!-- icône de la recherche-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-md-1 form-group">
                                    <a href="Horaire1.php?Accueil=1" class="btn btn-secondary" Style="text-decoration:none;"role="button">
                                        <!-- icône de l'Actualisation-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="container">
                                <div class="row mb-3">
                                    <!--CARD-1-->
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                                    <div class="col p-4 d-flex flex-column position-static">
                                                        <?php if ($horaire['Nom_Cours'] == "") { ?>
                                                                <strong class="d-inline-block mb-2 text-primary">
                                                                    VIDE
                                                                </strong> <?php 
                                                                        } else { ?>
                                                            <h4 class="text-success">De 08H00' à 11H00'</h4>
                                                            <strong class="d-inline-block mb-2 text-primary">
                                                                <?php echo $Jr['Jour'] ?>
                                                            </strong>
                                                            <h3 class="mb-0 text-pimary"><?php echo $horaire['Nom_Cours']; ?></h3>
                                                            <div class="mb-1 text-muted">Vulume Horaire: <?php echo $horaire['Volume_Horaire']; ?></div>
                                                            <h4 class="mb-0"><small class="text-muted"><?php echo $horaire['Grade_Ens']; ?> </small><?php echo $horaire['Nom_Ens']; ?></h4>
                                                            <h5 class="mb-0"><?php echo $horaire['PostNom_Ens']; ?>&nbsp<?php echo $horaire['Prenom_Ens']; ?></h5>
                                                        <?php 
                                                    } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer" style="background-color:RED;">

                                            </div>
                                        </div>
                                    </div>
                                    <!--CARD-2-->
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                                        <div class="col p-4 d-flex flex-column position-static">
                                                            <?php if ($horaire1['Nom_Cours'] == "") { ?>
                                                                <strong class="d-inline-block mb-2 text-primary">
                                                                    VIDE
                                                                </strong> <?php 
                                                                        } else { ?>
                                                                <h4 class="text-success">De 11H00' à 14H00'</h4>
                                                                <strong class="d-inline-block mb-2 text-primary">
                                                                    <?php echo $Jr['Jour'] ?>
                                                                </strong>
                                                                <h3 class="mb-0 text-pimary"><?php echo $horaire1['Nom_Cours']; ?></h3>
                                                                <div class="mb-1 text-muted">Vulume Horaire: <?php echo $horaire1['Volume_Horaire']; ?></div>
                                                                <h4 class="mb-0"><small class="text-muted"><?php echo $horaire1['Grade_Ens']; ?> </small><?php echo $horaire1['Nom_Ens']; ?></h4>
                                                                <h5 class="mb-0"><?php echo $horaire1['PostNom_Ens']; ?>&nbsp<?php echo $horaire1['Prenom_Ens']; ?></h5>
                                                            <?php 
                                                        } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="card-footer" style="background-color:yellow;">

                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                                        <div class="col p-4 d-flex flex-column position-static">
                                                            <?php if ($horaire2['Nom_Cours'] == "") { ?>
                                                                <strong class="d-inline-block mb-2 text-primary">
                                                                    VIDE
                                                                </strong> <?php 
                                                                        } else { ?>
                                                                <h4 class="text-success">De 14H00' à 17H00'</h4>
                                                                <strong class="d-inline-block mb-2 text-primary">
                                                                    <?php echo $Jr['Jour'] ?>
                                                                </strong>
                                                                <h3 class="mb-0 text-pimary"><?php echo $horaire2['Nom_Cours']; ?></h3>
                                                                <div class="mb-1 text-muted">Vulume Horaire: <?php echo $horaire2['Volume_Horaire']; ?></div>
                                                                <h4 class="mb-0"><small class="text-muted"><?php echo $horaire2['Grade_Ens']; ?> </small><?php echo $horaire2['Nom_Ens']; ?></h4>
                                                                <h5 class="mb-0"><?php echo $horaire2['PostNom_Ens']; ?>&nbsp<?php echo $horaire2['Prenom_Ens']; ?></h5>
                                                            <?php 
                                                        } ?>
                                                        </div>
                                                    </div>
                                                    </div>
                                            <div class="card-footer" style="background-color:Blue;">

                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>