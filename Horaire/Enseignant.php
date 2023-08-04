<?php
   //GESTION DE LA BARRE DE NAVIGATION
    $Accueil = isset($_GET['Accueil']) ? $_GET['Accueil'] : 0;
    $NCours = isset($_GET['Cours']) ? $_GET['Cours'] : 0;
    $Enseignant = isset($_GET['Enseignant']) ? $_GET['Enseignant'] : 3;

    require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    #PAGINATION ENSEIGNANT
    $lim1 = isset($_GET['lim1']) ? $_GET['lim1'] : 5;
    $page1 = isset($_GET['page1']) ? $_GET['page1'] : 1;
    $off1 = ($page1 - 1) * ($lim1);

    $Matricule = isset($_GET['Matricule']) ? $_GET['Matricule'] : "";
    $motcle = isset ($_GET['motcle'])? $_GET ['motcle']:"";
    $Prenom = isset($_GET['Prenom']) ? $_GET['Prenom'] : "";
    $Grade = isset($_GET['Grade']) ? $_GET['Grade'] : "Tout";

    if ($Grade == "Tout") {
        $res1 = $pdo->prepare(" SELECT * FROM Enseignant
                                WHERE Matricule_Ens LIKE '%$Matricule%' 
                                AND Nom_Ens like '%$motcle%' 
                                AND Prenom_Ens LIKE '%$Prenom%' 
                                GROUP BY Matricule_Ens ASC LIMIT $off1,$lim1");
        $Compteur= "SELECT COUNT(*) CompteEns FROM Enseignant 
        WHERE Matricule_Ens LIKE'%$Matricule%' AND Nom_Ens like '%$motcle%' and Prenom_Ens LIKE '%$Prenom%'";
        
    }else {
        $res1 = $pdo->prepare("SELECT * FROM Enseignant 
        WHERE Nom_Ens like '%$motcle%' and Prenom_Ens LIKE '%$Prenom%' and Grade_Ens='$Grade' And Matricule_Ens LIKE'%$Matricule%' GROUP BY Matricule_Ens ASC LIMIT $off1,$lim1");
        $Compteur = "SELECT COUNT(*) CompteEns FROM Enseignant 
        WHERE Nom_Ens like '%$motcle%' and Prenom_Ens LIKE '%$Prenom%' and Grade_Ens='$Grade' And Matricule_Ens LIKE'%$Matricule%'";
    }

    $res1->execute();
    
    $ResultatCompte= $pdo->query($Compteur);
    $tabCompte=$ResultatCompte->fetch();
    $NbreEns=$tabCompte['CompteEns'];

    #PAGINATION ENSEIGNANT
    $Reste1 = $NbreEns % $lim1; // Operateur Modulo ou reste de la division
    if ($Reste1 == 0) { // Si le nombre d'enseignants est multiple de LIM
        $NbrePage1 = $NbreEns / $lim1;
    } else {
        $NbrePage1 = floor($NbreEns / $lim1) + 1; // Floor recupere la partie entiere d'un nombre decimal
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Liste des enseignants</title>
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
                    <div class="card-header"  style="background-color:rgb(81, 168, 240)";>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <h4>                            
                                </h4>
                            </div>
                            <div class="col-md-8 form-group">
                                <h6 style="color:white">
                                    Recherchez les enseignants  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                                                            &nbsp &nbsp &nbsp&nbsp
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
                        <form method="GET" action="Enseignant.php" class="form-inline">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <input type="text" name="Matricule" class="form-control" id="Matricule" value="<?php echo $Matricule ?>" placeholder="Matricule">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" name="motcle" class="form-control" id="motcle" value="<?php echo $motcle ?>" placeholder="Nom">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" name="Prenom" class="form-control" id="Prenom" value="<?php echo $Prenom ?>" placeholder="Prenom">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select class=" form-control custom-select d-block w-100" name="Grade" onchange="this.form.submit()">
                                        <option value="Tout" <?php if($Grade==="Tout") echo "selected"; ?>>Tous les grades</option>
                                        <option value="Assistant" <?php if($Grade=== "Assistant") echo "selected";?>>Assistant</option>
                                        <option value="Chef de travaux" <?php if ($Grade === "Chef de travaux") echo "selected"; ?>>Chef de travaux</option>
                                        <option value="Professeur Ordinaire" <?php if ($Grade === "Professeur Ordinaire") echo "selected"; ?>>Professeur Ordinaire</option>
                                        <option value="Professeur émérite" <?php if ($Grade === "Professeur émérite") echo "selected"; ?>>Professeur émérite</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" href="#" role="button">
                                            <!-- iconne de la recherche-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                                ...
                                        </button>
                                        <a class="btn btn-secondary" href="AjouterEnseignant.php" role="button">
                                            <!--Iconne d'ajout-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                            Ajouter un enseignant
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" style="margin-top:20px;">
                    <div class="card-header" style="background-color:rgb(81, 168, 240);">
                        <h6 style="color:white">Liste des enseignants [<?php echo $NbreEns ?> Enseignant(s)]</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Matricule</th><th>Nom</th><th>Post-Nom</th><th>Prenom</th><th>Grade</th><th>Téléphone</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($Ens = $res1->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $Ens['Matricule_Ens']; ?></td>
                                        <td><?php echo $Ens['Nom_Ens']; ?></td>
                                        <td><?php echo $Ens['PostNom_Ens']; ?></td>
                                        <td><?php echo $Ens['Prenom_Ens']; ?></td>
                                        <td><?php echo $Ens['Grade_Ens']; ?></td>
                                        <td><?php echo $Ens['Telephone_Ens']; ?></td>
                                        <td>
                                            <!-- iconne de la corbeil-->
                                            <a onclick="return confirm('Confirmez-vous la suppression d\'un enseignant \?')" href="DeleteEnseignant.php?Matricule_Ens=<?php echo $Ens['Matricule_Ens']; ?>" class="btn btn-sm">
                                            <!-- <a onclick="return confirm('Confirmez-vous la suppression d\'une transaction \?')" href="DeleteTransaction1.php?NumTransaction=<?php #echo $His['NumTransaction']; ?>" class="btn btn-sm"> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                            <!-- icône de la modificatiion-->
                                            <a href="EditEnseignant.php?Matricule_Ens=<?php echo $Ens['Matricule_Ens']; ?>" class="btn btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                        </td>
                                        
                                    </tr>  
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-8 mb-8">
                                    <ul class="pagination pagination-xs">
                                        <div class="btn-group btn-group-sm">
                                            <!--PAGINATION-->
                                            <?php for ($i1 = 1; $i1 <= $NbrePage1; $i1++) { ?>
                                                <li type="button" class="btn btn-outline-dark <?php if ($i1 == $page1) {
                                                                                                    echo "active";
                                                                                                } ?>">
                                                    <a href="Enseignant.php?page1=<?php echo $i1 ?>" style="text-decoration:none;">
                                                        <?php echo "Page " . $i1; ?>
                                                    </a>
                                                </li>
                                            <?php 
                                        } ?>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>