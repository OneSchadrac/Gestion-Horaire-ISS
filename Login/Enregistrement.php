<?php
    require('C:\wamp\www\My Project\MyApp\Service\Connexion1.php');
    $req = "SELECT * from login";
    $ps = $pdo->prepare($req);
    $ps->execute();
?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Enregistrement</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">
    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
<body class="text-center">
    <form class="form-signin"    method="post" action="SaveUser.php">
        <img class="mb-4" src="../Image/Pers1.png" alt="" width="120" height="120">
        <h1 class="h3 mb-3 font-weight-normal">Enregistrement</h1>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus style="margin-button:5px"/>
&nbsp
        <label for="inputComboBox" class="sr-only">Login</label>
        <select name="Choix" id="" class="form-control" required>
            <option value=""> </option>
            <option value="Etudiant">Etudiant</option>
            <option value="Enseignant">Enseignant</option>
        </select>
&nbsp
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required/>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
    </form> 
</body>