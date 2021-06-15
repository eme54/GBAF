<?php 
session_start();

//ROOT
require_once '../root.php';

//Database connexion
require_once ROOT_DIR.'/module/connexion_bdd.php';
//Call function
require_once ROOT_DIR.'/module/fonctions.php'; 

//SQL Request to update user informations
$req = $bdd -> prepare('UPDATE GBAF_account SET lastname = :lastname, name = :name, username = :username, 
question = :question, answer = :answer WHERE id_user = :id_user');
$req -> execute (array(
    'lastname'=>$_POST['lastname'],
    'name' => $_POST['name'],
    'username' => $_POST['username'],
    'question' => $_POST['question'],
    'answer' => $_POST['answer'],
    'id_user' => $_SESSION['id_user']
    ));

setAlert('<p class="message_alert"> Les modifications ont bien été prises en compte. </p>');

redirection('compte.php');

?>