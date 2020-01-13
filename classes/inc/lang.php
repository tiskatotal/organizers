<?php

	if (isset($_REQUEST['language'])) {
		$language = $_REQUEST['language'];
	}
	
	$lang_short = array(
		1 => 'en',
		2 => 'es',
		3 => 'nl',
	);

	$lang_long = array(
		// 'english', 'español', 'nederlands'
		'en-US' => 'english',
		'es-ES' => 'español',
		'nl-NL' => 'nederlands',
	);

	$lang_iso = array(
	'1' => 'en-US',
	'2' => 'es-ES',
	'3' => 'nl-NL',
	);

	$lang_txt = array('en', 'es', 'nl');


$week = array(
	'en' => 'week',
	'es' => 'semana',
	'nl' => 'week',
);

$day_names = array(
	'en' => array( 1 => 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
	'es' => array( 1 => 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'),
	'nl' => array( 1 => 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'),
);


$month_names = array(
	'en' => array( 1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
	'es' => array( 1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'),
	'nl' => array( 1 => 'Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'),
	
);

$month_text = array('month', 'mes', 'maand');

$year_txt = array(
	'en' => 'year',
	'es' => 'año',
	'nl' => 'jaar'
);

$years_txt = array(
	'en' => 'years',
	'es' => 'años',
	'nl' => 'jaren'

);
// var_dump($language, $year, $month_names);
?>