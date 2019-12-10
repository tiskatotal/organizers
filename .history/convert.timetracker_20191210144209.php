<?php
	include('1-enero-20.pdf');
	require __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'format' => 'A4-L',
    'margin_left' => 0,
    'margin_right' => 0,
    'margin_top' => 0,
    'margin_bottom' => 0,
    'margin_header' => 0,
    'margin_footer' => 0,
]);

$mpdf->SetImportUse();

$ow = $mpdf->h;
$oh = $mpdf->w;
$pw = $mpdf->w / 2;
$ph = $mpdf->h;

$mpdf->SetDisplayMode('fullpage');

$pagecount = $mpdf->SetSourceFile('1-enero-20.pdf');
$pp = GetBookletPages($pagecount);

foreach ($pp as $v) {
    $mpdf->AddPage();

    if ($v[0] > 0 && $v[0] &le; $pagecount) {
        $tplIdx = $mpdf->ImportPage($v[0], 0, 0, $ow, $oh);
        $mpdf->UseTemplate($tplIdx, 0, 0, $pw, $ph);
    }

    if ($v[1] > 0 && $v[1] &le; $pagecount) {
        $tplIdx = $mpdf->ImportPage($v[1], 0, 0, $ow, $oh);
        $mpdf->UseTemplate($tplIdx, $pw, 0, $pw, $ph);
    }
}

$mpdf->Output();
exit;

function GetBookletPages($np, $backcover = true) {
    $lastpage = $np;
    $np = 4 * ceil($np / 4);
    $pp = array();

    for ($i = 1; $i &le; $np / 2; $i++) {

        $p1 = $np - $i + 1;

        if ($backcover) {
            if ($i == 1) {
                $p1 = $lastpage;
            } elseif ($p1 &ge; $lastpage) {
                $p1 = 0;
            }
        }

        $pp[] = ($i % 2 == 1)
            ? array( $p1,  $i );
            : array( $i, $p1 );
    }

    return $pp;
	}

?>