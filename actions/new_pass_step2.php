<?php 

session_start();

//ROOT
require_once '../root.php';

//Database connexion
require_once ROOT_DIR.'/module/connexion_bdd.php';
//Call function
require_once ROOT_DIR.'/module/fonctions.php'; 

//SQL Request to verify the answer compared to registered answer in Database
$reponse = $bdd -> query('SELECT answer FROM GBAF_account WHERE answer = "'.$_POST['answer'].'"');
$answer = $reponse -> fetch();

   if (strtolower($_POST['answer']) != strtolower($answer['answer']))
   //Wrong answer
   {
      setAlert('<p class="message_alert">La réponse est incorrecte.</p>');
      redirection('new_pass_step2.php');
   }
   elseif (isset($_POST['answer']) AND strtolower($_POST['answer']) == strtolower($answer['answer']))
   //Good answer
   {  
      //Close Request
      $reponse->closeCursor();

      redirection('new_pass_step3.php');
   }

?>