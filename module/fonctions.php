<?php

function showAlert()
{
	if(isset($_SESSION['alert']) AND !empty($_SESSION['alert']))
	{
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);	
	}
}

?>
