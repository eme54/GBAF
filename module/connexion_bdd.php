<?php 

//Connexion BDD
try
{
    $bdd=new PDO('mysql:host=localhost;dbname=GBAF;charset=utf8','root','root');
}
catch (Exception $e)
{
    die('Erreur:'.$e->getMessage());
}

?>