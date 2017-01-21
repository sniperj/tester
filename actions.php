<?php 
error_reporting(E_ERROR);
function __autoload($className)
{
	$filename = "classes/".strtolower($className).".class.php";
	require_once($filename);
}

$action 	= $_REQUEST['action']; 
$arr_action = explode("_",$action); 
$class 		= $arr_action[0];
$function  	= $arr_action[1];


$cls = new $class();
$cls->$function();
