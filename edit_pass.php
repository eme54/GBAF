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
			<form action="actions/edit_pass.php" method="POST"class="champs-connexion">

				<p>
					<label for="old_password">Ancien mot de passe</label> 
					<br>
					<input id="old_password" type="password" name="old_password" required >
				</p> 
				<br>
                <br>
                <p>
					<label for="new_password">Nouveau mot de passe</label> 
					<br>
					<input id="new_password" type="password" name="new_password" required >
				</p> 
                <br>
                <p>
					<label for="new_password2">Confirmation du nouveau mot de passe</label> 
					<br>
					<input id="new_password2" type="password" name="new_password2" required >
				</p> 
                <br>
				<p>
					<input type="submit" value="Valider">
				</p>

			
			</form>

		</section>

		<?php
		//footer
		include_once("includes/footer.php");
		?>
		
	</body>

</html>