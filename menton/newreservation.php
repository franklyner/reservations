<? 
include '../config.php'; 
include '../security.php';

$currentYear = date('Y');

?>
<html>
<head>
<title>Neue paris reservation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<center><?=$_SESSION['msg']?></center>
<form action="save.php" method="post" name="inputform">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>Wer</strong></td>
    <td><strong>Von</strong></td>
    <td><strong>Bis</strong></td>
	<TD></TD>
  </tr>
	<tr>
          <td><?=$login?></td>
          <td>
		<select name="bday" size="1">
		<? for($i=1;$i<=31;$i++){
		echo "<option>".$i."</option>";
		}?>
		</select>
		<select name="bmonth" size="1">
		<? for($i=1;$i<=12;$i++){
		echo "<option>".$i."</option>";
		}?>
		</select>
		<select name="byear" size="1">
		<? for($i=-1;$i<=2;$i++){
		echo "<option>".($currentYear + $i)."</option>";
		}?>
		</select>

	  </td>
          <td>
		<select name="end_day" size="1">
		<? for($i=1;$i<=31;$i++){
		echo "<option>".$i."</option>";
		}?>
		</select>
		<select name="end_month" size="1">
		<? for($i=1;$i<=12;$i++){
		echo "<option>".$i."</option>";
		}?>
		</select>
		<select name="end_year" size="1">
		<? for($i=-1;$i<=2;$i++){
		echo "<option>".($currentYear + $i)."</option>";
		}?>
		</select>

	  </td>
    <td><input type="submit" value="Abschicken"</td>
	</tr>
</table>
<br><br><br>
<center>Bemerkungen:<textarea rows=4 cols=30 name="bemerkung"></textarea></center>
</form>
</body>
</html>
<?
	$_SESSION["ids"] = NULL;
	$_SESSION["msg"] = NULL;
?>
