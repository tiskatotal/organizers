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
$today = date('d F Y');
$current_cells = array();
// $actual_month = date('m');
// $actual_year = date('Y');
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

<div class="calendar-simple">

	<div class="calendar-simple-calendar">
		<div class="calendar-simple-calendar-weekdays">
			<?php
				if ($month == 1) {
					print '<br><a href="?month=12&amp;year=' . ($year - 1) . '"><< Back </a>';
				} else {
					print '<br><a href="?month=' . ($month - 1) . '&amp;year=' . $year . '"><< Back </a>';
				}

				//and the button for the next month... when Januari of December add or extract another year.
				if ($month == 12) {
					print ' | <a href="?month=1&amp;year=' . ($year + 1) . '">>> Next </a>';
				} else {
					print ' | <a href="?month=' . ($month + 1) . '&amp;year=' . $year . '"> Next >></a>';
				}
			?>
			<?php
				print '<h2>' . 'Calendar   ' . ($months[$month] . ' ' . $year) . '</h2>'; 
			?>
			<?php
				print '<h4>' . 'Today   ' . $today . ' </h4>'; 
			?>
			<div class="calendar-simple-calendar-cell calendar-simple-calendar-cell-week"></div>
			<?php
				foreach ($week_days as $key => $value) {
			?>
				<div class="calendar-simple-calendar-cell"><?=$value?></div>
			<?php
				}
			?>
		</div>
		<div class="calendar-simple-calendar-days">
			<?php
				$current_week = $date->format('W'); // ISO week numbers in years
				$current_day = 1;
				while ($current_day <= $last_day_month) {
					print '<div class="calendar-simple-calendar-cell calendar-simple-calendar-cell-week">' . $current_week. '</div>';
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



<div class="Calendar">
	<div class="cTable">
		<div class="cTableHead">
			<div class="cTableCell">
				<?php
					if ($month == 1) {
						print '<br><a href="?month=12&amp;year=' . ($year - 1) . '"><< Back </a>';
					} else {
						print '<br><a href="?month=' . ($month - 1) . '&amp;year=' . $year . '"><< Back </a>';
					}

					//and the button for the next month... when Januari of December add or extract another year.
					if ($month == 12) {
						print ' | <a href="?month=1&amp;year=' . ($year + 1) . '">>> Next </a>';
					} else {
						print ' | <a href="?month=' . ($month + 1) . '&amp;year=' . $year . '"> Next >></a>';
					}
				?>
			</div>
			<div class="cTableCell">
				<?php
					print '<h2>' . 'Calendar   ' . ($months[$month] . ' ' . $year) . '</h2>'; 
				?>
			</div>
			<div class="cTableCell">
				<?php
					print '<h4>' . 'Today   ' . $today . ' </h4>'; 
				?>
			</div>
		</div>
	</div>
	<div class="cTable">
		<div class="cTableRow">
			<div class=" cTableHead">
				<div class="cTableCell">
				 	<h4> Week </h4>
				</div>
				<div class="cTableCell">
					<?php
						foreach ($week_days as $key => $value) {
						print '<div class="cTableCell">  ' . $value . '</div>';
						}
					?>
				</div>
			</div>
		</div>
			<div class="cTableBody">
				<div class="cTableRow">	
				<!-- <div class="cTableCell"> -->
					<?php
						$current_week = $date->format('W'); // ISO week numbers in years
						$current_day = 1;
						while ($current_day <= $last_day_month) {
							// print '<tr>';
							print '<div class="cTableRow">';
							// print '<th>' . $current_week . '</th>';
							print '<div class="cTableCell"><h4>' . $current_week. '</h4></div>';

							
							$painted_cells = 0;
							// Nos faltan los 7 días L a D
							if ($current_day == 1) {
								for ($empty_cell = 1; $empty_cell < $first_day_month; $empty_cell++) {
									// print '<td></td>';
									print '<div class="cTableCell"></div>';
									$painted_cells++;
								}
							}
							// paint a cell for every day of the month
							for ($painted_cells; $painted_cells < 7; $painted_cells++) {
								if ($current_day <= $last_day_month) {
									// print '<td>' . $current_day . '</td>';
									print '<div class="cTableCell">  ' . $current_day . '</div>';
								} else {
									// print '<td></td>';
									print '<div class="cTableCell"></div>';
								}
								$current_day++;
							}
							
							
							$current_week++;
							// print '</tr>';
							print '</div class="cTableRow">';
							}
							if ($current_days = array(date('d')) == $today) {
								print '<div class="highlight"></div>';
							}
						?>
				<!-- </div> -->
			</div>
		</div>
	</div>
</div> 

	<?php
	// include
	// ("C:\MAMP\htdocs\bdosb\pruebas\dictionary_ESP.php");
	?>
	
	<table>
		<thead>
			<tr>
				<td colspan="8" class="header">
					<table>
						<tr>
							<th div="row" rowspan="2">
								<?php
								if ($month == 1) {
									print '<br><a href="?month=12&amp;year=' . ($year - 1) . '"><< Back </a>';
								} else {
									print  '<br><a href="?month=' . ($month - 1) . '&amp;year=' . $year . '"><< Back </a>';
								}

								//and the button for the next month... when Januari of December add or extract another year.
								if ($month == 12) {
									print ' | <a href="?month=1&amp;year=' . ($year + 1) . '">>> Next </a>';
								} else {
									print ' | <a href="?month=' . ($month + 1) . '&amp;year=' . $year . '"> Next >></a>';
								}
								?>
							</th>
							<th colspan="2" class="fit"> Calendar
								<?php print($months[$month] . ' ' . $year); 
								?>
							</th>
							
							<th>Today: 
								<?php
								print $today;
								?>
							</th>
						</tr>
					</table>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th> WeekNR YR </th>
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
				
				
				//Suppose it's the same day as today then border red Stel dat het toevallig dezelfde datum als vandaag is? Dan willen we een rood randje!
					
					// else {
					// 	print '<td>';
					// }

					//if today IS the same as today we want it bold as well
					// if($current_day == $day) {
					// 	print '<a href="?day='.$day_2.'&amp;month='.$month.'&amp;year='.$year.'"><b>'.$day_2.'</b></a></td>';
					// } else {
					// 	print '<a href="?day='.$day_2.'&amp;month='.$month.'&amp;year='.$year.'">'.$day_2.'</a></td>';
					// }

				?>
				
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8" class="">
					<p>
						En Torremanzanas a <?php
						print($last_day_month . ' de ' . $months[$month] . ' de ' . $year); ?>
					</p>
					<p>
					<?php
						var_dump($today);
						var_dump($date);
						var_dump($first_day_month);
						var_dump($start_month_day);
						var_dump ($current_day);
						var_dump ($current_week);
						var_dump($month);
						var_dump($months[$month]);
						var_dump($days_in_month);
						var_dump($week_days);
						var_dump($key);
						var_dump($empty_cell);
						var_dump($painted_cells);
						var_dump($current_days)
						?>
					</p>
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
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML($html);

$mpdf->Output();
?>