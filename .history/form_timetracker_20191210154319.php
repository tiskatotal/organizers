<?php
//define the months
$months = array(1 => 'January', 2 => 'February',	3 => 'March',	4 => 'April',	5 => 'May',	6 => 'June',	7 => 'July',	8 => 'August',	9 => 'September',	10 => 'October', 11 => 'November',	12 => 'December');
// $nombre_mes = array(1 => 'Enero', 2 => 'Febrero',	3 => 'Marzo',	4 => 'Abril',	5 => 'Mayo',	6 => 'Junio',	7 => 'Julio',	8 => 'Agosto',	9 => 'Septiembre',	10 => 'Octubre', 11 => 'Noviembre',	12 => 'Diciembre',);
// $maand_namen = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maart', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Augustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'December');

//define the days of the week
$week_days = array(1 => 'monday', 2 => 'tuesday', 3 => 'wednesday', 4 => 'thursday', 5 => 'friday', 6 => 'saturday', 7 => 'sunday');
// $semana_dias = array('lunes','martes','mièrcoles','jueves','viernes','sabado','domingo');
// $week_dagen  = array('maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag','zondag');

//define the years you want to use
$years = range(2018,2030);
// $años = range(2000,2030);
// $jaren = range(2000,2030);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Calendar Generate</title>
	<link rel="stylesheet" href="css/calendar.css" />
</head>

<body>
	<h1>Select month and year</h1>
	<form action="calendar_table.php" method="get">
		<label>
			<span>Month</span>
			<select name="month">
				<?php
					foreach ($months as $month_number => $month_names) {
							$actual_month = date('m');
				?>
				<option value="<?php print($month_number);?>" <?php print($month_number == $actual_month ? 'selected':'');?>><?php print($month_names);?></option>
				<?php
					}
				?>
			</select>
		</label>

		<label>
			<span>Year</span>
			<select name="year">
				<?php
					foreach ($years as $year_number) {
						$actual_year = date('Y');
				?>	
				<option value="<?php print($year_number);?>" <?php print($year_number == $actual_year ? 'selected':'');?>><?php print($year_number);?></option>
				<?php
					}
				?>
			</select>
		</label>
		<input type="submit" value="Generate" />
	</form>
</body>

</html>