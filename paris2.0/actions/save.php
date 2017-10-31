<? 
include '../config.php'; 
include '../security.php';


$bmonth= $_POST["bmonth"];
$bday= $_POST["bday"];
$byear= $_POST["byear"];
$end_month= $_POST["end_month"];
$end_day= $_POST["end_day"];
$end_year= $_POST["end_year"];
$bemerkung= $_POST["bemerkung"];

$month = $_POST["m"];
$year = $_POST["y"];

$end_date = mktime(0,0,0, $end_month, $end_day, $end_year);
$begin_date = mktime(0,0,0, $bmonth, $bday, $byear);

if (strcmp(strftime("%Y%m%d", $begin_date), strftime("%Y%m%d", $end_date)) > 0) {
	$_SESSION["msg"] = "Enddatum ist vor Startdatum!";
	
	Header("Location: ../screens/welcome.php?m=".$month."&y=".$year);
	die();
}




$validateQry = "SELECT * 
FROM `".$config['entries']."`
WHERE (

BEGIN <=".$begin_date."
AND END >=".$begin_date."
)
OR (

BEGIN <=".$end_date."
AND END >=".$end_date."
)
OR (

BEGIN >=".$begin_date."
AND END <=".$end_date."
)";

$res = mysql_query($validateQry);
$numRows = mysql_num_rows($res);
if ($numRows == 0) {
	$insqry = "INSERT INTO ".$config['entries']." (user, begin, end, BEMERKUNGEN) VALUES ('".$login."', ".$begin_date.", ".$end_date.", '".$bemerkung."')";
	mysql_query($insqry);

	$_SESSION["ids"] = NULL;
	$_SESSION["msg"] = NULL;
	
	Header("Location: ../screens/welcome.php?m=".$month."&y=".$year);
} else {
	$msg = "Konflikt mit Reservation";
	for ($i = 0; $i < $numRows; $i++) {
		$row = mysql_fetch_assoc($res);
		$msg = $msg." von ".$row['USER']." beginnend am ".date("j.n.Y", $row['BEGIN']);
		$ids[$i] = $row['RES_ID'];
	}
	$_SESSION["ids"] = $ids;
	$_SESSION["msg"] = $msg;
	Header("Location: ../screens/welcome.php?m=".$month."&y=".$year);
}
?>
<A HREF="../screens/welcome.php">return</A>

