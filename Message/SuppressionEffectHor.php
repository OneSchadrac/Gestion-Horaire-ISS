<?php
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
    <title>Message</title>
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
                <div class="card" style="margin-top:40px;">
                    <div class="card-header" style="background-color:rgb(81, 168, 240);">
                        <h6 style="color:white">
                            Succès
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="SaveModificationEnseignant.php" class="needs-validation" enctype="multipart/form-data">
                            <div class="row">
                                <p>Un cours a été rétiré de l'horaire avec succès.</p>
                            </div>
                            <div>
                                <div>
                                    <hr class="mb-4">
                                    <a class="btn btn-sm btn-secondary  btn-block" href="..\Horaire\General.php">
                                            D'accord
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