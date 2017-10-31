<?php
include '../config.php';

class Entry {
	public $resId;
	public $user;
	public $start;
	public $end;
	public $bemerkungen;
}

class User {
	public $name;
	public $email;
	public $telefon;
}

class Day {
	function __construct($date) {
		$this->date = $date;
	}
	public $date;
	public $isFree = true;
	public $entry;

	function getDayNumber() {
		return strftime("%e", $this->date);
	}

	function getDayName() {
		return strftime("%a", $this->date);
	}

	function isInMonth($monthNumber) {
		return $monthNumber == strftime("%-m", $this->date);
	}
}

class Kalendar {
	public $days;
	public $year;
	public $month;
	public $entries;
	public $config;
	function __construct($y, $m, $config) {
		$this->month = $m;
		$this->year = $y;
		$this->config = $config;
		$this->load();
	}

	function load() {
		$theFirst = mktime(0,0,0,$this->month,1,$this->year);
		$dayOfWeek = strftime("%u", $theFirst);
		$firstMondayOffset = 2-$dayOfWeek;
		for ($i = 0; $i < 5; $i++) {
			for ($j = 0; $j < 7; $j++) {
				$day = new Day($this->getDayDate($firstMondayOffset++));
				$this->days[$i][$j]=$day;
			}
		}
		$this->addEntries();
	}

	function addEntries() {
		$entMgr = new EntityMgr();
		$this->entries = $entMgr->loadEntriesOfPeriod($this->days[0][0]->date, $this->days[4][6]->date, $this->config);
		if ($this->entries == 0) {
			return;
		}
		foreach ($this->entries as $entry) {
			$startstr = $this->getComparableString($entry->start);
			$endstr = $this->getComparableString($entry->end);
			for ($i = 0; $i < 5; $i++) {
				for ($j = 0; $j < 7; $j++) {
					$datestr = $this->getComparableString($this->days[$i][$j]->date);
					if ($startstr <= $datestr && $endstr >= $datestr) {
						$this->days[$i][$j]->isFree = false;
						$this->days[$i][$j]->entry = $entry;
					}
				}
			}
		}
	}
	
	function getComparableString($day) {
		return strftime("%Y%m%d", $day);
	}

	function getDayDate($day) {
		return mktime(0,0,0,$this->month,$day,$this->year);
	}
}

class EntityMgr {

	function __construct() {

	}
	
	function loadEntriesOfPeriod($firstDay, $lastDay, $config) {
	    $query = "SELECT * FROM ".$config['users']." as u, ".$config['entries']." as e";
		$query = $query." WHERE e.user = u.name AND ((e.begin >=".$firstDay." AND e.begin <= ".$lastDay.") OR (e.end >=".$firstDay." AND e.end <=".$lastDay."))";
		$res = mysql_query($query) or die(mysql_error());
		$numrows=mysql_num_rows($res);
		if ($numrows == 0) {
			return 0;
		}
		while ($row = mysql_fetch_assoc($res)){
			$user = new User();
			$user->name = $row["NAME"];
			$user->email = $row["EMAIL"];
			$user->telefon = $row["PHONE"];
			
			
			$entry = new Entry();
			$entry->user = $user;
			$entry->resId = $row["RES_ID"];
			$entry->start = $row["BEGIN"];
			$entry->end = $row["END"];
			$entry->bemerkungen = $row["BEMERKUNGEN"];
			$entries[]=$entry;
			
		}
		
		return $entries;
	}

}

?>