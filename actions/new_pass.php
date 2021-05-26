<?php 
session_start();
//Connexion BDD
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//Requête pour verifier existence username dans BDD
$reponse=$bdd->query('SELECT username FROM GBAF_account WHERE username="'.$_POST['username'].'"');
$username=$reponse->fetch();

if (strtolower($_POST['username'])!=strtolower($username['username']))
     {
        $_SESSION['alert']='<p class="message_alert">Ce nom d\'utilisateur n\'existe pas.</p>';
        header('Location: http://localhost:8888/alert.php');
     }
elseif (strtolower($_POST['username'])==strtolower($username['username']))
     {  
        //Fin requête
        $reponse->closeCursor();

        $_SESSION['username']=$_POST['username'];

        //Requête pour récupérer question secrète associée dans BDD
        $reponse=$bdd->query('SELECT question FROM GBAF_account WHERE username="'.$_SESSION['username'].'"');
        $donnees=$reponse->fetch(); 
        $_SESSION['question']=$donnees['question'];
         //Fin requête
        $reponse->closeCursor(); 
        header('Location: http://localhost:8888/new_pass_step2.php');
     }

//Requête pour verifier réponse à la question
$reponse=$bdd->query('SELECT answer FROM GBAF_account WHERE answer="'.$_POST['answer'].'"');
$answer=$reponse->fetch();
if (strtolower($_POST['answer'])!=strtolower($answer['answer']))
     {
        $_SESSION['alert']='<p class="message_alert">La réponse est incorrecte.</p>';
        header('Location: http://localhost:8888/alert.php');
     }
elseif ((isset($_POST['answer']))AND(strtolower($_POST['answer'])==strtolower($answer['answer'])))
     {  
        //Fin requête
        $reponse->closeCursor();
        $_SESSION['answer']=$_POST['answer'];
        header('Location: http://localhost:8888/new_pass_step3.php');
     }

?>
