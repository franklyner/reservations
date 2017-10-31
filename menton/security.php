<?php include '../model/model.php';
session_start();
if (isset($_SESSION["login"]) && isset($_SESSION["password"])) {
	$login= $_SESSION['login'];
	$password= $_SESSION['password'];		$user= &$_SESSION['user'];
} else {
	Header("Location: /screens/auth-failed.php");
}
$dbh=mysql_connect ($config['dbhost'], $config['username'], $config['password']) or die ('I cannot connect to the database because: ' . mysql_error());

if( !mysql_select_db($config['dbname'], $dbh)){
	die("couldn't select db: ".mysql_error());
}
?>