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
      <title>Nouveau mot de passe</title>
      <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <?php 
    //header
    include("includes/header-before.php");

    //Main

    //Database connexion
    require '/Users/eme/Documents/GBAF/module/connexion_bdd.php';

    //Show question found in Database, New pass form step 2
    echo '<section class="connexion">

            <form action="actions/new_pass_step2.php" method="POST" class="champs-connexion"><br>
              <p>
                <label>'.$_SESSION['question'].'</label>
              </p>
              <br>
              <p>
                <label for="answer">Réponse</label>
                <br>
                <input id="answer" type="text" name="answer" required >
              </p>
              <br>
              <p>
                <input type="submit" value="Valider">
              </p>
            </form>

          </section>';


    //footer
    include("includes/footer.php");
    ?>

  </body>

</html>