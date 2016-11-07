<?php
include_once("../../includes/config.php");
//var_dump(array_key_exists('logout',$_GET));
if(array_key_exists('logout',$_GET)){
	unset($_SESSION['token']);
	unset($_SESSION['google_data']); //Google session data unset
	$gClient->revokeToken();
	session_destroy();
	//header("Location:index.php");
}else{
	echo "Usuario não possui acesso";
}
?>

