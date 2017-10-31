<?
include '../config.php';
include '../security.php';
//include '../model/model.php';
include 'renderfunctions.php';


?>
<?php
if (isset($_GET["m"])) {
	$month = $_GET["m"];
} else {
	$month = date("n");
}

if (isset($_GET["y"])) {
	$year = $_GET["y"];
} else {
	$year = date("Y");
}

if ($month < 1) {
	$year--;
	$month = 12 - $month;
} else if ($month > 12) {
	$year++;
	$month = $month - 12;
}


$kalender = new Kalendar($year, $month, $config);

//for ($i=0; $i<count($kalender->entries); $i++){
//	$entry = $kalender->entries[$i];
//	echo $entry->user->name.'<br/>';
//}
?>

<html>
<head>
<title>Menton Reservationen</title>
<style type="text/css">
td.wrongmonth {
	background-color: #BCADB0;border: 1px solid #888;
}

td.rightmonth {
	background-color: white;border: 1px solid #888;
}

td.res_wrongmonth {
	background-color: #CC2637;border: 1px solid #888;
}

td.res_rightmonth {
	background-color: #FF3347;border: 1px solid #888;
}

td.eig_res_rightmonth {
	background-color: #00FF71; border: 1px solid #888;
}

td.eig_res_wrongmonth {
	background-color: #63CC91; border: 1px solid #888;
}

tr.cal {
	height: 60; 
}

col.cal {
	width: 60;
}

</style>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- script type="text/javascript" src="http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js"></script-->

<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
<!--
function checkpwd(){
	if (document.pwdchange.newpwd.value == ""){
		alert("Bitte f�lle auch das erste Feld aus");
		document.pwdchange.newpwd.focus();
		return false;
	}
	if (document.pwdchange.newpwd2.value == ""){
		alert("Bitte f�lle auch das zweite Feld aus");
		document.pwdchange.newpwd2.focus();
		return false;
	}
	if (document.pwdchange.newpwd.value != document.pwdchange.newpwd2.value){
		alert("Die beiden Felder stimmen nicht �berein!!!");
		return false;
	}
	return true;
}

function ShowDiv(e, divId, isFree)
{
	UnTip();
	if (!isFree) {
		TagToTip(divId);
	}
}

function changeEndValues(unit) {
	var begId = "b"+unit;
	var endId = "end_"+unit;
	var begVal = document.getElementById(begId).value;
	var endEl = document.getElementById(endId);
	if ("day" == unit && "1" == endEl.value) {
		endEl.value = begVal;
	}
	if ("month" == unit && "<?=$month?>" == endEl.value) {
		endEl.value = begVal;
	}
	if ("year" == unit && "<?=$year?>" == endEl.value) {
		endEl.value = begVal;
	}
}
//-->
</SCRIPT>
</head>
<!--#4688FF  -->
<body style="background-color: #e1e1e1; text-align: center;">
<script type="text/javascript" src="/resources/wz_tooltip.js"></script>
<div
	style="border: 1px solid #888; width: 1000px; margin: 0 auto; background-color: #F5F1DE; text-align: left;">
<div style="text-align: center;">
	<!--img src="../pix/titelbild.png" /-->
	<h1>MENTON</h1>
</div>

<div
	style="text-align: left; width: 500; position: relative; top: 25px; margin-left: 20;">


	<div id="curMonth" style="width: 500; text-align: center;border: 1px solid #888;" onmouseover="UnTip();">
		<b><?=getMonthsYearString($kalender)?></b>
	</div>

	<div id="monthNavi" style="width: 500; border: 1px solid #888; height: 20px; position: relative; top: -1px;" onmouseover="UnTip();">
		<div style="float:left; margin-left: 100px; width: 40px; text-align: right;">
			<a href="welcome.php?m=<?=$month?>&y=<?=$year-1?>"><?=$year-1?></a>
		</div>
	 	<div style="float:left; margin-left: 0px; width: 70px; text-align: right;">
			<a href="welcome.php?m=<?=$month-1?>&y=<?=$year?>"><?=getMonthName($month-1)?></a>
		</div>
	 	<div style="float:left; margin-left: 80px; width: 70px;">
			<a href="welcome.php?m=<?=$month+1?>&y=<?=$year?>"><?=getMonthName($month+1)?></a>
		</div>
	 	<div style="float:left; margin-left: 10px; width: 40px;">
			<a href="welcome.php?m=<?=$month?>&y=<?=$year+1?>"><?=$year+1?></a>
	 	</div>
	</div>
	<div style="border: 1px solid #888; position: relative; top: -2px; padding: 0px;">
<table cellspacing="0" cellpadding="0" width="100%">
	<colgroup>
		<col class="cal">
		<col class="cal">
		<col class="cal">
		<col class="cal">
		<col class="cal">
		<col class="cal">
		<col class="cal">
	</colgroup>
	<tr onmouseover="UnTip();">
		<td><b>Mo</b></td>
		<td><b>Di</b></td>
		<td><b>Mi</b></td>
		<td><b>Do</b></td>
		<td><b>Fr</b></td>
		<td><b>Sa</b></td>
		<td><b>So</b></td>
	</tr>
	<?php
	for ($i = 0; $i < 5; $i++) {
		echo '<tr class="cal">';
		for ($j = 0; $j < 7; $j++) {
			if ($kalender->days[$i][$j]->isInMonth($kalender->month)) {
				$classname='rightmonth';
			} else {
				$classname='wrongmonth';
			}
			if (!$kalender->days[$i][$j]->isFree){
				$classname = "res_".$classname;
				$isFree = 'false';
				if(strncasecmp($kalender->days[$i][$j]->entry->user->name, $login, strlen($login)) == 0) {
					$classname = "eig_".$classname;
				}
			} else {
				$isFree = 'true';
			}
			echo '<td class="'.$classname.'"><div style="height: 100%;" onMouseOver="ShowDiv(event, \'tip'.$kalender->days[$i][$j]->entry->resId.'\','.$isFree.');"><div style="position: relative; top: 5px;">'.$kalender->days[$i][$j]->getDayNumber().'</div>';
			echo renderCellContent($kalender, $i, $j);
			echo '</div></td>';
		}
		echo "</tr>";
	}
	?>




</table>
</div>
</div>
<!-- div style="position: relative; top: -135px; left: 250px;">
Reservationen in diesem Monat:
<table width="550" border="1" cellspacing="0" cellpadding="0">
	<tr>
		<td><strong>Wer</strong></td>
		<td width="80"><strong>Von</strong></td>
		<td width="80"><strong>Bis</strong></td>
		<td width="200"><strong>Bemerkungen</strong></td>
		<td width="60">&nbsp;</td>
	</tr>

</table>
</div-->

<div id="newres" style="position: relative; top: -300px; left: 550px; border: 1px solid #888; width: 430px;"><?php $currentYear = date('Y');?>
<b>Neue Reservation</b>
<center style="color: red;"><?=$_SESSION['msg']?></center>
<form action="../actions/save.php" method="post" name="inputform">
	<input type="hidden" name="m" value="<?=$month?>"/>
	<input type="hidden" name="y" value="<?=$year?>"/>
<table width="100%" border="0" align="center" cellpadding="0"
	cellspacing="0">
	<tr>
		<td><strong>Wer</strong></td>
		<td><?=$login?></td>
	</tr>
	<tr>
		<td><strong>Von</strong></td>
		<td><select id="bday" name="bday" size="1" onchange="changeEndValues('day')">
		<? for($i=1;$i<=31;$i++){
			echo "<option>".$i."</option>";
		}?>
		</select> <select id="bmonth" name="bmonth" size="1" onchange="changeEndValues('month')">
		<? for($i=1;$i<=12;$i++){
			$checked = ($month == $i? "selected" : "");
			echo "<option ".$checked.">".$i."</option>";
		}?>
		</select> <select id="byear" name="byear" size="1" onchange="changeEndValues('year')">
		<? for($i=-1;$i<=5;$i++){
			$checked = ($year == ($currentYear + $i)? "selected" : "");
			echo "<option ".$checked.">".($currentYear + $i)."</option>";
		}?>
		</select></td>
	</tr>
	<tr>
		<td><strong>Bis</strong></td>
				<td><select id="end_day" name="end_day" size="1">
		<? for($i=1;$i<=31;$i++){
			echo "<option>".$i."</option>";
		}?>
		</select> <select id="end_month" name="end_month" size="1">
		<? for($i=1;$i<=12;$i++){
			$checked = ($month == $i? "selected" : "");
			echo "<option ".$checked.">".$i."</option>";
		}?>
		</select> <select id="end_year" name="end_year" size="1">
		<? for($i=-1;$i<=5;$i++){
			$checked = ($year == ($currentYear + $i)? "selected" : "");
			echo "<option ".$checked.">".($currentYear + $i)."</option>";
		}?>
		</select></td>
		
	</tr>
	<tr>
		<td>Bemerkungen</td>
		<td><textarea rows=4 cols=30 name="bemerkung"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Abschicken"></td>
	</tr>
</table>
</form>
</div>
<div style="position: relative; top: -270px; left: 530px; width: 80px;">
	<a href="../actions/logout.php">logout</a>
</div>
<FORM name="phonechange" METHOD=POST ACTION="/actions/changephone.php">
<table>
	<tr>
		<td><B>Meine Daten ändern:</B>
		
		
		</td>
		
		
		<td>&nbsp;<?php if($login == 'Frank') { echo '<a href="test.php">test</a>';}?></td>
	</tr>
	<tr>
		<td>Meine Telefonnummer: </td>
		<td><INPUT TYPE="text" NAME="newphone" value="<?=$user->telefon?>" /></td>
	</tr>	
	<tr>
		<td>Meine Emailadresse: </td>
		<td><INPUT TYPE="text" NAME="newmail" value="<?=$user->email?>" /></td>
	</tr>
	<tr>
		<td><INPUT TYPE="submit" value="ändern" /></td>
		<td>&nbsp;</td>
	</tr>
</table>
</FORM>
<FORM name="pwdchange" METHOD=POST ACTION="/actions/changepwd.php"
	onSubmit="return checkpwd()">
<table>
	<tr>
		<td><B>Passwort ändern:</B>
		
		
		</td>
		
		
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Neues Passwort:</td>
		<td><INPUT TYPE="password" NAME="newpwd"></td>
	</tr>
	<tr>
		<td>Neues Passwort wiederholen:</td>
		<td><INPUT TYPE="password" NAME="newpwd2"></td>
	</tr>
	<tr>
		<td><INPUT TYPE="submit" value="ändern"></td>
		<td>&nbsp;</td>
	</tr>
</table>
</FORM>


<?php 
	renderTooltipContent($kalender, $login);

	// delete all messages
	$_SESSION["ids"] = '';
	$_SESSION["msg"] = '';
?>
</div>
</body>
</html>
