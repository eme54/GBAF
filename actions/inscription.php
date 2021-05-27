<?php 

session_start();

//Database connexion
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//SQL Request to verify if the username already exists in Database
$reponse=$bdd->query('SELECT username FROM GBAF_account WHERE username="'.$_POST['username'].'"');
$username=$reponse->fetch();

    if (strtolower($_POST['username'])==strtolower($username['username']))
    //Alert if the username already exists
        {
            $_SESSION['alert']='<p class="message_alert"> Ce nom d\'utilisateur est déjà utilisé.</p>';
            header('Location: http://localhost:8888/inscription.php');
            exit();
        }
    elseif (($_POST['password']!=$_POST['password2']) OR (!preg_match("#^.{8,}$#", $_POST['password'])))
    //Alert if the 2 passwords typed don't respect our terms
        {
            $_SESSION['alert']='<p class="message_alert"> Les deux mots de passe entrés sont différents ou votre mot de passe est trop court. </p>';
            header('Location: http://localhost:8888/inscription.php');
            exit();
        }

    //If all is ok
    else
    {   //Close Request
        $reponse->closeCursor();

        //Hash password
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //SQL Request to register the new member in Database
        $req=$bdd->prepare('INSERT INTO GBAF_account (lastname,name,username,password,question,answer) VALUES(:lastname,:name,:username,:password,:question,:answer)');
        $req->execute (array(
            'lastname'=>$_POST['lastname'],
            'name'=>$_POST['name'],
            'username'=>$_POST['username'],
            'password'=>$pass_hache,
            'question'=>$_POST['question'],
            'answer'=>$_POST['answer']
            ));

        //FClose Request
        $req->closeCursor();

        //Redirection connexion
        header('Location: http://localhost:8888/');
        exit();
    }
?>