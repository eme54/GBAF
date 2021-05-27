<?php 

session_start();

//Database connexion
require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

//Verification validity of the parameters
if(isset($_GET['type'],$_GET['act']) AND !empty($_GET['type']) AND !empty($_GET['act']))
{
   //Security typecast
   $getact = (int) $_GET['act'];
   $gettype = (int) $_GET['type'];

   //SQL Request to verify if the actor exists
   $check = $bdd->prepare('SELECT id_actor FROM GBAF_actor WHERE id_actor=?');
   $check->execute(array($getact));

   //If verification ok
   if($check->rowCount() == 1) 
   {
      //In case of Like vote
      if($gettype == 1) 
      {
         //SQL Request to delete a possible Dislike vote already given by the user
         $del = $bdd->prepare('DELETE FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote= ?');
         $del->execute(array($getact,$_SESSION['id_user'],2));

         //Close Request
         $del->closeCursor();

         //SQL Request to verify if a Like vote already exists
         $check_like = $bdd->prepare('SELECT vote FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote= ?');
         $check_like->execute(array($getact,$_SESSION['id_user'],1));

            //If a Like vote already exists, we delete this (in this case we consider the user wants to cancel the vote)
            if($check_like->rowCount() == 1) 
            {
               $del = $bdd->prepare('DELETE FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote= ?');
               $del->execute(array($getact,$_SESSION['id_user'],1));

               //Close Request
               $del->closeCursor();
            }
            //But if no Like vote, we insert this in Database
            else
            {
               $ins = $bdd->prepare('INSERT INTO GBAF_vote (id_actor, id_user, vote) VALUES (?, ?, ?)');
               $ins->execute(array($getact, $_SESSION['id_user'], $gettype));

               //Close Request
               $ins->closeCursor();
            }

         //Close Request
         $check_like->closeCursor();
      }

      //In case of Dislike vote
      elseif($gettype == 2) 
      {
            //SQL Request to delete a possible Like vote already given by the user
            $del = $bdd->prepare('DELETE FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote= ?');
            $del->execute(array($getact,$_SESSION['id_user'],1));

            //Close Request
            $del->closeCursor();

            //SQL Request to verify if a Dislike vote already exists
            $check_like = $bdd->prepare('SELECT vote FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote= ?');
            $check_like->execute(array($getact,$_SESSION['id_user'],2));
            
               //If a Dislike vote already exists, we delete this (in this case we consider the user wants to cancel the vote)
               if($check_like->rowCount() == 1) 
               {
                  $del = $bdd->prepare('DELETE FROM GBAF_vote WHERE id_actor = ? AND id_user = ? AND vote= ?');
                  $del->execute(array($getact,$_SESSION['id_user'],2));

                  //Close Request
                  $del->closeCursor();
               }
               //But if no Dislike vote, we insert this in Database
               else
               {
                  $ins = $bdd->prepare('INSERT INTO GBAF_vote (id_actor, id_user, vote) VALUES (?, ?, ?)');
                  $ins->execute(array($getact, $_SESSION['id_user'], $gettype));
                  //Fin requête
                  $ins->closeCursor();
               }

            //Fin requête
            $check_like->closeCursor();
      }

      //Redirection to the Home page
      header('Location: http://localhost:8888/accueil.php');
      exit();
   }

   //If verification not ok
   else
   {
      //Direct redirection to the Home page
      header('Location: http://localhost:8888/accueil.php');
      exit();
   }

}

//Parameters not ok
else
{
   //Direct redirection to the Home page
   header('Location: http://localhost:8888/accueil.php');
   exit();
}
