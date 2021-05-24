<?php 
session_start();
//Connexion BDD
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//Alerte si username pas libre
//Requête pour verifier existence username dans BDD
$reponse=$bdd->query('SELECT username FROM GBAF_account WHERE username="'.$_POST['username'].'"');
$username=$reponse->fetch();

if (strtolower($_POST['username'])==strtolower($username['username']))
     {
        $_SESSION['alert']='<p class="message_erreur"> Ce nom d\'utilisateur est déjà utilisé.</p>';
        header('Location: http://localhost:8888/error.php');
     }

//Alerte si non correspondance des 2 mots de passe
elseif (($_POST['password']!=$_POST['password2']) OR (!preg_match("#^.{8,}$#", $_POST['password'])))
    {
        $_SESSION['alert']='<p class="message_erreur"> Les deux mots de passe entrés sont différents ou votre mot de passe est trop court. </p>';
        header('Location: http://localhost:8888/error.php');
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
    //Redirection connexion
    header('Location: http://localhost:8888/index.php');

}
?>