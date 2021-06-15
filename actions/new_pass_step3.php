<?php 

session_start();

//ROOT
require_once '../root.php';

//Call function
require_once ROOT_DIR.'/module/fonctions.php'; 

//Alert if the 2 passwords typed don't respect our terms
if (($_POST['new_password'] != $_POST['new_password2']) OR (!preg_match("#^.{8,}$#", $_POST['new_password'])))
{
    setAlert('<p class="message_alert"> Les deux mots de passe entrés sont différents ou votre nouveau mot de passe est trop court. </p>');
    redirection('new_pass_step3.php');
}
//If all is ok
else
{
    //Database connexion
    require_once ROOT_DIR.'/module/connexion_bdd.php';

    //Hash password
    $pass_hache2 = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    //SQL Request to update the password in Database
    $req = $bdd -> prepare('UPDATE GBAF_account SET password = :new_password WHERE id_user = :id_user');
    $req -> execute (array(
        'new_password' => $pass_hache2,
        'id_user' => $_SESSION['id_user']
    ));
    
    redirection('index.php');
}
?>