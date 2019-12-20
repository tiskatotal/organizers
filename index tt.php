<?php

ob_start();

$date = new DateTime();
$lang_short = 'es';
$lang_long = 'es_ES';
require 'vendor/autoload.php';
// include 'inc/lang.php';



// $day = $date->format('N'); // Day of the month, 2 digits with leading zeros 01 to 31    
$month = $date->format('m'); //Numeric representation of a month, with leading zeros 01 through 12  
$year = $date->format('Y'); //A full numeric representation of a year, 4 digits 1999 or 2003

// if (isset($_REQUEST['day'])) {
//     $day = $_REQUEST['day'];
// }

	
	if (isset($_REQUEST['month'])) {
		$month = $_REQUEST['month'];
	}
	if (isset($_REQUEST['year'])) {
		$year = $_REQUEST['year'];
	}
	
	$date->setDate($year, $month, 1);

// $week_days = array(1 => 'monday', 2 => 'tuesday', 3 => 'wednesday', 4 => 'thursday', 5 => 'friday', 6 => 'saturday', 7 => 'sunday');
$week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

$days_in_month = $date->format('t'); //number of days in given month 28 through 31
$day_of_week = $date->format('l'); // full textual respresentation of the day of the week
$last_day_month = $date->format('t'); //number of days in given month 28 through 31
$first_day_month = $date->format('N'); //Starts the month on the right weekday 1 for monday 7 sunday
$start_month_day = $date->format('D'); // textual representation 3 letters
$current_cells = array();
$years = range(2019, 2030);

// Use the Yasumi factory to create a new holiday provider instance CHANGE VARIABLE
$yasumiProvider = Yasumi\Yasumi::create('Spain', $year, 'es_ES');
$holidays           = Yasumi\Yasumi::create('Spain', $year);
$holidaysInDecember = $holidays->between(
                        new DateTime('12/01/' . $year),
                        new DateTime('12/31/' . $year)
                      );

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>TimeTracker</title>
	<link rel="stylesheet" href="/organizers/timetracker/css/timetracker.css" />
</head>

<body>
	<div class='calendar'>
	<table>
		<thead>
			<tr>
				<th colspan="8">
					<?php print($months[$month] . ' ' . $year);
					?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th> Week</th>
				<?php
				foreach ($week_days as $key => $value) {
					print '<th>' . $value . '</th>';
				}
				?>
			</tr>
			<?php
			$current_week = $date->format('W'); // ISO week numbers in years
			$current_day = 1;
			while ($current_day <= $last_day_month) {
				print '<tr>';
				print '<th>' . $current_week . '</th>';

				$painted_cells = 0;
				// Nos faltan los 7 días L a D
				if ($current_day == 1) {
					for ($empty_cell = 1; $empty_cell < $first_day_month; $empty_cell++) {
						print '<td></td>';
						$painted_cells++;
					}
				}
				
				//paint a cell for every day of the month
				for ($painted_cells; $painted_cells < 7; $painted_cells++) {
					if ($current_day <= $last_day_month) {
						print '<td>' . $current_day . '</td>';
					} else {
						print '<td></td>';
					}
					$current_day++;
				}
				$current_week++;
				print '</tr>';
				
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8">
					<p>Special Days 
						<?php
						print($last_day_month . ' de ' . $months[$month] . ' de ' . $year);
						foreach ($holidaysInDecember as $holiday) {
							echo $holiday . ' - ' . $holiday->getName() . PHP_EOL;
						}
						?>
					</p>
				</td>
			</tr>
		</tfoot>
	</table>
	</div>

	<?php //add 32 pages and set left and right pages. TR
		for ($new_page = 1; $new_page <= 31; $new_page++) {
			$day_of_week = $date->format('l');
			print('<pagebreak />');
	?>
		<table align="<?=($new_page % 2 === 0)?'right':'left'?>">
			<?php // generate code for writing table here
			if ($new_page % 2 === 0) {
				print "<tr class='even_pages_right'>
					<td>
						<div class='weekday'>" . ($day_of_week) . "</div>
						<div class='month'>" . ($months[$month] . "<span class='year'>" . $year) . "</span></div>
					</td>
					<td class='day'>". ($new_page) . "</td>
				</tr>";
				} else {
				print "<tr class='odd_pages_left'>
					<td class='day'>". ($new_page) . "</td>
					<td>
					<div class='weekday'>" . ($day_of_week) . "</div>
					<div class='month'>" . ($months[$month] . "<span class='year'>" . $year) . "</span></div>
					</td>
				</tr>";
			}
			?>
		</table>
	<?php
		$date->add(new DateInterval('P1D')); // to get names of weekdays
		// }
	}
	?>
</body>

</html>

<?php
$html = ob_get_clean();
?>

<?php
if (isset($_REQUEST['output']) && $_REQUEST['output']=='html')  {
	die($html);
}

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => 'A5-P',
	'orientation' => 'P',
	// 'type' => 'E',
	// 'margin_top' => 20,
	// 'margin_left' => 10,
	// 'margin_right' => 10,
	// 'mirrormargins' => true
	]);
	
	$mpdf->WriteHTML($html);
	
	$mpdf->Output();

?>


<?php

// include 'timetracker.php';
// ob_start();

// ?>

// <?php
// $html = ob_get_clean();
// ?>

// <?php


// require_once __DIR__ . '/vendor/autoload.php';

// $mpdf = new \Mpdf\Mpdf([
// 		'mode' => 'utf-8',
// 		'format' => 'A5-P',
// 		'orientation' => 'P'
// 		]);

// $mpdf->WriteHTML($html);

// $mpdf->Output();

// $mpdf->Output('organizers/pdf_file_name.pdf', 'F');

?>