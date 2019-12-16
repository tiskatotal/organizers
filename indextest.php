<?php

ob_start();
$date = new DateTime();
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>TimeTracker</title>
	<link rel="stylesheet" href="timetracker/css/timetracker_table.css" />
</head>

<body>
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
				// paint a cell for every day of the month
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
					<p>Special Days <?php
									print($last_day_month . ' de ' . $months[$month] . ' de ' . $year); ?>
					</p>
				</td>
			</tr>
		</tfoot>
	</table>

	<?php //add 32 pages and set left and right pages. TR
			// for ($i = 1; $i <= 31; $i++) {
			// 	if ($i <= $last_day_month) {
			// 		print('<pagebreak />');
					?>
	<!-- <div style="<?= ($i % 2 === 0) ? 'text-align: right;' : '' ?>"> -->
		<!-- <p>Pagina <?= $i ?></p> -->
		<?php
				// print($months[$month] . ' ' . $year);
				?>
		<!-- </div> -->
		<?php
		// 	}
		// }
		?>
	<?php //add 32 pages and set left and right pages. TR
	for ($new_page = 1; $new_page <= 31; $new_page++) {
		$day_of_week = $date->format('l');
		print('<pagebreak />');
		if ($new_page <= $last_day_month) {
			?>
			<!-- <div style="<?= ($new_page % 2 === 0) ? 'text-align: right;' : '' ?>"> -->
			<table>
				<thead>
					<tr>
						<th rowspan="2">
							<?= $new_page ?>
						</th>
						<td>
							<?= $day_of_week ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php
								print($months[$month] . ' ' . $year);
							?>
						</td>
					</tr>
				</thead>
			</table>
			<!-- </div> -->
	<?php
			$date->add(new DateInterval('P1D')); // to get names of weekdays
		}
	}
	?>
</body>

</html>
<?php
$html = ob_get_clean();

?>

<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => 'A5-P',
	'orientation' => 'P'
	]);
	
	$mpdf->WriteHTML($html);
	// $mpdf->Output('organizers/pdf_file_name.pdf', 'F');
	
	$mpdf->Output();

?>