<?php
		session_start();
        switch ($_SESSION['alert'])
        {case '<p class="message_erreur"> Nom d\'utilisateur ou mot de passe incorrect ! </p>':
            echo ($_SESSION['alert']);
			$_SESSION['alert']==NULL;
            require 'index.php';
            break;
        case '<p class="message_erreur"> Les deux mots de passe entrés sont différents ou votre mot de passe est trop court. </p>':
            echo ($_SESSION['alert']);
			$_SESSION['alert']==NULL;
            require 'inscription.php';
            break;
        case '<p class="message_erreur"> Ce nom d\'utilisateur est déjà utilisé.</p>':
            echo ($_SESSION['alert']);
            $_SESSION['alert']==NULL;
            require 'inscription.php';
            break;
        case '<p class="message_erreur">Ce nom d\'utilisateur n\'existe pas.</p>';
            echo ($_SESSION['alert']);
            $_SESSION['alert']==NULL;
            require 'new_pass.php';
            break;
        case '<p class="message_erreur">La réponse est incorrecte.</p>';
            echo ($_SESSION['alert']);
            $_SESSION['alert']==NULL;
            require 'new_pass_step2.php';
            break;
        }
?>