<?php
include '../../classes/inc/lang.php';
include '../../classes/inc/dateset.php';
//define the months
// $months = array(1 => 'January', 2 => 'February',	3 => 'March',	4 => 'April',	5 => 'May',	6 => 'June',	7 => 'July',	8 => 'August',	9 => 'September',	10 => 'October', 11 => 'November',	12 => 'December');

//define the days of the week
// $week_days = array(1 => 'monday', 2 => 'tuesday', 3 => 'wednesday', 4 => 'thursday', 5 => 'friday', 6 => 'saturday', 7 => 'sunday');

//define the years you want to use
// $years = range(2018,2030);

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Calendar Generate</title>
	<link rel="stylesheet" href="/organizers/assets/css_form/timetracker_form.css" />
</head>

<body>
	<h1>Select month and year</h1>
	<form action="calendar_divtable.php" method="get">
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