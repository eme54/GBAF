   <?php
  session_start();
  //Connexion BDD
  require '/Users/eme/Documents/GBAF/module/connexion_bdd.php'; 
  //Requête pour récupérer nom et prénom de l'utilisateur
  $reponse=$bdd->query('SELECT lastname,name FROM GBAF_account WHERE id_user="'.$_SESSION['id_user'].'"');
  $donnees=$reponse->fetch()
   ?>   
   <header>
   <img src="images/logo-GBAF.svg" alt="logo du groupement banque assurance français" class="logo-header-gauche">
   <div class="repere-utilisateur"> 
     <img src="images/icone-utilisateur.svg" alt="icone avatar utilisateur" class="icone-utilisateur">
     <div class="texte-utilisateur">
     <p> <?= htmlspecialchars($donnees['name']);?> <?=htmlspecialchars($donnees['lastname']);?></p> 
        <a href="compte.php"> Paramètres du compte </a> <br>
        <a href="actions/deconnexion.php"> Se déconnecter </a> <br>
      </div>
    </div>
  </header>
  <?php
  //Fin requête
  $reponse->closeCursor();
   ?>
   
   
   
   
   
