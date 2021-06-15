  <?php

  if (session_status() == PHP_SESSION_NONE) 
  {
    session_start();
  }

  //ROOT
  require_once './root.php';

  //Database connexion
  require_once ROOT_DIR.'/module/connexion_bdd.php';
  //Call function
  require_once ROOT_DIR.'/module/fonctions.php'; 

  //SQL Request to find lastname and name of the logged user
  $reponse = $bdd -> query('SELECT UPPER(lastname) AS lastname_UP, CONCAT(UCASE(LEFT(name,1)),LCASE(SUBSTRING(name,2))) AS name_ok 
  FROM GBAF_account WHERE id_user = "'.$_SESSION['id_user'].'"');
  $donnees = $reponse -> fetch()
  ?>  
  

  <header>

    <a href="accueil.php"><img src="images/logo-GBAF.svg" alt="logo du groupement banque assurance français" class="logo-header-left"></a>

    <div class="user-block"> 
     <img src="images/icone-utilisateur.svg" alt="icone avatar utilisateur" class="user-icon">

        <div class="user-text">
          <p><span><?= htmlspecialchars($donnees['name_ok']);?> <?=htmlspecialchars($donnees['lastname_UP']);?></span></p> 

          <a href="compte.php" class="link-header"> Paramètres du compte </a> 
          <br>
          <a href="actions/deconnexion.php" class="link-header"> Se déconnecter </a> 
          <br>
        </div>

    </div>

  </header>


  <?php
  
  if ($donnees == NULL)
  {
    redirection('index.php');
  }

  //Close Request
  $reponse -> closeCursor();

  showAlert();
  ?>

   
   
   
   
   
