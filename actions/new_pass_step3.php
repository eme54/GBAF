<?php 
session_start();

//Alerte si erreur dans la création du nouveau mot de passe
if (($_POST['new_password']!=$_POST['new_password2']) OR (!preg_match("#^.{8,}$#", $_POST['new_password'])))
    {
        $_SESSION['alert']='<p class="message_alert"> Les deux mots de passe entrés sont différents ou votre nouveau mot de passe est trop court. </p>';
        header('Location: http://localhost:8888/alert.php');
    }
//Si tout est ok
else
   {//Connexion BDD
    require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';
      // Hachage du mot de passe
      $pass_hache2=password_hash($_POST['new_password'], PASSWORD_DEFAULT);

      // Requête pour mise à jour du mot de passe dans la table
      $req=$bdd->prepare('UPDATE GBAF_account SET password=:new_password WHERE username=:username') or die (print_r($bdd->errorinfo()));
      $req->execute (array(
          'new_password'=>$pass_hache2,
          'username'=>$_SESSION['username']
      ));
      //Fin requête
      $req->closeCursor();
      header('Location: http://localhost:8888/index.php');
   }
?>