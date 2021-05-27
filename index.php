<?php 
session_start();
?>


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
		//header 
		include("includes/header-before.php");
		?>

		<!--Main-->
		<section class="connexion">

			<h1 class="h1-blanc">Connectez-vous</h1>
				<!--Login form-->
				<form action="actions/connexion.php" method="POST" class="champs-connexion">
					
					<p>
						<label for="username">Nom d'utilisateur</label>
						<br>
						<input id="username" type="text" name="username" required >
					</p> 
					<br>
					<p>
						<label for="password">Mot de passe</label> 
						<br>
						<input id="password" type="password" name="password" required >
					</p>
					<br>
					<p>
						<input type="submit" value="Connexion">
					</p>

					<p>Pas encore de compte ?</p><a href="inscription.php">Inscrivez-vous !</a>
					<p>Mot de passe oublié ?</p><a href="new_pass.php">Créez en un nouveau !</a>
				
				</form>
		</section>
 
		<?php
		//footer 
		include("includes/footer.php"); 
		?>

	</body>

</html>