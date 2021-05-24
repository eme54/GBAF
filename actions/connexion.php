<?php session_start(); ?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  	  <!--Responsive-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GBAF Connexion</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
//Connexion BDD
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//Récupération de l'username et du password hashé
$req=$bdd->prepare('SELECT id_user,password FROM GBAF_account WHERE username= :username');
$req->execute(array(
	'username'=>$_POST['username']));

if ($req->rowCount()!=1)
// Pas de correspondance trouvée avec username, suite à la recherche dans la BDD
{
	$_SESSION['alert']='<p class="message_erreur"> Nom d\'utilisateur ou mot de passe incorrect ! </p>';
	header('Location: http://localhost:8888/error.php');
}
else
{	$resultat=$req->fetch();
	//Comparaison du password entré via le formulaire avec la BDD
	if (password_verify($_POST['password'], $resultat['password']))
	//Connexion OK
	{
		//Fin requête
		$req->closeCursor();
		$_SESSION['id_user']=$resultat['id_user'];
		$_SESSION['username']=$_POST['username'];
		header('Location: http://localhost:8888/accueil.php');
	}
	else
	{
		$_SESSION['alert']='<p class="message_erreur"> Nom d\'utilisateur ou mot de passe incorrect ! </p>';
        header('Location: http://localhost:8888/error.php');
	}
}	

?>
</body>
</html>