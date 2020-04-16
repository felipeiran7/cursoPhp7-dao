<?php
	require_once("config.php");

	//$usuario= new Usuario();

	//carrega 1 usuario
	//$usuario->loadById(4);
 	//$lista= Usuario::getList();
 	//echo json_encode($lista);

 	//carrega uma lista de usuarios pelo login
//search = Usuario::search("a");

 	//echo json_encode($search);

 	//carrega usuario usando login e senha

 	$usuario= new Usuario();
 	$usuario-> login("felipe","32322");

 	echo $usuario;

?>