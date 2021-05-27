<?php 

session_start();

//Database connexion
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//SQL Request to verify the answer compared to registered answer in Database
$reponse=$bdd->query('SELECT answer FROM GBAF_account WHERE answer="'.$_POST['answer'].'"');
$answer=$reponse->fetch();

   if (strtolower($_POST['answer'])!=strtolower($answer['answer']))
      //Wrong answer
      {
         $_SESSION['alert']='<p class="message_alert">La réponse est incorrecte.</p>';
         header('Location: http://localhost:8888/new_pass_step2.php');
         exit();
      }
   elseif ((isset($_POST['answer']))AND(strtolower($_POST['answer'])==strtolower($answer['answer'])))
      //Good answer
      {  
         //Close Request
         $reponse->closeCursor();
         
         $_SESSION['answer']=$_POST['answer'];
         header('Location: http://localhost:8888/new_pass_step3.php');
         exit();
      }

?>