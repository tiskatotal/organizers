<?php

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

$week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

$days_in_month = $date->format('t'); // t is number of days in given month 28 through 31

$last_day_month = $date->format('t'); //number of days in given month
$first_day_month = $date->format('N'); //Starts the month on the right weekday 1 for monday 7 sunday
$start_month_day = $date->format('D'); // textual representation
$years = range(2019, 2030);

$today = date('j F Y'); // day of the month without leading zeros, full text.repres. monthname, full numeric prex. year

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Calendar</title>
	<link rel="stylesheet" href="css/calendar_divbased.css" />
</head>

<body>
	<div class="calendar-simple">
		<div class="calendar-simple-calendar">
			<div class="calendar-simple-calendar-head">
				<div class="calendar-simple-calendar-head-button">
					<?php // back and next month links
					if ($month == 1) {
						print '<a href="?month=12&amp;year=' . ($year - 1) . '">< Back </a>';
					} else {
						print '<a href="?month=' . ($month - 1) . '&amp;year=' . $year . '">< Back </a>';
					}

					//and the button for the next month... when Januari of December add or extract another year.
					if ($month == 12) {
						print ' | <a href="?month=1&amp;year=' . ($year + 1) . '">> Next </a>';
					} else {
						print ' | <a href="?month=' . ($month + 1) . '&amp;year=' . $year . '"> Next ></a>';
					}
					?>
				</div>
				<div class="calendar-simple-calendar-head-title">
					<?php // heading
					print 'Calendar   ' . ($months[$month] . ' ' . $year);
					?>
				</div>
				<div class="calendar-simple-calendar-head-today">
					<?php
					print 'Today is  ' .   $today;
					?>
				</div>
			</div>
			<div class="calendar-simple-calendar-weekdays">
				<div class="calendar-simple-calendar-cell calendar-simple-calendar-cell-week"></div>
				<?php
				foreach ($week_days as $key => $value) {
					?>
					<div class="calendar-simple-calendar-cell"><?= $value ?></div>
				<?php
				}
				?>
			</div>
			<div class="calendar-simple-calendar-days">
				<?php
				$current_week = $date->format('W'); // ISO week numbers in years
				$current_day = 1;
				// $first_day_month = $current_day;
				while ($current_day <= $last_day_month) {
					print '<div class="calendar-simple-calendar-cell calendar-simple-calendar-cell-week">' . $current_week . '</div>';
					$painted_cells = 0;
					// Nos faltan los 7 días L a D
					if ($current_day == 1) {
						for ($empty_cell = 1; $empty_cell < $first_day_month; $empty_cell++) {
							print '<div class="calendar-simple-calendar-cell"></div>';
							$painted_cells++;
						}
					}
					// paint a cell for every day of the month
					for ($painted_cells; $painted_cells < 7; $painted_cells++) {
						if ($current_day <= $last_day_month) {
							if ($current_day == date('j') && $month == date('m')) {
								// if currentday is today then highlight, mark cell
								print '<div class="calendar-simple-calendar-cell calendar-simple-calendar-days-special">  ' . $current_day . '</div>';
							} else
								print '<div class="calendar-simple-calendar-cell">' . $current_day . '</div>';
						} else {
							print '<div class="calendar-simple-calendar-cell"></div>';
						}
						$current_day++;
					}
					$current_week++;
				}
				?>
			</div>
		</div>
	</div>
</body>

</html>