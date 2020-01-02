<?php
include '../../classes/inc/lang.php';
include '../../classes/inc/dateset.php';

$week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

$days_in_month = $date->format('t'); // t is number of days in given month 28 through 31

$last_day_month = $date->format('t'); //number of days in given month
$first_day_month = $date->format('N'); //Starts the month on the right weekday 1 for monday 7 sunday
$start_month_day = $date->format('D'); // textual representation
// $years = range(2019, 2030);

$today = date('j F Y'); // day of the month without leading zeros, full text.repres. monthname, full numeric prex. year

// THIS CALENDAR WAS MADE BASED UPON BASIC TABLECODE AND THEN I CHANGED IT INTO DIVCODE, SO THIS IS A DIVBASED CALENDAR WITH TABLENAMES AND USING FLEXBOXES FOR CELLS TT 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Calendar</title>
	<link rel="stylesheet" href="../../assets/css_calendar/calendar_divtable.css" />

</head>
<body>
	<div class="calendar">
		<div class="head">
			<div class="head-content">
				<?php
					if ($month == 1) {
						print '<a href="?month=12&amp;year=' . ($year - 1) . '"><< Back </a>';
					} else {
						print '<a href="?month=' . ($month - 1) . '&amp;year=' . $year . '"><< Back </a>';
					}
					//and the button for the next month... when Januari of December add or extract another year.
					if ($month == 12) {
						print ' | <a href="?month=1&amp;year=' . ($year + 1) . '">>> Next </a>';
					} else {
						print ' | <a href="?month=' . ($month + 1) . '&amp;year=' . $year . '"> Next >></a>';
					}
				?>
			</div>
			<div class="head-content">
				<?php
					print 'Calendar   ' . ($months[$month] . ' ' . $year); 
				?>
			</div>
			<div class="head-content">
				<?php
					print 'Today  ' . $today ; 
				?>
			</div>
		</div>
		<div class="body">
			<div class="rows">
				<div class="headrow-cells">Week
				</div>
				<?php
					foreach ($week_days as $key => $value) {
					print '<div class="headrow cells">' . $value . '</div>';
					}
				?>
			</div>
				<?php
				$current_week = $date->format('W'); // ISO week numbers in years
				$current_day = 1;
				while ($current_day <= $last_day_month) {
					// print '<tr>';
					print '<div class="rows">';
					// print '<th>' . $current_week . '</th>';
					print '<div class="headrow-cells">' . $current_week. '</div>';
					
					$painted_cells = 0;
					// Nos faltan los 7 días L a D
					if ($current_day == 1) {
						for ($empty_cell = 1; $empty_cell < $first_day_month; $empty_cell++) {
							// print '<td></td>' referring to old table code;
							print '<div class="cells"></div>';
							$painted_cells++;
						}
					}

					for ($painted_cells; $painted_cells < 7; $painted_cells++) {
						// was before: print '<td>' . $current_day . '</td>';
						if ($current_day <= $last_day_month) {
							// mark or highlight today
							if ($current_day == date('j') && $month == date('m')) {
								print '<div class="cells special">  ' . $current_day . '</div>';
							} else
							print '<div class="cells">  ' . $current_day . '</div>';
						} else {
							// before was print '<td></td>';
							print '<div class="cells"></div>';
						}
						$current_day++;
					}
					
					$current_week++;
					// print '</tr>';
					print '</div class="rows">';
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>
