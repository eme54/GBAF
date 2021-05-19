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

<!--header-->
<?php include("includes/header-before.php"); ?>

  <section class="connexion">
  	<h1 class="h1-blanc">Connectez-vous</h1>
  	<form method="POST"class="champs-connexion">
  		<p><label for="username">Nom d'utilisateur</label> <br>
  			<input id="username" type="text" name="username" required ></p> <br>
  		<p><label for="password">Mot de passe</label> <br>
  			<input id="password" type="password" name="password" required ></p><br>

      	<p><input type="submit" value="Connexion"></p>

  		<p>Pas encore de compte ?</p><a href="inscription.php">Inscrivez-vous !</a>
  		<p>Mot de passe oublié ?</p><a href="">Créez en un nouveau !</a>
  	</form>
  </section>

  <?php 

//Connexion BDD
try
{
    $bdd=new PDO('mysql:host=localhost;dbname=GBAF;charset=utf8','root','root');
}
catch (Exception $e)
{
    die('Erreur:'.$e->getMessage());
}

//Récupération de l'username et du password hashé
$req=$bdd->prepare('SELECT id,password FROM GBAF_account WHERE username= :username');
$req->execute(array(
	'username'=>$_POST['username']));
$resultat=$req->fetch();

//Comparaison du password entré via le formulaire avec la BDD
$passwordOK=password_verify($_POST['password'], $resultat['password']);

if (!$resultat)
// Pas de correspondance trouvée avec username, suite à la recherche dans la BDD
{
	echo '<p class=message_erreur> Nom d\'utilisateur ou mot de pass incorrect! </p>';
}
else
{
	if ($passwordOK)
	//Connexion OK
	{
		//Fin requête
		$req->closeCursor();
		session_start();
		$_SESSION['id']=$resultat['id'];
		$_SESSION['username']=$_POST['username'];
		header('Location: accueil.php');
	}
	else
	{
		echo '<p class=message_erreur> Nom d\'utilisateur ou mot de pass incorrect! </p>';
	}
}	

?>
 
   <!--footer-->
<?php include("includes/footer.php"); ?>

</body>
</html>