<?php 
require_once('C:\wamp\www\My Project\MyAppli\Connexion.php');
require_once('C:\wamp\www\My Project\MyAppli\Horaire\ModifierHoraire.php');


$Res = $pdo->prepare("SELECT * FROM Horaire WHERE Jour='$Jour' AND Heure='$Heure' AND IdCours='$Cours' AND Annee='$Annee'");
$Res->execute();
$Ho = $Res->fetch();

echo "Je suis fatigué mes chers amis!!!!".$Ho['Jour'];

?>