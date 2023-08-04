<?php

    //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET['Accueil']) ? $_GET['Accueil'] : 0;
    $NCours = isset($_GET['Cours']) ? $_GET['Cours'] : 0;
    $Enseignant = isset($_GET['Enseignant']) ? $_GET['Enseignant'] : 3;

    $Matricule = $_GET['Matricule_Ens'];

    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $req1 = $pdo->prepare('SELECT * FROM Enseignant WHERE Matricule_Ens=?');
    $params = array($Matricule);
    $req1->execute($params);

    $NEnseignant = $req1->fetch();



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editer un enseignant</title>
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
                                    Edition de l'Enseignant  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                                        &nbsp &nbsp &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp
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
                    <div class="card-body">
                        <form method="POST" action="SaveModificationEnseignant.php" class="needs-validation" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                            <label for="Matricule">Matricule</label>
                                            <input type="text" class="form-control" id="Matricule" name="Matricule" value="<?php echo $NEnseignant['Matricule_Ens'] ?>" placeholder="Exemple(MA000)" required maxlength="10">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="Nom">Nom</label>
                                        <input type="text" class="form-control" id="Nom" name="Nom" value="<?php echo $NEnseignant['Nom_Ens'] ?>" placeholder="Nom Enseignant"  required/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                            <label for="Post-Nom">Post-Nom</label>
                                            <input type="text" class="form-control" id="Post-Nom" name="Postnom" value="<?php echo $NEnseignant['PostNom_Ens'] ?>"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                            <label for="Prenom">Prenom</label>
                                            <input type="text" class="form-control" id="Prenom" name="Prenom" value="<?php echo $NEnseignant['Prenom_Ens'] ?>" required/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="Grade">Grade</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Grade"  name="Grade" required>
                                                <option value""></option>
                                                <option value"Assistant" <?php if($NEnseignant['Grade_Ens']== "Assistant") echo "selected"; ?>>Assistant</option>
                                                <option value"Chef de travaux" <?php if ($NEnseignant['Grade_Ens'] == "Chef de travaux") echo "selected"; ?>>Chef de travaux</option>
                                                <option value"Professeur Ordinaire" <?php if ($NEnseignant['Grade_Ens'] == "Professeur Ordinaire") echo "selected"; ?>>Professeur Ordinaire</option>
                                                <option value"Professeur émérite" <?php if ($NEnseignant['Grade_Ens'] == "Professeur émérite") echo "selected"; ?>>Professeur émérite</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="Téléphone"  class="sr-only">Téléphone</label>
                                        <input type="text" id="Téléphone" name="Telephone" value="<?php echo $NEnseignant['Telephone_Ens'] ?>" class="form-control" placeholder="999999999" required maxlength="13"/>
                                    </div>
                                </div>
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
                                        <a class="btn btn-sm btn-secondary  btn-block" href="Enseignant.php?Enseignant=3">
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
    </div>
</body>
</html>