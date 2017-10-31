<? 
session_start();
$login= $_SESSION["login"];
$password= $_SESSION['password'];

$frank= "franky";
$Frank= "Frank";

if (strlen($frank) > strlen($Frank)) {
	$len= strlen($frank);
} else {
	$len= strlen($Frank);
}
$ret= strncasecmp($frank, $Frank, $len);

echo "Hallo Franky".$ret;
 ?>