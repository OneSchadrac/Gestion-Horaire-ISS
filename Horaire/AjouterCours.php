<?php
    //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET ['Accueil']) ? $_GET ['Accueil'] : 0;
    $NCours = isset($_GET['Cours']) ? $_GET['Cours'] : 2;
    $Enseignant = isset($_GET['Enseignant']) ? $_GET['Enseignant'] : 0;
    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    //Promotion et Departement
    $req3=$pdo->prepare('SELECT * FROM Promotion, Departement WHERE Promotion . Id_Depart = Departement . Id_Depart');
    $req3->execute();
    //Enseignant
    $req = $pdo->prepare('SELECT * FROM Enseignant');
    $req->execute();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nouveau cours</title>
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
                                    Enregistrement d'un Nouveau Cours  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp 
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
                    <form method="POST" action="SaveCours.php" class="needs-validation" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                        <label for="Id_Cours">ID Cours</label>
                                        <input class=" form-control" ID="Id_Cours" name="Id_Cours" placeholder="C000" required maxlength="4" minlength="4">
                                </div>
                                <div class="col-md-4 mb-3">
                                        <label for="NomCours">Nom Cours</label>
                                        <input class=" form-control" name="Nom_Cours" ID="NomCours" placeholder="Nom du Cours" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                        <label for="VolH">Volume Horaire</label>
                                        <input class=" form-control" name="VolH" ID="VolH" placeholder="Volume horaire" required>
                                </div>
                                <div class="col-md-6 mb-6"> 
                                    <label for="Promotion">Promotion et Département</label>
                                        <select class=" form-control custom-select d-block w-100" id="Promotion" name="Promotion" required>
                                            <option value=""></option>
                                            <?php while ($Promotion = $req3->fetch()) { ?>
                                                <option value="<?php echo $Promotion['Id_Promo']; ?>"><?php echo $Promotion['Nom_Promo'] . "   ". $Promotion['Nom_Depart'] ?></option>
                                            <?php } ?>
                                        </select>
                                </div>
                                <div class="col-md-6 mb-6">
                                    <label for="Matricule">Matricule enseignant</label>
                                    <select class=" form-control custom-select d-block w-100" id="Matricule" name="Matricule" required>
                                            <option value=""></option>
                                            <?php while ($Enseignant = $req->fetch()) { ?>
                                                <option value="<?php echo $Enseignant['Matricule_Ens']; ?>"><?php echo "[".$Enseignant['Matricule_Ens']."]"." ". $Enseignant['Grade_Ens']." ".$Enseignant['Nom_Ens'] . " " . $Enseignant['PostNom_Ens'] . " " . $Enseignant['Prenom_Ens'] ?></option>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                            </svg>
                                                Enregistrer
                                        </button>
                                        <a class="btn btn-sm btn-secondary  btn-block" href="Cours.php?Cours=2">
                                            Annuler
                                        </a>
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