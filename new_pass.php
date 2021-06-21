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
		<title>Nouveau mot de passe</title>
		<link rel="stylesheet" href="style.css">
	</head>

	<body>

		<?php
		//header 
		include_once("includes/header-before.php"); 
		?>

		<!--Main-->
		<section class="connexion">

			<!--New pass form step 1-->
			<form action="actions/new_pass.php" method="POST"class="champs-connexion">

				<p>
					<label for="username">Nom d'utilisateur</label> 
					<br>
					<input id="username" type="text" name="username" required >
				</p> 
				<br>
				<p>
					<input type="submit" value="Valider">
				</p>

				<p>Pas encore de compte ?</p><a href="inscription.php">Inscrivez-vous !</a>
			
			</form>

		</section>

		<?php
		//footer
		include_once("includes/footer.php");
		?>
		
	</body>

</html>