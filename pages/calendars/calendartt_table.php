<?php
date_default_timezone_set("Europe/Madrid");

require '../../vendor/autoload.php';


if (isset($_REQUEST["month"])) {   
    // generates timestamp from given data
    $timestamp = mktime( 0, 0 , 0, $_REQUEST["month"], 1, $_REQUEST["year"]); 
} else {
    // generates current timestamp
    $timestamp = mktime(0, 0, 0, date("m"), 1, date("Y")+ 0); 
}

$monthToDisplayNumber = date("M", $timestamp);
$yearToDisplayNumber = date("Y", $timestamp);

$week_days = array(1 => "monday", 2 => "tuesday", 3 => "wednesday", 4 => "thursday", 5 => "friday", 6 => "saturday", 7 => "sunday");

$months = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");

$selectableYears = range(2019, 2030);

// $actual_day = date("j m");
$actual_day = date("d");
$current_month = date("m");
$actual_month = date("m", $timestamp);
$actual_year = date("Y", $timestamp);


// Use the Yasumi factory to create a new holiday provider instance
$yasumiProvider = Yasumi\Yasumi::create('Spain', $actual_year, 'es_ES');

// for every week, print the days. 
// if those days are part of the current month, print the day-of-the-month number in the cell
    
    $daysBeforeMonthStarts = date('N', $timestamp) - 1;

    $endOfMonthTimestamp = $timestamp + (date("t", $timestamp)-1) * 86400;

    $startCountingTimestamp = $timestamp - $daysBeforeMonthStarts * 86400;

/**
 * calculate how many weeks in the month
 */
    // get the number of days in the month
    $daysInDisplayMonth = date("t", $timestamp);
    // divide them by 7 & round up
	$weeksInDisplayMonth = ceil( ($daysInDisplayMonth + $daysBeforeMonthStarts ) / 7);
	
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calendartt</title>
	<link rel="stylesheet" href="../../assets/css_calendar/calendar_table.css" />

	<style>
		.dias{
		 	border:solid black 5px;
			min-height: 96px; height:96px;max-height:96px;
			min-width: 96px;width:96px;max-width:96px;
		}
		.festivos{
			background:yellow;
		}

	</style>
</head>

<body>
<table>
		<thead>
				<tr>
					<th>
						<?php
						//of course we also want last month 
						if ($actual_month == 1) {
							print '<br><a href="?month=12&amp;year=' . ($actual_year - 1) . '"><< Back </a>';
						} else {
							print '<br><a href="?month=' . ($actual_month - 1) . '&amp;year=' . $actual_year . '"><< Back </a>';
						}
						//and the button for the next month... when Januari of December add or extract another year.
						if ($actual_month == 12) {
							print ' | <a href="?month=1&amp;year=' . ($actual_year + 1) . '">>> Next </a>';
						} else {
							print ' | <a href="?month=' . ($actual_month + 1) . '&amp;year=' . $actual_year . '"> Next >></a>';
						}
						?>
					</th>
					<th colspan="4">Calendar
						<?php
							print($actual_month . '  ' . $actual_year);
						?>
					</th>
					<th colspan="3">
						<?php
							print ' today is ' . (date('j' .'  '.  'F'));
						?>
					</th>
				</tr>
		</thead>
	<tbody>
		<tr>
			<th>WEEK</th>
			<?php // tt 
				foreach ($week_days as $key => $value) {
				print '<th>' . $value . '</th>';
				}
			?>
		</tr>
			<?php
				for ($weeksPrinted = 0; $weeksPrinted < $weeksInDisplayMonth; $weeksPrinted++ ) {
					echo "<tr>
						<td>".(date("W", $timestamp) + $weeksPrinted)."</td>";
					for ($dayOfTheWeek = 0; $dayOfTheWeek < 7; $dayOfTheWeek++ ) {

						$holidaySet = $yasumiProvider->between(
							new DateTime(date("m/d/Y", $startCountingTimestamp + $dayOfTheWeek * 86400)),
							new DateTime(date("m/d/Y", $startCountingTimestamp + $dayOfTheWeek * 86400))
						);

						echo '<td class="dias '.(count($holidaySet) ? 'festivos' : '').'">';
						if ($startCountingTimestamp + $dayOfTheWeek * 86400 < $timestamp || 
							$startCountingTimestamp + $dayOfTheWeek * 86400 > $endOfMonthTimestamp ) {
							echo " ";
						} else {
							//echo " is day of month | ";
							if ($actual_month == 11 && (date("d", $startCountingTimestamp + $dayOfTheWeek * 86400)) == 4) {
								echo '<span style="color: red;">';
								echo date("d", $startCountingTimestamp + $dayOfTheWeek * 86400);
								echo '</span>';
							} else {
								// echo color 'today'
								if ($current_month == $actual_month && (date("d", $startCountingTimestamp + $dayOfTheWeek * 86400)) == $actual_day) {
									echo '<span style="color: red;">';
									echo date("d", $startCountingTimestamp + $dayOfTheWeek * 86400) . " today";
									echo '</span>';
								} else {
									echo date("d", $startCountingTimestamp + $dayOfTheWeek * 86400);
								}
							}
							foreach ($holidaySet as $holiday) {
								echo '<div class="nombreDelFestivos">'.$holiday->getName('es_ES') . PHP_EOL.'</div>';
								// var_dump( Yasumi\Yasumi::getAvailableLocales() );
							}
						}
						echo '</td>';
					}
					$startCountingTimestamp = $startCountingTimestamp + 7 * 86400;
					echo "</tr>";
				}
			?>
	<tbody>
<tfoot>
	<?php
		// var_dump($actual_day);
		// var_dump($actual_month);
		// var_dump($actual_year);
		// var_dump($startCountingTimestamp);
		// var_dump($dayOfTheWeek);
		// var_dump($endOfMonthTimestamp);
		// var_dump(date("d m", $startCountingTimestamp + $dayOfTheWeek * 86400));
	?>
</tfoot>
</table>
</body>
</table>
	<table class="holidays">
		<tr>
			<th>holidays</th>
			<th>moon</th>
			<th>birthdays</th>
		</tr>
		<tr>
			<td>
				<?php 
					print $current_month?>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</html>