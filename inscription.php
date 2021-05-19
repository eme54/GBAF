
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

<!--header-->
<?php include("includes/header-before.php"); ?>

  <section class="inscription">
  	<h1 class="h1-blanc">Inscrivez-vous</h1>
  	<form method="POST" class="champs-inscription">
  		<br>
  		<p><label for="lastname">Nom</label> <br>
  			<input id="lastname" type="text" name="lastname" required ></p> <br>
  		<p><label for="name">Prénom</label> <br>
  			<input id="name" type="text" name="name" required ></p> <br><br>
  		<p><label for="username">Nom d'utilisateur</label> <br>
  			<input id="username" type="text" name="username" required ></p> <br>
  		<p><label for="password">Mot de passe</label> <br>
  			<input id="password" type="password" name="password" required ></p><br>
  		<p><label for="password2">Confirmation du mot de passe</label> <br>
  			<input id="password2" type="password" name="password2" required ></p><br><br>	
  		<p>
  		<label for="question">Question secrète</label><br>	
 		 <select id="question" name="question" required>
   				<option value="1">Quel est le nom de votre premier animal de compagnie ?</option>
   				<option value="2">Dans quelle ville se sont rencontrés vos parents ?</option>
   				<option value="3">Quel est le prénom de votre premier amour ?</option>
   				<option value="4">Quelle est votre film préféré ?</option>
   				<option value="5">Quel est votre chanson péférée ?</option>
   				<option value="6">Quel était votre métier de rêve étant enfant ?</option>
  		</select>
		</p><br>	
		<p><label for="answer">Réponse</label> <br>
  			<input id="answer" type="text" name="answer" required ></p><br>

   		<p><input type="submit" value="Valider"></p>
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

//Alerte si username pas libre
//Requête pour verifier existence username dans BDD
$reponse=$bdd->query('SELECT username FROM GBAF_account WHERE username="'.$_POST['username'].'"');
$username=$reponse->fetch();

if (isset($_POST['username']) AND (strtolower($_POST['username'])==strtolower($username['username'])))
     {
         echo '<p class="message_erreur"> Ce nom d\'utilisateur est déjà utilisé. </p>'; 
     }

//Alerte si non correspondance des 2 mots de passe
elseif ($_POST['password']!=$_POST['password2'])
    {
        echo '<p class="message_erreur"> Les deux mots de passe entrés ne sont pas identiques. </p>';
    }

//Si tout va bien
else
{   //Fin requête
	$reponse->closeCursor();
	// Hachage du mot de passe
    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Requête SQL pour insérer donnees nouveau membre bdd
    $req=$bdd->prepare('INSERT INTO GBAF_account (lastname,name,username,password,question,answer) VALUES(:lastname,:name,:username,:password,:question,:answer)');
    $req->execute (array(
        'lastname'=>$_POST['lastname'],
        'name'=>$_POST['name'],
        'username'=>$_POST['username'],
        'password'=>$pass_hache,
        'question'=>$_POST['question'],
        'answer'=>$_POST['answer']
        ));
    //Fin requête
    $req->closeCursor();

}
?>

  <!--footer-->
<?php include("includes/footer.php"); ?>

</body>
</html>