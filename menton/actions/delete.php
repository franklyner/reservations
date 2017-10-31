<?
include '../config.php'; 
include '../security.php';

$id= $_GET["id"];
$month = $_GET["m"];
$year = $_GET["y"];

$qry = "DELETE FROM ".$config['entries']." WHERE RES_ID='".$id."'";

mysql_query($qry)or die(mysql_error());

Header("Location: ../screens/welcome.php?m=".$month."&y=".$year);
?>