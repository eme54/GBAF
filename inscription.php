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
		<title>GBAF Inscription</title>
		<link rel="stylesheet" href="style.css">
	</head>


	<body>

		<?php
		//header 
		include_once("includes/header-before.php"); 
		?>

		<!--Main-->
		<section class="inscription">
			<h1 class="h1-blanc">Inscrivez-vous</h1>

				<!--Sign Up form-->
				<form action="actions/inscription.php" method="POST" class="champs-inscription">

					<br>
					<p>
						<label for="lastname">Nom</label> 
						<br>
						<input id="lastname" type="text" name="lastname" required >
					</p> 
					<br>
					<p>
						<label for="name">Prénom</label> 
						<br>
						<input id="name" type="text" name="name" required >
					</p> 
					<br>
					<br>
					<p>
						<label for="username">Nom d'utilisateur</label> 
						<br>
						<input id="username" type="text" name="username" required >
					</p> 
					<br>
					<p>
						<label for="password">Mot de passe</label> 
						<br>
						<input placeholder="(minimum 8 caractères)"id="password" type="password" name="password" required >
					</p>
					<br>
					<p>
						<label for="password2">Confirmation du mot de passe</label> 
						<br>
						<input id="password2" type="password" name="password2" required >
					</p>
					<br>
					<br>	
					<p>
						<label for="question">Question secrète<br>	
							<span class="questions">
								<select id="question" name="question" required >
									<option value="Quel est le nom de votre premier animal de compagnie ?">Quel est le nom de votre premier animal de compagnie ?</option>
									<option value="Dans quelle ville se sont rencontrés vos parents ?">Dans quelle ville se sont rencontrés vos parents ?</option>
									<option value="Quel est le prénom de votre premier amour ?">Quel est le prénom de votre premier amour ?</option>
									<option value="Quel est votre film préféré ?">Quel est votre film préféré ?</option>
									<option value="Quelle est votre chanson péférée ?">Quelle est votre chanson péférée ?</option>
									<option value="Quel était votre métier de rêve étant enfant ?">Quel était votre métier de rêve étant enfant ?</option>
								</select>
							</span>
						</label>
					</p>
					<br>	
					<p>
						<label for="answer">Réponse</label> 
						<br>
						<input id="answer" type="text" name="answer" required >
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