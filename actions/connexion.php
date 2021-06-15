<?php 
session_start();

//ROOT
require_once '../root.php';

//Database connexion
require_once ROOT_DIR.'/module/connexion_bdd.php';

//Call function
require_once ROOT_DIR.'/module/fonctions.php'; 

//SQL Request to find id and hash password with username in Database
$req = $bdd -> prepare('SELECT id_user,password FROM GBAF_account WHERE username = :username');
$req -> execute(array(
	'username'=>$_POST['username']));

	if ($req->rowCount() != 1)
	//Username no found
	{
		setAlert('<p class="message_alert"> Nom d\'utilisateur ou mot de passe incorrect ! </p>');

		redirection('index.php');
	}
	else
	//Username found
	{	$resultat = $req -> fetch();
			//Passwords comparison
			if (password_verify($_POST['password'], $resultat['password']))
			//Connexion OK
			{
				//Close Request
				$req->closeCursor();
				$_SESSION['id_user'] = $resultat['id_user'];

				redirection('accueil.php');
				
			}
			else
			{
				setAlert('<p class="message_alert"> Nom d\'utilisateur ou mot de passe incorrect ! </p>');

				redirection('index.php');
			}
	}	

?>
