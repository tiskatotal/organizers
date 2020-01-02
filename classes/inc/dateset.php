<?php
date_default_timezone_set("Europe/Madrid");

$date = new DateTime();

$month = $date->format('m'); //Numeric representation of a month, with leading zeros 01 through 12  
$year = $date->format('Y'); //A full numeric representation of a year, 4 digits 1999 or 2003

	if (isset($_REQUEST['month'])) {
		$month = $_REQUEST['month'];
	}
	if (isset($_REQUEST['year'])) {
		$year = $_REQUEST['year'];
	}
	
	$date->setDate($year, $month, 1);

$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
$years = range(2019, 2050);
$days_in_month = $date->format('t'); //number of days in given month 28 through 31
$day_of_week = $date->format('l'); // full textual respresentation of the day of the week
$last_day_month = $date->format('t'); //number of days in given month 28 through 31
$first_day_month = $date->format('N'); //Starts the month on the right weekday 1 for monday 7 sunday
$start_month_day = $date->format('D'); // textual representation 3 letters

// $date_day = new DateTime(sprintf('%s, %s, -oi', $year, $month));
// $date->setDate($year, $month, 1);

// $year = '';
// $month = '';
// $last_day_month = $date_day->format('t');
// 	for ($i = 1; $i <= $last_day_month; $i++) {
// 		print sprintf('%s <br/>', $i);
// 	}
// 	$date_day->setDate($year, $month, $i);
// 	var_dump($date_day);

?>