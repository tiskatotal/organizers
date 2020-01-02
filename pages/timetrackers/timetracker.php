<?php
include '../../classes/inc/lang.php';
include '../../classes/inc/dateset.php';
require '../../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="UTF-8">
		<title>TimeTracker</title>
		<link rel="stylesheet" href="../../assets/css_timetracker/timetracker.css" />
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
					foreach ($day_names['en'] as $key => $value) {
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
					<p>Special Days
						<?php 
							foreach ($month_names['es'] as $key => $value){
								if ($key == $month) {
									print($last_day_month . ' de ' . $value. ' de ' . $year); 
								}
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
				print('<pagebreak />');
				?>
		<table align="<?=($new_page % 2 === 0)?'right':'left'?>">
			<?php
				foreach ($month_names['nl'] as $key => $value){
					$value_month = $value;
					if ($key == $month) {
						
						// $new_page = $day_of_week;
						// if ($day_of_week = $new_page) {
						// foreach ($day_names ['nl'] as $key => $value) {
							$key = $new_page;
								// for ($key = ''; $key < 7; $key++) {
							// print ($value);
							// var_dump($key);
							// var_dump($new_page);
							// var_dump($day_of_week);
								

						if ($new_page % 2 === 0) {
							print "<tr class='even_pages_right'>
							<td>
							<div class='weekday'>" . ($value) . "</div>
							<div class='month'>" . ($value_month) . "</div>
							</td>
							<td class='day'>" . ($new_page) . "</td>
				</tr>";
				} else {
					print "<tr class='odd_pages_left'>
					<td class='day'>". ($new_page) . "</td>
					<td>
					<div class='weekday'>" . ($value) . "</div>
					<div class='month'>" . ($value_month) . "</div>
					</td>
					</tr>";
					// }
				// }
			}
		}
		// var_dump($day_of_week);
		// var_dump($day_names);
			// print year or something else <span class='year'>" . $year) . "</span>
			?>
		</table>
		<?php
			// $date->add(new DateInterval('P1D')); // to get names of weekdays
			
				}
			}
		// }
		?>
</body>

</html>

	<?php //add 32 pages and set left and right pages. TR
		// for ($new_page = 1; $new_page <= 31; $new_page++) {
		// 	$day_of_week = $date->format('l');
		// 	print('<pagebreak />');
	?>
		<!-- <table align="<?=($new_page % 2 === 0)?'right':'left'?>"> -->
			<?php // writing table with left and right pages			
				// foreach ($month_names['es'] as $key => $value){
				// 	if ($key == $month) {
				// 		if ($new_page % 2 === 0) {
				// 		print "<tr class='even_pages_right'>
				// 				<td>
				// 					<div class='weekday'>" . ($day_of_week) . "</div>
				// 					<div class='month'>" . ($value . "<span class='year'>" . $year) . "</span></div>
				// 				</td>
				// 				<td class='day'>". ($new_page) . "</td>
				// 			</tr>";
				// 		} else {
				// 		print "<tr class='odd_pages_left'>
				// 				<td class='day'>". ($new_page) . "</td>
				// 				<td>
				// 				<div class='weekday'>" . ($day_of_week) . "</div>
				// 				<div class='month'>" . ($value . "<span class='year'>" . $year) . "</span></div>
				// 				</td>
				// 			</tr>";
				// 		}
				// 	}
				// }
			?>
		<!-- </table> -->
	<?php
		// $date->add(new DateInterval('P1D')); // to get names of weekdays
		// }
	?>
<!-- </body>

</html> -->