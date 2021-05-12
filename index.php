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
  	<form action="target.php" method="POST"class="champs-connexion">
  		<p><label for="utilisateur">Nom d'utilisateur</label> <br>
  			<input type="text" name="utilisateur" required ></p> <br>
  		<p><label for="motdepasse">Mot de passe</label> <br>
  			<input type="password" name="motdepasse" required ></p><br>

      <p><input type="submit" value="Connexion"></p>

  		<p>Pas encore de compte ?</p><a href="page-inscription.php">Inscrivez-vous !</a>
  		<p>Mot de passe oublié ?</p><a href="">Créez en un nouveau !</a>
  	</form>
  </section>
 
   <!--footer-->
<?php include("includes/footer.php"); ?>

</body>
</html>