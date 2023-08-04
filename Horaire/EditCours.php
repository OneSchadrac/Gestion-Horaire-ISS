<?php
   //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET ['Accueil']) ? $_GET ['Accueil'] : 0;
    $NCours = isset($_GET['Cours']) ? $_GET['Cours'] : 2;
    $Enseignant = isset($_GET['Enseignant']) ? $_GET['Enseignant'] : 0;

    $IdCours = $_GET['IdCours'];
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $req1 = $pdo->prepare('SELECT * FROM Cours WHERE Id_Cours=?');
    $params = array($IdCours);
    $req1->execute($params);
    $Cours = $req1->fetch();

// <!-- SELECTIONNER PROMOTIONS-->
$req3 = $pdo->prepare('SELECT * FROM Promotion, Departement WHERE Promotion . Id_Depart = Departement . Id_Depart');
$req3->execute();

    // / < !-- SELECTIONNER Enseignant -- >
    $req = $pdo->prepare ('SELECT * FROM Enseignant');
    $req->execute();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modification d'un cours</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css1/bootstrap.min.css" />
    <script src="main.js"></script>
</head>

<body>
    <!-- Barre de Navigation -->
        <?php require_once('C:\wamp\www\My Project\Gestion des Horaires\Horaire\NavBarre.php'); ?>
    <!--FIN BARRE DE NAVIGATIION-->

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-md-offset-3">
                <div class="card">
                    <div class="card-header" style="background-color:rgb(81, 168, 240);">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <h4>                            
                                </h4>
                            </div>
                            <div class="col-md-8 form-group">
                                <h6 style="color:white">
                                    Edition du Cours  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp
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
                    <form method="POST" action="SaveModificationCours.php" class="needs-validation" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                        <label for="Id_Cours">ID Cours</label>
                                        <input class=" form-control" ID="Id_Cours" name="Id_Cours" value="<?php echo $Cours['Id_Cours'] ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                        <label for="NomCours">Nom Cours</label>
                                        <input class=" form-control" name="Nom_Cours" ID="NomCours"  value="<?php echo $Cours['Nom_Cours'] ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                        <label for="VolH">Volume Horaire</label>
                                        <input class=" form-control" name="VolH" ID="VolH" value="<?php echo $Cours['Volume_Horaire'] ?>" required>
                                </div>
                                <div class="col-md-6 mb-6"> 
                                    <label for="Promotion">Promotion et Département</label>
                                        <select class=" form-control custom-select d-block w-100" id="Promotion" name="Promotion" required>
                                            <option value=""></option>
                                            <?php while ($Promotion = $req3->fetch()) { ?>
                                                <option value="<?php $IdPromo=$Promotion['Id_Promo']; echo $IdPromo ?>" <?php if($IdPromo == $Cours['Id_Promo']){echo "selected";} ?>>
                                                    <?php echo $Promotion['Nom_Promo'] . "   " . $Promotion['Nom_Depart'] ?>
                                                </option>
                                            <?php 
                                        } ?>
                                        </select>
                                </div>
                                <div class="col-md-6 mb-6">
                                    <label for="Matricule">Matricule enseignant</label>
                                    <select class=" form-control custom-select d-block w-100" id="Matricule" name="Matricule" required>
                                            <option value=""></option>
                                            <?php while ($Enseignant = $req->fetch()) { ?>
                                                <option value="<?php $Matricule=$Enseignant['Matricule_Ens']; echo $Matricule ?>" <?php if($Matricule == $Cours['Matricule_Ens']){echo "selected";} ?>>
                                                    <?php echo "[" . $Enseignant['Matricule_Ens'] . "]" . " " . $Enseignant['Grade_Ens'] . " " . $Enseignant['Nom_Ens'] . " " . $Enseignant['PostNom_Ens'] . " " . $Enseignant['Prenom_Ens'] ?>
                                                </option>
                                            <?php 
                                        } ?>
                                    </select>
                                </div>
                            </div>                                 
                        </div>
                        <div class="card-footer bg-transparent border-Warning">
                        <div>
                            <div>
                                <hr class="mb-4">
                                    <button class="btn btn-lg btn-primary  btn-block" type="submit">
                                    <!--Icon de modification-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            Modifier
                                    </button>
                                    <a class="btn btn-sm btn-secondary  btn-block" href="Cours.php?Cours=2">
                                        Annuler
                                    </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>