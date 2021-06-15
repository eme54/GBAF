<?php

session_destroy();

//ROOT
require_once '../root.php';

//Call function
require_once ROOT_DIR.'/module/fonctions.php';

redirection('index.php');

?>