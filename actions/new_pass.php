<?php 

session_start();

//Database connexion
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//SQL Request to verify if the username already exists in Database
$reponse=$bdd->query('SELECT username FROM GBAF_account WHERE username="'.$_POST['username'].'"');
$username=$reponse->fetch();

   if (strtolower($_POST['username'])!=strtolower($username['username']))
   //Alert if the username already exists
   {
      $_SESSION['alert']='<p class="message_alert">Ce nom d\'utilisateur n\'existe pas.</p>';
      header('Location: http://localhost:8888/new_pass.php');
      exit();
   }
   elseif (strtolower($_POST['username'])==strtolower($username['username']))
   {  
      //Close Request
      $reponse->closeCursor();

      $_SESSION['username']=$_POST['username'];

      //SQL Request to find the secret question in Database
      $reponse=$bdd->query('SELECT question FROM GBAF_account WHERE username="'.$_SESSION['username'].'"');
      $donnees=$reponse->fetch(); 
      $_SESSION['question']=$donnees['question'];
         
      //Close Request
      $reponse->closeCursor(); 

      header('Location: http://localhost:8888/new_pass_step2.php');
      exit();
   }
?>
