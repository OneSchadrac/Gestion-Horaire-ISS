<?php

    session_start();

require_once('C:\wamp\www\My Project\Gestion des Horaires\Connexion.php');

    $email= isset($_POST['email']) ? $_POST['email'] : "";
    $Choix= isset($_POST['Choix']) ? $_POST['Choix'] : "";
    $password=isset($_POST['password']) ? $_POST['password'] : "";

    $req1= $pdo->prepare("SELECT * FROM User WHERE email='$email' AND LoginUser='$Choix' AND MdP=MD5('$password')");
    $req1->execute();
    $User = $req1->fetch();
    #$Resultat = $pdo->query($req1);

    if($User['Etat'] != "") {
        if ($User['Etat']==1) {
            if ($User['LoginUser']== "Chef de Section") {
                $_SESSION['User']=$User;
                header('location:../Horaire/Horaire1.php');
            }elseif ($User['LoginUser'] == "Appariteur") {
                $_SESSION['User'] = $User;
                header('location:../Horaire/Horaire2.php');
            }else {
                $_SESSION['User'] = $User;
                header('location:..Horaire/Horaire.php');
            }
        
        }else {
            $_SESSION['ErreurEtat']= "<strong>Erreur !!!</strong> Votre Compte est desactiv\é! Veuillez contacter l\'Administrateur!";
            #header('location:Login.php');
            echo "<script> alert('Erreur!!! Votre Compte est desactive!!! Veuillez contacter l\'Administrateur!');window.location='Login.php'</script>";
        }
    }else {
        echo "<script> alert('Erreur!!! Utilisataire Inconnu!!!');window.location='Login.php'</script>";
        #$_SESSION['ErreurUtilisateur'] = "<strong>Erreur !!!</strong><br> Utilisateur Inconnu(e)!";
        #header('location:Login.php');
    }
?>