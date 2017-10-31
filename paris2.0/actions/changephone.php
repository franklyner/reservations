<?
include '../config.php'; 
include '../security.php';

$newphone= $_POST["newphone"];
$newmail= $_POST["newmail"];

$qry = "UPDATE ".$config['users']." SET PHONE='".$newphone."', EMAIL='".$newmail."' WHERE name='".$login."'";
mysql_query($qry);

$user->telefon = $newphone;
$user->email = $newmail;

Header("Location: /screens/welcome.php");

?>