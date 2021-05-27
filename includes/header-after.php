  <?php

  if (session_status() == PHP_SESSION_NONE) 
    {
    session_start();
    }

  //Database connexion
  require '/Users/eme/Documents/GBAF/module/connexion_bdd.php'; 

  //SQL Request to find lastname and name of the logged user
  $reponse=$bdd->query('SELECT UPPER(lastname) AS lastname_UP, CONCAT(UCASE(LEFT(name,1)),LCASE(SUBSTRING(name,2))) AS name_ok FROM GBAF_account WHERE id_user="'.$_SESSION['id_user'].'"');
  $donnees=$reponse->fetch()
  ?>  
  

  <header>

    <a href="accueil.php"><img src="images/logo-GBAF.svg" alt="logo du groupement banque assurance français" class="logo-header-gauche"></a>

    <div class="repere-utilisateur"> 
     <img src="images/icone-utilisateur.svg" alt="icone avatar utilisateur" class="icone-utilisateur">

        <div class="texte-utilisateur">
          <p><?= htmlspecialchars($donnees['name_ok']);?> <?=htmlspecialchars($donnees['lastname_UP']);?></p> 

          <a href="compte.php"> Paramètres du compte </a> 
          <br>
          <a href="actions/deconnexion.php"> Se déconnecter </a> 
          <br>
        </div>

    </div>

  </header>


  <?php
  //Close Request
  $reponse->closeCursor();

  //Call function
  require '/Users/eme/Documents/GBAF/module/fonctions.php';
  showAlert();
  ?>

   
   
   
   
   
