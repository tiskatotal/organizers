<?php

ob_start();
$date = new DateTime();
// $day = $date->format('N'); // Day of the month, 2 digits with leading zeros 01 to 31    
// $week = $date->format('W'); // For weeknumbers ISO-8601 week number of year, weeks starting on Monday 28 through 31 
$month = $date->format('m'); //Numeric representation of a month, with leading zeros 01 through 12  
$year = $date->format('Y'); //A full numeric representation of a year, 4 digits 1999 or 2003

if (isset($_REQUEST['day'])) {
    $day = $_REQUEST['day'];
}

// if (isset($_REQUEST['week'])) {
//     $week = $_REQUEST['week'];
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

$days_in_month = $date->format('d-m-Y'); // t is number of days in given month 28 through 31

$last_day_month = $date->format('t'); //number of days in given  month
$first_day_month = $date->format('N'); //Starts the month on the right weekday 1 for monday 7 sunday
$start_month_day = $date->format('D'); // textual representation
$current_cells = array();
$years = range(2019, 2030);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Calendar</title>
	<link rel="stylesheet" href="css/calendar.css" />
</head>

<body>	
	<table>
		<thead>
			<tr>
				<td>
					<?php print($months[$month] . ' ' . $year); 
					?>
				</td>
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
					// paint a cell for every day of the month
					for ($painted_cells; $painted_cells < 7; $painted_cells++) {
						if ($current_day <= $last_day_month) {
							print '<td>' . $current_day . '</td>';
							// if ($current_day == $today) {
							// 	// $today = $current_day;
							// print '<td style="border: 1px solid red;">';
							// } 
							
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
				<td> anything you would like
					<!-- <p>
						En Torremanzanas a <?php
						print($last_day_month . ' de ' . $months[$month] . ' de ' . $year); ?>
					</p> -->
				</td>
			</tr>
		</tfoot>
	</table>	
</body>
</div>
</html>
<?php
$html = ob_get_clean();
?>


<?php
require_once __DIR__ . '/vendor/autoload.php';

// $numero = 20;
// $html = '
// <div class="prueba">
// El número es '.$numero.'
// </div>';

// $html .= "<div>Prueba</div>";




$mpdf = new \Mpdf\Mpdf();
// $mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML($html);

$mpdf->Output();
?>