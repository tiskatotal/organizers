<?php
include ('../../classes/inc/lang.php');
include ('../../classes/inc/dateset.php');

include ( '../../classes/class.organizer.php');

$page = new organizer_page();

$calendar = array(1 => 'print pdf', 2 => 'web html');
$timetracker = array(1 => 'print pdf', 2 => 'web html');
$size = array(1 => 'A5', 2 => 'A4');
$lang_text = array();
$cover = array(1 => 'wood', 2 => 'metal', 3 => 'custom cut');


?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Tiska Total Organizers</title>
	<link rel="stylesheet" href="../../assets/css_form/timetracker_form.css" />
</head>

<body>
	<h1>SELECT => language. SELECT calendar, timetracker year, month</h1>
	<form action="timetracker.php" method="get">
		<label>
			<span>Language</span>
			<select name="language">
				<?php // 
				foreach ($language as $lang_iso => $lang_long) {
				?>
				<option value="<?php print($lang_long); ?>"><?php print($lang_long); ?></option>
				<?php
				
				}
				?>
			</select>
		</label>

		<label>
			<span>Calendar</span>
			<select name="calendar">
				<?php
				foreach ($calendar as $calendar_number => $calendar_names) {
					$actual_calendar = date('m');
				?>
					<option value="<?php print($calendar_number); ?>" <?php print($calendar_number == $actual_calendar ? 'selected' : ''); ?>><?php print($calendar_names); ?></option>
				<?php
				}
				?>
			</select>
		</label>

		<label>
			<span>Timetracker</span>
			<select name="timetracker">
				<?php
				foreach ($timetracker as $timetracker_number => $timetracker_names) {
					$actual_timetracker = date('m');
				?>
					<option value="<?php print($timetracker_number); ?>" <?php print($timetracker_number == $actual_timetracker ? 'selected' : ''); ?>><?php print($timetracker_names); ?></option>
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
					<option value="<?php print($year_number); ?>" <?php print($year_number == $actual_year ? 'selected' : ''); ?>><?php print($year_number); ?></option>
				<?php
				}
				?>
			</select>
		</label>

		<label>
			<span>Month</span>
			<select name="month">
				<?php
				foreach ($months as $month_number => $month_names) {
					$actual_month = date('m');
				?>
					<option value="<?php print($month_number); ?>" <?php print($month_number == $actual_month ? 'selected' : ''); ?>><?php print($month_names); ?></option>
				<?php
				}
				?>
			</select>
		</label>

		<label>
			<span>Size</span>
			<select name="size">
				<?php
				foreach ($size as $size_booklet) {
					$actual_size = '';
				?>
				<option value="<?php print($size_booklet); ?>" <?php print($size_booklet == $actual_size ? 'selected' : ''); ?>><?php print($size_booklet); ?></option>
				<?php
				}
				?>
			</select>
		</label>

		<label>
			<span>Cover</span>
			<select name="cover">
				<?php
				foreach ($cover as $type_cover) {
					$actual_cover = '';
				?>
				<option value="<?php print($type_cover); ?>" <?php print($type_cover == $actual_cover ? 'selected' : ''); ?>><?php print($type_cover); ?></option>
				<?php
				}
				?>
			</select>
		</label>
		
		<input type="submit" value="Generate" />
	</form>
</body>

</html>
<?php
var_dump($actual_year);
var_dump($actual_month);

var_dump($language);
var_dump($lang_iso);
var_dump($lang_short);
var_dump($lang_long);
var_dump($lang_txt);

var_dump($day_names);
var_dump($month_names);


?>