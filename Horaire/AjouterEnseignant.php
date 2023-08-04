<?php 
    //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET['Accueil']) ? $_GET['Accueil'] : 0;
    $NCours = isset($_GET['Cours']) ? $_GET['Cours'] : 0;
    $Enseignant = isset($_GET['Enseignant']) ? $_GET['Enseignant'] : 3;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ajouter un Enseignant</title>
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
                                    Enregistrement d'un Nouvel Enseignant  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
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
                        <form method="POST" action="SaveEnseignant.php" class="needs-validation" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                            <label for="Matricule">Matricule</label>
                                            <input type="text" class="form-control" id="Matricule" name="Matricule" placeholder="Exemple(MA000)" required maxlength="10">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="Nom">Nom</label>
                                        <input type="text" class="form-control" id="Nom" name="Nom" placeholder="Nom Enseignant"  required/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                            <label for="Post-Nom">Post-Nom</label>
                                            <input type="text" class="form-control" id="Post-Nom" name="Postnom"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                            <label for="Prenom">Prenom</label>
                                            <input type="text" class="form-control" id="Prenom" name="Prenom" required/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="Grade">Grade</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Grade" name="Grade" required>
                                                <option value""></option>
                                                <option value"Assistant">Assistant</option>
                                                <option value"Chef de travaux">Chef de travaux</option>
                                                <option value"Professeur Ordinaire">Professeur Ordinaire</option>
                                                <option value"Professeur émérite">Professeur émérite</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="Téléphone" class="sr-only">Téléphone</label>
                                        <input type="text" name="Telephone" id="Téléphone" class="form-control" placeholder="999999999" required maxlength="13"/>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <hr class="mb-4">
                                        <button class="btn btn-lg btn-primary  btn-block" type="submit">
                                            <!--Icon d'enregistrement-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                            </svg>
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-sm btn-secondary  btn-block" href="Enseignant.php">
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