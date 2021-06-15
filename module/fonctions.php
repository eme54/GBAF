<?php

function setAlert($message)
{
	$_SESSION['alert'] = $message;
}

function showAlert()
{
	if(isset($_SESSION['alert']) AND !empty($_SESSION['alert']))
	{
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);	
	}
}

function redirection($page)
{
	header('Location:' .ROOT_URL. '/' .$page);
	exit();
}

?>
