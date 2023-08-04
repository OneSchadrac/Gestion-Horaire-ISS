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
    <title>Message</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css1/bootstrap.min.css" />
    <script src="main.js"></script>
</head>

<body>
    <!-- Barre de Navigation -->
    <!--FIN BARRE DE NAVIGATIION-->

    <div class="container">
        <div class="row">
            <div class="col-12">
                    <div class="card" style="margin-top:40px;">
                        <div class="card-header" style="background-color:rgb(255, 0, 0);;">
                            <h6 style="color:white">
                                Erreur
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="SaveModificationEnseignant.php" class="needs-validation" enctype="multipart/form-data">
                                <div class="row">
                                    <p>Impossible de supprimer cette ligne, Ressurez-vous que les données de cette dernière ne sont pas utilisées.</p>
                                </div>
                                <div>
                                    <div>
                                        <hr class="mb-4">
                                        <a class="btn btn-sm btn-secondary  btn-block" href="..\Horaire\Enseignant.php">
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