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
			<title>Mon compte</title>
			<link rel="stylesheet" href="style.css">
	</head>


	<body>	

		<?php 
		//header
		include("includes/header-after.php"); 

		//Main

		//SQL Request to bring back user informations
		$reponse=$bdd->query('SELECT lastname,name,username,question,answer FROM GBAF_account WHERE username="'.$_SESSION['username'].'"');
		$donnees=$reponse->fetch();
		?>

		<section class="inscription">

			<!--Form with informations-->
			<h1 class="h1-blanc">Vos informations personnelles</h1>
				<form method="post" action="actions/compte.php" class="champs-inscription">

					<br>
					<p>
						<label for="lastname">Nom</label> 
						<br>
						<input id="lastname" type="text" name="lastname" required value="<?= $donnees['lastname']?>">
					</p>
					<br>
					<p>
						<label for="name">Prénom</label> 
						<br>
						<input id="name" type="text" name="name" required value="<?= $donnees['name']?>" >
					</p>
					<br>
					<p>
						<label for="username">Nom d'utilisateur</label> 
						<br>
						<input id="username" type="text" name="username" required value="<?= $donnees['username']?>" >
					</p>
					<br>
					<p>
						<label for="question">Question secrète</label>
						<br>
						<select id="question" name="question" required>
							<optgroup label="Choix enregistré&thinsp;:">
								<option selected ><?= $donnees['question']?></option>
							</optgroup>
							<optgroup label="Tous les choix&thinsp;:">
								<option value="Quel est le nom de votre premier animal de compagnie ?">Quel est le nom de votre premier animal de compagnie ?</option>
								<option value="Dans quelle ville se sont rencontrés vos parents ?">Dans quelle ville se sont rencontrés vos parents ?</option>
								<option value="Quel est le prénom de votre premier amour ?">Quel est le prénom de votre premier amour ?</option>
								<option value="Quel est votre film préféré ?">Quel est votre film préféré ?</option>
								<option value="Quelle est votre chanson péférée ?">Quelle est votre chanson péférée ?</option>
								<option value="Quel était votre métier de rêve étant enfant ?">Quel était votre métier de rêve étant enfant ?</option>
							</optgroup>
						</select>
					</p>
					<br>	
					<p>
						<label for="answer">Réponse</label> 
						<br>
						<input id="answer" type="text" name="answer" required value="<?= $donnees['answer']?>" >
					</p>
					<br>

					<p>
						<input type="submit" value="Modifier">
					</p>
					
					<p>Changer de mot de passe&thinsp;?</p><a href="new_pass.php">Créez en un nouveau&thinsp;!</a>

				</form>

		</section>

		
		<?php
		//Close Request
		$reponse->closeCursor();


		//footer
		include("includes/footer.php"); ?>

	</body>

</html>