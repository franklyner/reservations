<?php
//include '../model/model.php';



function renderCellContent($kaldenar, $i, $j) {
	$entry = $kaldenar->days[$i][$j]->entry;
	echo '<div style="position: relative; top: 5px;">'.$entry->user->name.'</div>';	
}

function renderTooltipContent($kalendar, $login) {
	if (count($kalendar->entries) == 0) {
		return;
	}
	for ($i=0; $i< count($kalendar->entries); $i++) {
		$entry = $kalendar->entries[$i];
		echo '<div id="tip'.$entry->resId.'" hidden="true" style="visibility: hidden;">';
		//content
		echo '<div style="width: 150px;">';
		echo $entry->user->name.'<br/>'.formatDate($entry->start).' - '.formatDate($entry->end).'<br/>';
		echo $entry->bemerkungen.'<br/>';
		echo 'Email: <a href="mailto:'.$entry->user->email.'">'.$entry->user->email.'</a><br/>';
		echo 'Telefon: '.$entry->user->telefon.'<br/>';
			
		
		if (strlen($entry->user->name) > strlen($login)) {
			$len= strlen($entry->user->name);
		} else {
			$len= strlen($login);
		}

		$ret= strncasecmp($entry->user->name, $login, $len);
		if ($ret == 0) {
			echo '<br />';
			echo '<a href="/actions/delete.php?id='.$entry->resId.'&m='.$kalendar->month.'&y='.$kalendar->year.'">löschen</a>';
		}
		echo '</div>';
		echo '</div>';
	}
}

function formatDate($date) {
	return strftime('%d.%m.%Y', $date);
}

function getMonthsNames() {
	return array(1 => 'Januar', 2 => 'Februar', 3 => 'März', 4 => 'April', 5 => 'Mai', 6 => 'Juni', 7 => 'Juli', 8 => 'August', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Dezember');
	
}

function getMonthsYearString($kalendar) {
	$monthNames = getMonthsNames();
	return $monthNames[$kalendar->month].' '.$kalendar->year;
}

function getMonthName($monthNumber) {
	if ($monthNumber == 0) {
		$monthNumber = 12;
	}
	if ($monthNumber != 12) {
		$monthNumber = $monthNumber % 12;
	}
	$monthNames = getMonthsNames();
	return $monthNames[$monthNumber];
}

?>