<?php
// include ('convert.timetracker.php');

use Mpdf\Tag\SetHtmlPageHeader;

ob_start();
$date = new DateTime();
// $day = $date->format('N'); // Day of the month, 2 digits with leading zeros 01 to 31    
$month = $date->format('m'); //Numeric representation of a month, with leading zeros 01 through 12  
$year = $date->format('Y'); //A full numeric representation of a year, 4 digits 1999 or 2003

if (isset($_REQUEST['day'])) {
    $day = $_REQUEST['day'];
}

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

$last_day_month = $date->format('t'); //number of days in given month
$first_day_month = $date->format('N'); //Starts the month on the right weekday 1 for monday 7 sunday
$start_month_day = $date->format('D'); // textual representation
$current_cells = array();
$years = range(2019, 2030);
<SetHtmlPageHeaderByName [@my]
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>TimeTracker</title>
	<link rel="stylesheet" href="css/timetracker.css" />
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
	<!-- <htmlpageheader name="myHeader1">
    <div style="text-align: right>My document</div>
</htmlpageheader> -->

<htmlpageheader name="myHeader"> My document </htmlpageheader>
</body>
</html>
<?php
$html = ob_get_clean();
?>

<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'L'
]);

// $mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML($html);
$mpdf->AddPage();

$ow = $mpdf->h;
$oh = $mpdf->w;
$pw = $mpdf->w / 2;
$ph = $mpdf->h;

// $mpdf->SetDisplayMode('fullpage');

$mpdf->Output();
?>