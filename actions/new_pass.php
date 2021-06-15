<?php 

session_start();

//ROOT
require_once '../root.php';

//Database connexion
require_once ROOT_DIR.'/module/connexion_bdd.php';
//Call function
require_once ROOT_DIR.'/module/fonctions.php'; 

//SQL Request to verify if the username already exists in Database
$reponse = $bdd -> query('SELECT id_user,username FROM GBAF_account WHERE username = "'.$_POST['username'].'"');
$verification = $reponse -> fetch();

   if (strtolower($_POST['username']) != strtolower($verification['username']))
   //Alert if the username doesn't exist
   {
      setAlert('<p class="message_alert">Ce nom d\'utilisateur n\'existe pas.</p>');
      redirection('new_pass.php');
   }
   //Correct username
   elseif (strtolower($_POST['username']) == strtolower($verification['username']))
   {  
      //Close Request
      $reponse -> closeCursor();

      $_SESSION['id_user'] = $verification['id_user'];

      //SQL Request to find the secret question in Database
      $reponse = $bdd -> query('SELECT question FROM GBAF_account WHERE id_user = "'.$_SESSION['id_user'].'"');
      $donnees = $reponse -> fetch(); 
      
      $_SESSION['question'] = $donnees['question'];
         
      //Close Request
      $reponse -> closeCursor(); 

      redirection('new_pass_step2.php');
   }
?>
