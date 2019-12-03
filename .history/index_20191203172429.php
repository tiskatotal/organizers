<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$numero;
$html = '
<div class="prueba">


</div>';

$mpdf->WriteHTML('<h1>Hello world!</h1>');







$mpdf->Output();
?>