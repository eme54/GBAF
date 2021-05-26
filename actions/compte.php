<?php 
session_start();
//Connexion BDD
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

$req=$bdd->prepare('UPDATE GBAF_account SET lastname=:lastname, name=:name, username=:username, question=:question, answer=:answer WHERE id_user=:id_user');
$req->execute (array(
    'lastname'=>$_POST['lastname'],
    'name'=>$_POST['name'],
    'username'=>$_POST['username'],
    'question'=>$_POST['question'],
    'answer'=>$_POST['answer'],
    'id_user'=>$_SESSION['id_user']
    ));
    //Fin requête
    $req->closeCursor();
    $_SESSION['alert']='<p class="message_alert"> Les modifications ont bien été prises en compte. </p>';
    header('Location: http://localhost:8888/alert.php');

?>