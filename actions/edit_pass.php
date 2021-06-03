<?php 

session_start();

//Database connexion
require_once '../module/connexion_bdd.php';

//Call function
require '../module/fonctions.php'; 

//SQL Request to verify if the password already exists in Database
$reponse=$bdd->query('SELECT password FROM GBAF_account WHERE id_user = "'.$_SESSION['id_user'].'"');
$verification=$reponse->fetch();

//Passwords comparison

if (password_verify($_POST['old_password'], $verification['password']))
    {
        //Close Request
        $reponse->closeCursor();

        //Alert if the 2 passwords typed don't respect our terms
        if (($_POST['new_password']!=$_POST['new_password2']) OR (!preg_match("#^.{8,}$#", $_POST['new_password'])))
        {
            setAlert('<p class="message_alert"> Les deux nouveaux mots de passe entrés sont différents ou votre nouveau mot de passe est trop court. </p>');
            header('Location: ../edit_pass.php');
            exit();
        }

        //If all is ok
        else
        {
            //Hash password
            $pass_hache2=password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            //SQL Request to update the password in Database
            $req=$bdd->prepare('UPDATE GBAF_account SET password=:new_password WHERE id_user = :id_user');
            $req->execute (array(
                'new_password'=>$pass_hache2,
                'id_user'=>$_SESSION['id_user']
            ));
            
            setAlert('<p class="message_alert"> Votre nouveau mot de passe a bien été mis à jour. </p>');
            header('Location: ../compte.php');
            exit();
        } 

    }

else
    {
        //Close Request
        $reponse->closeCursor();

        setAlert('<p class="message_alert"> L\'ancien mot de passe est incorrect. </p>');
        header('Location: ../edit_pass.php');
        exit();
    }

?>