<?php 
session_start();
?>

<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
  	    <!--Responsive-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Acteur</title>
            <link rel="stylesheet" href="style.css">
    </head>


    <body>

        <?php 
        //header
        include("includes/header-after.php"); 
 
        //Main

        //SQL Request to verify the parameter act
        $req=$bdd->prepare('SELECT id_actor FROM GBAF_actor WHERE id_actor = :getact');
        $req->execute(array(
        'getact'=>$_GET['act']));
    
        if ($req->rowCount()!=1)
        //Actor not found
        {
            //Close request
            $req->closeCursor();

            //Redirection to Home page
            header('Location: accueil.php');
            exit();   
        }
    
        else
        {

            $getact = $_GET['act'];

            //SQL Request to show the targeted actor and his number of Likes/Dislikes
            $req=$bdd->prepare('SELECT a.*, COUNT(CASE WHEN v.vote = 1 THEN 1 END) AS count_likes, COUNT(CASE WHEN v.vote = 2 THEN 1 END) AS count_dislikes
            FROM GBAF_actor AS a LEFT JOIN GBAF_vote AS v ON a.id_actor = v.id_actor WHERE a.id_actor = ?');
            $req->execute (array($getact));
            $donnees=$req->fetch();
        ?>
            <section class="acteurs">

                <!--Actor introduction-->
                <?=('<img src="images/'.$donnees['logo'].'"class="logo-acteur-presentation">')?>

                    <div class="texte-presentation">
                        <h3>
                            <?= htmlspecialchars($donnees['actor']);?>
                        <h3>
                            <p> 
                                <?= nl2br($donnees ['description']);?> 
                            </p>
                    </div>
                        <div class="likes_dislikes">
                        <a href="actions/vote.php?act=<?php echo $donnees['id_actor'];?>&type=1&redirect=acteur" class="bouton-avis2" > <img src="images/like.svg"></a>
    
                        <?='<p class="count">'.$donnees['count_likes'].'</p>';?>
    
                        <a href="actions/vote.php?act=<?php echo $donnees['id_actor'];?>&type=2&redirect=acteur" class="bouton-avis2" > <img src="images/dislike.svg"></a>
    
                        <?='<p class="count">'.$donnees['count_dislikes'].'</p>';?>
                        </div>
                        <br>
                        <a href="accueil.php" class="lien_retour"> retour à la liste des acteurs </a>
            </section>


            <!--Posts section-->
            <h2>Commentaires</h2>

                <section class="posts">
            
                    <!--Post-form-->
                    <div class="post_form">

                        <form action="actions/post.php?act=<?php echo $donnees['id_actor'];?>" method="POST" class="champs-post">
                        <br>
                        <p> 
                            <label for="post">Votre commentaire</label> 
                            <br>
                            <textarea id="post" name="post" required ></textarea>
                        </p> 
                        <br>
                        <p>
                            <input type="submit" value="Poster">
                        </p>
                        </form>

                    </div>

                </section>
    
                <?php
                //Close previous request
                $req->closeCursor();

                //SQL Request to show the list of posts about the actor
                $req=$bdd->prepare('SELECT p.id_post, p.id_user,DATE_FORMAT(p.date_add, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post_fr,p.post,a.username FROM GBAF_post AS p INNER JOIN GBAF_account AS a ON p.id_user=a.id_user WHERE id_actor=? ORDER BY date_add');
                $req->execute (array($getact));
                while ($donnees=$req->fetch())
                {?> 
                    <div class="post_presentation">
                        <p>
                            <span><?php echo htmlspecialchars($donnees['username']); ?> </span>le <?php echo $donnees['date_post_fr']; ?>
                        </p>
                        <p class="text_post"><?php echo nl2br(htmlspecialchars($donnees['post'])); ?></p>
                    </div>
                <?php 
                }
                //Close request
                $req->closeCursor();
        
        } 


        //footer
        include_once("includes/footer.php"); 
        ?>

    </body>

</html>