<!doctype html>
<html lang="fr">

    <head>
      <meta charset="utf-8">
      <!--Responsive-->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GBAF Accueil</title>
        <link rel="stylesheet" href="style.css">
    </head>


    <body>


      <?php 
      //header
      include_once("includes/header-after.php"); 
      ?>
  
      <!--Main-->
      <section class="presentation">

        <!--GBAF introduction-->
        <h1 class="h1-blanc"> Qui sommes-nous&thinsp;? </h1>

          <div class="texte-presentation">
            <p>
              <span>Le Groupement Banque Assurance Français</span> (GBAF) est une fédération représentant les 6 grands groupes français&thinsp;:
            </p>
            <br>
            <ul>
              <li>  ●&ensp;&ensp;BNP Paribas&thinsp;;     
              <li>  ●&ensp;&ensp;BPCE&thinsp;;</li> 
              <li>  ●&ensp;&ensp;Crédit Agricole&thinsp;;</li> 
              <li>  ●&ensp;&ensp;Crédit Mutuel-CIC&thinsp;;</li> 
              <li>  ●&ensp;&ensp;Société Générale&thinsp;;</li> 
              <li>  ●&ensp;&ensp;La Banque Postale.</li> 
            </ul>
            <br>
            <p>
            Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
            Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. 
            C’est aussi un interlocuteur privilégié des pouvoirs publics.
            </p>
          </div>
      </section>

      <section class="acteurs">

        <!--Actors list-->
        <h2> Nos acteurs </h2>
      
          <div class="liste_acteurs">
            <?php 
            //SQL Request to show actors
            //$reponse=$bdd->query('SELECT * FROM GBAF_actor LEFT JOIN GBAF_vote ON GBAF_actor.id_actor = GBAF_vote.id_actor ORDER BY id_actor DESC');
            $reponse=$bdd->query('SELECT a.*, COUNT(CASE WHEN v.vote = 1 THEN 1 END) AS count_likes, COUNT(CASE WHEN v.vote = 2 THEN 1 END) AS count_dislikes 
            FROM GBAF_actor AS a LEFT JOIN GBAF_vote AS v ON a.id_actor = v.id_actor GROUP BY a.id_actor ORDER BY a.id_actor DESC');

            while ($donnees=$reponse->fetch())
            { ?>
                <div id="<?php $donnees['id_actor']?>" class="bloc-acteur"> 

                  
                  <?=('<img src="images/'.$donnees['logo'].'"class="logo-acteur">')?>
                  

                  <div class="description-acteur">
                    <h3><?= htmlspecialchars($donnees['actor']);?><h3>
                      <p><?= substr(($donnees['description']),0,100);?>...</p>

                    <div class="bloc-bas-acteur">

                      <a class="lirelasuite" href="acteur.php?act=<?php echo $donnees['id_actor'];?>">Lire la suite</a>  

                      <a href="actions/vote.php?act=<?php echo $donnees['id_actor'];?>&type=1&redirect=accueil" class="bouton-avis"> <img src="images/like.svg"></a>

                      <?='<p class="count">'.$donnees['count_likes'].'</p>';?>

                      <a href="actions/vote.php?act=<?php echo $donnees['id_actor'];?>&type=2&redirect=accueil" class="bouton-avis"> <img src="images/dislike.svg"></a>

                      <?='<p class="count">'.$donnees['count_dislikes'].'</p>';?>
                      <br>

                    </div>

                  </div>

                </div>
                <br>

              <?php
            }

            //Close Request
            $reponse->closeCursor();
            ?>

          </div> 

      </section> 

      <?php
      //footer 
      include_once("includes/footer.php"); 
      ?>

    </body>

</html>