<?php

ob_start();
// include 'pages/timetrackers/timetracker.php';
include 'classes/inc/lang.php';
include 'classes/inc/dateset.php';

require 'vendor/autoload.php';


// Use the Yasumi factory to create a new holiday provider instance CHANGE VARIABLE
$yasumiProvider = Yasumi\Yasumi::create('Spain', $year, 'es_ES');
$holidays           = Yasumi\Yasumi::create('Spain', $year);
$holidaysInDecember = $holidays->between(
                        new DateTime('12/01/' . $year), //CHANGE TO ISO DATES
                        new DateTime('12/31/' . $year)
                      );

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>TimeTracker</title>
	<link rel="stylesheet" href="organizers/assets/css_timetracker/timetracker.css" />
</head>

<body>
	<div class='calendar'>
	<table>
		<thead>
			<tr>
				<th colspan="8">
					<?php
						foreach ($month_names['es'] as $key => $value){
							if ($key == $month) {
							print ($value . '  ' . $year);
						}
					}
					?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th> Week</th>
				<?php
				foreach ($day_names['es'] as $key => $value) {
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
		foreach ($month_names['es'] as $key => $value){
			if ($key == $month) {
			print ($value . '  ' . $year);
			}
		}
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
						<div class='month'>" . ($months[$month]) . "</div>
					</td>
					<td class='day'>" . ($new_page) . "</td>
				</tr>";
				} else {
				print "<tr class='odd_pages_left'>
					<td class='day'>". ($new_page) . "</td>
					<td>
					<div class='weekday'>" . ($day_of_week) . "</div>
					<div class='month'>" . ($months[$month]) . "</div>
					</td>
				</tr>";
			}
			// print year or something else <span class='year'>" . $year) . "</span>
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