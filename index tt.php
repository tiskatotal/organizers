<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf= new \Mpdf\Mpdf(['c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0]); 

// $mpdf->SetDisplayMode('fullpage');

// $mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML(file_get_contents('timetracker.php'));
	    
$mpdf->Output();

// $mpdf = new \Mpdf\Mpdf([
// 	'mode' => 'utf-8',
// 	'format' => 'A5-P',
// 	'orientation' => 'P'
// 	]);
	
// 	$mpdf->WriteHTML($html);
// 	// $mpdf->Output('organizers/pdf_file_name.pdf', 'F');
	
// 	$mpdf->Output();

?>