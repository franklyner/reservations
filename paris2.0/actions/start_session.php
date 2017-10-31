<? 
include '../config.php'; 
include '../model/model.php';
session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {
	$login= $_POST['login'];
	$password= $_POST['password'];
} else {
	Header("Location: auth-failed.php");
}

$dbh=mysql_connect ($config['dbhost'], $config['username'], $config['password']) or die ('I cannot connect to the database because: ' . mysql_error());

if( !mysql_select_db($config['dbname'], $dbh)){
	die("couldn't select db: ".mysql_error());
}
$res = mysql_query("SELECT * FROM ".$config['users']."  WHERE name like '".$login."' AND pwd = '".$password."'", $dbh) or die (mysql_error());
if(mysql_num_rows($res) == 0){
	Header("Location: ../screens/auth-failed.php");
} else {
	$row = mysql_fetch_assoc($res);
	$_SESSION["user"] = new User();
	$_SESSION["user"]->name = $row['NAME'];
	$_SESSION["user"]->email = $row['EMAIL'];
	$_SESSION["user"]->telefon = $row['PHONE'];
	
	
	$_SESSION["login"]= $row['NAME'];
	$_SESSION["password"]= $password;
	Header("Location: ../screens/welcome.php");
}
?>