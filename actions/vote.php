<?php 

session_start();

//ROOT
require_once '../root.php';

//Database connexion
require_once ROOT_DIR.'/module/connexion_bdd.php';
//Call function
require_once ROOT_DIR.'/module/fonctions.php'; 

//Security typecast
$getact = (int) $_GET['act'];
$gettype = (int) $_GET['type'];

//Redirection conditions
if(isset($_GET['redirect'])) 
{
    switch($_GET['redirect'])
    
    {
        case 'accueil':
        $page = 'accueil.php';
        break;

        case 'acteur':
        $page = 'acteur.php?act='.$getact;
        break;

        default:
        $page = 'accueil.php';
    }
}
else
{
    $page = 'accueil.php';
}

//Verification validity of the parameters
if(isset($_GET['type'],$_GET['act']) AND !empty($_GET['type']) AND !empty($_GET['act']))
{
    if($gettype < 1 OR $gettype > 2)
    {
        //Redirection
        redirection($page);
    }

    //SQL Request to verify if the actor exists
    $check = $bdd -> prepare('SELECT id_actor FROM GBAF_actor WHERE id_actor = ?');
    $check -> execute(array($getact));

    //If verification ok
    if($check -> rowCount() == 1) 
    {  
        //Ternary condition to redefine a vote 
        $vote_type = $gettype == 1 ? 2 : 1;

        //First, SQL Request to delete a possible opposite vote already given by the user
        $del = $bdd -> prepare('DELETE FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote = ?');
        $del -> execute(array($getact,$_SESSION['id_user'],$vote_type));

        //Close Request
        $del -> closeCursor();
                        
        //We insert the vote in Database
        $ins = $bdd -> prepare('INSERT INTO GBAF_vote (id_actor, id_user, vote) VALUES (?, ?, ?)');
        $ins -> execute(array($getact, $_SESSION['id_user'], $gettype ));

        //If duplicated entry 
        $error = $ins -> errorInfo();
        if ($error[1] == 1062)
        {
            $del = $bdd -> prepare('DELETE FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote = ?');
            $del -> execute(array($getact,$_SESSION['id_user'],$gettype)); 

            setAlert('<p class="message_alert"> Votre vote a été annulé. </p>'); 
        }
        //All is ok
        elseif ($ins -> rowCount())
        {
            setAlert('<p class="message_alert"> Merci, votre vote a bien été pris en compte. </p>'); 
        }
        //Another error
        else
        {
            setAlert('<p class="message_alert"> Une erreur innatendue est survenue. Veuillez réessayer. </p>'); 
        }

        //Close Request
        $ins -> closeCursor();

        //Redirection
        redirection($page);

    }

    //Direct redirection
    redirection($page);
}

?>

