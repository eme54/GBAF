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
      include("includes/header-after.php"); 
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
              <li>  ●&ensp;&ensp;BNP Paribas&thinsp;;</li> 
              <li>  ●&ensp;&ensp;BPCE&thinsp;;</li> 
              <li>  ●&ensp;&ensp;Crédit Agricole&thinsp;;</li> 
              <li>  ●&ensp;&ensp;Crédit Mutuel-CIC&thinsp;;</li> 
              <li>  ●&ensp;&ensp;Société Générale&thinsp;;</li> 
              <li>  ●&ensp;&ensp;La Banque Postale.</li> 
            </ul>
            <br>
            <p>
            Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
            <br>
            Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. 
            C’est aussi un interlocuteur privilégié despouvoirs publics.
            </p>
          </div>

      </section>

      <section class="acteurs">

        <!--Actors list-->
        <h2> Nos acteurs </h2>
      
          <?php 
          //SQL Request to show actors
          $reponse=$bdd->query('SELECT * FROM GBAF_actor ORDER BY id_actor DESC LIMIT 0,5');

          while ($donnees=$reponse->fetch())
          { ?>
              
              <div id="<?php $donnees['id_actor']?>" class="bloc-acteur"> 

                <?=('<img src="/images/'.$donnees['logo'].'"class="logo-acteur">')?>
                
                  <div class="description-acteur">
                    <h3><?= htmlspecialchars($donnees['actor']);?><h3>
                      <p><?= substr(($donnees['description']),0,90);?>...</p>

                    <div class="bloc-bas-acteur">

                      <?php 
                      //SQL Request to count votes likes/dislikes
                      $likes = $bdd->prepare('SELECT vote FROM GBAF_vote WHERE id_actor = ? AND vote= ?');
                      $likes->execute(array($donnees['id_actor'],1));
                      $likes = $likes->rowCount();

                      $dislikes = $bdd->prepare('SELECT vote FROM GBAF_vote WHERE id_actor = ? AND vote= ?');
                      $dislikes->execute(array($donnees['id_actor'],2));
                      $dislikes = $dislikes->rowCount();
                      ?>

                      <a class="ensavoirplus" href="acteur.php?act=<?php echo $donnees['id_actor'];?>">En savoir plus</a>  
                      <a href="actions/vote.php?act=<?php echo $donnees['id_actor'];?>&type=1" class="bouton-avis" onclick="play()"> <img src="/images/like.svg"></a>

                      <?='<p>'.$likes.'</p>';?>

                      <a href="actions/vote.php?act=<?php echo $donnees['id_actor'];?>&type=2" class="bouton-avis" onclick="play()"> <img src="/images/dislike.svg"></a>

                      <?='<p>'.$dislikes.'</p>';?>

                    </div>

                  </div>

              </div>
              <br>

            <?php
          }

          //Close Request
          $reponse->closeCursor();
          ?>


      <?php
      //footer 
      include("includes/footer.php"); 
      ?>

      <!--Animation likes/dislikes script-->
      <script type="text/javascript">
        function play() {
          document.querySelector(".bouton-avis").className = "bouton-avis";
          window.requestAnimationFrame(function(time) {
            window.requestAnimationFrame(function(time) {
              document.querySelector(".bouton-avis").className = "bouton-avis changing";
            });
          });
        }
      </script>

    </body>

</html>