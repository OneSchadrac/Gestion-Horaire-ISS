 <?php
    require_once('C:\wamp\www\My Project\MyAppli\Connexion.php');
    $email= isset($_POST['email']) ? $_POST['email'] : "";
    $Choix= isset($_POST['Choix']) ? $_POST['Choix'] : "";
    $password=isset($_POST['password']) ? $_POST['password'] : "";

    $req1= $pdo->prepare("SELECT * FROM User WHERE email='$email' AND LoginUser='$Choix' AND MdP=MD5('$password')");
    $req1->execute();
    if ($User = $req1->fetch()) {
       #$_SESSION['ErreurIdententité'] = "<strong>Erreur !!!</strong> Vos identités sont utilisées par un autre utilisateur! <br> Veuillez saisir autres identités!";
        header('location:Enregistrement.php');
    }
    else {
        $req3 = $pdo->prepare('INSERT INTO User(LoginUser,MdP,email,Etat) VALUES (?,?,?,1)');
        $params = array($Choix, $password, $email);
        $req3->execute($params);
        header('location:Login.php');
    }
?>