<?php 
session_start();

//Database connexion
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//SQL Request to find id and hash password with username in Database
$req=$bdd->prepare('SELECT id_user,password FROM GBAF_account WHERE username= :username');
$req->execute(array(
	'username'=>$_POST['username']));

	if ($req->rowCount()!=1)
	//Username no found
	{
		$_SESSION['alert']='<p class="message_alert"> Nom d\'utilisateur ou mot de passe incorrect ! </p>';
		header('Location: http://localhost:8888/');
		exit();
	}
	else
	//Username found
	{	$resultat=$req->fetch();
			//Passwords comparison
			if (password_verify($_POST['password'], $resultat['password']))
			//Connexion OK
			{
				//Close Request
				$req->closeCursor();
				$_SESSION['id_user']=$resultat['id_user'];
				$_SESSION['username']=$_POST['username'];
				header('Location: http://localhost:8888/accueil.php');
				exit();
			}
			else
			{
				$_SESSION['alert']='<p class="message_alert"> Nom d\'utilisateur ou mot de passe incorrect ! </p>';
				header('Location: http://localhost:8888/');
				exit();
			}
	}	

?>
