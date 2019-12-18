include 'timetracker.php';

<?php

include 'timetracker.php';
ob_start();

?>

<?php
$html = ob_get_clean();
?>

<?php


require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
		'mode' => 'utf-8',
		'format' => 'A5-P',
		'orientation' => 'P'
		]);

$mpdf->WriteHTML($html);

$mpdf->Output();

// $mpdf->Output('organizers/pdf_file_name.pdf', 'F');

?>