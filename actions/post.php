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

//Verification validity of the parameters
if(isset($_GET['act']) AND !empty($_GET['act']))
{
    //SQL Request to verify if the actor exists
    $check = $bdd -> prepare('SELECT id_actor FROM GBAF_actor WHERE id_actor = ?');
    $check -> execute(array($getact));

    //If verification ok
    if($check -> rowCount() == 1) 
    {
        //SQL Request to insert a new post
        $ins = $bdd -> prepare('INSERT INTO GBAF_post (id_user,id_actor,date_add,post) VALUES(:id_user,:id_actor,NOW(),:post)');
        $ins -> execute (array(
        'id_user' => $_SESSION['id_user'],
        'id_actor' => $getact,
        'post' => $_POST['post']
        ));

        //If duplicated entry 
        $error = $ins -> errorInfo();
        if ($error[1] == 1062)
        {  
            $del = $bdd -> prepare('DELETE FROM GBAF_post WHERE id_actor = ? AND id_user = ? AND date_add = NOW()');
            $del -> execute(array($getact,$_SESSION['id_user'],)); 

            //Close Request
            $del -> closeCursor();

            setAlert('<p class="message_alert"> Vous avez déjà commenté pour cet acteur.</p>'); 
        }
        //All is ok
        elseif ($ins -> rowCount())
        {
            setAlert('<p class="message_alert"> Merci, votre commentaire a bien été pris en compte. </p>'); 
        }
        //Another error
        else
        {
            setAlert('<p class="message_alert"> Une erreur innatendue est survenue. Veuillez réessayer. </p>'); 
        }

        //Close Request
        $ins -> closeCursor();
    }

}

redirection('acteur.php?act='.$getact);

?>