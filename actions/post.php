<?php 

session_start();

//Database connexion
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//Verification validity of the parameter
if ((isset($_GET['act'])) AND (!empty($_GET['act'])))
{   
    //Security typecast
    $getact = (int) $_GET['act'];

    //SQL Request to insert a new post
    $req=$bdd->prepare('INSERT INTO GBAF_post (id_user,id_actor,date_add,post) VALUES(:id_user,:id_actor,NOW(),:post)');
    $req->execute (array(
        'id_user'=>$_SESSION['id_user'],
        'id_actor'=>$getact,
        'post'=>$_POST['post']
        ));

    //Close Request
    $req->closeCursor();
    
    //Redirection to the Actor page
    header('Location: http://localhost:8888/acteur.php?act='.$getact);
    
}
else
{
    //Redirection to the Home page
    header('Location: http://localhost:8888/accueil.php');
}

?>