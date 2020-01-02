<?php

	if (isset($_REQUEST['language'])) {
		$language = $_REQUEST['language'];
	}
	
	$language = array(
		'en' => 'english',
		'es' => 'español',
		'nl' => 'nederlands',
	);

	$languages_iso = array(
	'en' => 'en-US',
	'es' => 'es-ES',
	'nl' => 'nl-NL',
);

$week = array(
	'en' => array( 1 => 'week'),
	'es' => array( 1 => 'semana'),
	'nl' => array( 1 => 'week'),
);

$day_names = array(
	'en' => array( 1 => 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
	'es' => array( 1 => 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'),
	'nl' => array( 1 => 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'),
);


$month_names = array(
	'en' => array( 1 => 'Januar', 'Februar', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
	'es' => array( 1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'),
	'nl' => array( 1 => 'Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'),
	
);

$months_names = array(
	'en' => array( 1 => 'Januar', 'Februar', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
	'es' => array( 1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'),
	'nl' => array( 1 => 'Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'),
	
);

$year = array(
	'en' => 'year',
	'es' => 'año',
	'nl' => 'jaar'
);

$years = array(
	'en' => 'years',
	'es' => 'años',
	'nl' => 'jaren'

);
// var_dump($language, $year, $month_names);
?>