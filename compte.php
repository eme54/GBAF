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

<!--header-->
<?php include("includes/header-after.php"); ?>
  
  <section class="inscription">
  	<h1 class="h1-blanc">Vos informations personnelles</h1>
  	<form method="post" action="traitement.php" class="champs-inscription">
  		<br>
  		<p><label for="nom">Nom</label> <br>
  			<input type="text" name="nom" required ></p> <br>
  		<p><label for="prenom">Prénom</label> <br>
  			<input type="text" name="prenom" required ></p> <br><br>
  		<p><label for="utilisateur">Nom d'utilisateur</label> <br>
  			<input type="text" name="utilisateur" required ></p> <br>
  		<p><label for="motdepasse">Mot de passe</label> <br>
  			<input type="password" name="motdepasse" required ></p><br>
  		<p><label for="motdepasse">Confirmation du mot de passe</label> <br>
  			<input type="password" name="motdepasse" required ></p><br><br>	
  		<p>
  		<label>Question secrète</label><br>	
 		 <select required>
   				<option value="animal">Quel est le nom de votre premier animal de compagnie ?</option>
   				<option value="parents">Dans quelle ville se sont rencontrés vos parents ?</option>
   				<option value="amour">Quel est le prénom de votre premier amour ?</option>
   				<option value="film">Quelle est votre film préféré ?</option>
   				<option value="chanson">Quel est votre chanson péférée ?</option>
   				<option value="metier">Quel était votre métier de rêve étant enfant ?</option>
  		</select>
		</p><br>	
		<p><label for="reponse">Réponse</label> <br>
  			<input type="text" name="reponse" required ></p>


  		<button>Modifier</button>
  	</form>
  </section>

<!--footer-->
<?php include("includes/footer.php"); ?>

</body>
</html>