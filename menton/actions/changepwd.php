<?
include '../config.php'; 
include '../security.php';

$newpwd= $_POST["newpwd"];

$qry = "UPDATE ".$config['users']." SET pwd='".$newpwd."' WHERE name='".$login."'";
mysql_query($qry);
$password = $newpwd;
$_SESSION["password"]= $password;
Header("Location: /screens/welcome.php");

?>