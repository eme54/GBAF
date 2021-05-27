<?php 

session_start();

//Alert if the 2 passwords typed don't respect our terms
if (($_POST['new_password']!=$_POST['new_password2']) OR (!preg_match("#^.{8,}$#", $_POST['new_password'])))
    {
        $_SESSION['alert']='<p class="message_alert"> Les deux mots de passe entrés sont différents ou votre nouveau mot de passe est trop court. </p>';
        header('Location: http://localhost:8888/new_pass_step3.php');
        exit();
    }
//If all is ok
else
   {
        //Database connexion
        require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

        //Hash password
        $pass_hache2=password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        //SQL Request to update the password in Database
        $req=$bdd->prepare('UPDATE GBAF_account SET password=:new_password WHERE username=:username') or die (print_r($bdd->errorinfo()));
        $req->execute (array(
            'new_password'=>$pass_hache2,
            'username'=>$_SESSION['username']
        ));

        //Close Request
        $req->closeCursor();
        
        header('Location: http://localhost:8888/');
        exit();
   }
?>