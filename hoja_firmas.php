<?php

$date = new DateTime();
$month = $date->format('m');
$year = $date->format('Y');
$hours = 40;
if (isset($_REQUEST['month'])) {
	$month = $_REQUEST['month'];
}
if (isset($_REQUEST['year'])) {
	$year = $_REQUEST['year'];
}
if (isset($_REQUEST['hours'])) {
	$hours = $_REQUEST['hours'];
}
$date->setDate($year, $month, 1);

$month_names = array(
	1 => 'Enero',
	2 => 'Febrero',
	3 => 'Marzo',
	4 => 'Abril',
	5 => 'Mayo',
	6 => 'Junio',
	7 => 'Julio',
	8 => 'Agosto',
	9 => 'Septiembre',
	10 => 'Octubre',
	11 => 'Noviembre',
	12 => 'Diciembre',
);

$days_in_month = $date->format('t');
$last_work_day = $days_in_month;

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Hoja firmas</title>
	<link rel="stylesheet" href="css/hoja_firmas.css" />
</head>

<body>
	<table>
		<thead>
			<tr>
				<td colspan="4" class="cabecera">
					<table>
						<tr>
							<th colspan="2">REGISTRO DIARIO DE JORNADA EN TRABAJADORES A TIEMPO PARCIAL</th>
						</tr>
						<tr>
							<th>EMPRESA</th>
							<th>TRABAJADOR</th>
						</tr>
						<tr>
							<td>Razón Social: Thorsten Rapp</td>
							<td>Nombre: Tjitske Bianchi</td>
						</tr>
						<tr>
							<td>NIF/CIF: X0900073Z</td>
							<td>NIF: X3005998J</td>
						</tr>
						<tr>
							<td colspan="2">
								Mes/año de liquidación:
								<?php print($month_names[$month] . '/' . $year); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Día del mes</th>
				<th class="fit">Anotaciones</th>
				<th>HORAS NORMALES</th>
				<th>HORAS EXTRAS</th>
			</tr>
			<!-- ENTRADAS DEL MES -->
			<?php
			$total = 0;
			for ($i = 1; $i <= $days_in_month; $i++) {
				$day_of_week = $date->format('N'); // 1 for Monday
				?>
				<tr>
					<td>
						<?php print($i); ?>
					</td>
					<td></td>
					<td>
						<?php
							if ($day_of_week < 6 && $total < $hours) {
								print(2);
								$total += 2;
								$last_work_day = $i;
							}
							?>
					</td>
					<td></td>
				</tr>
			<?php
				$date->add(new DateInterval('P1D'));
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>Total mes</th>
				<th></th>
				<th>
					<?php print($total); ?>
				</th>
				<th>0</th>
			</tr>
			<tr>
				<td colspan="4" class="notal_legal">
					<p>
						En cumplimiento del Art. 12, apartado 4 c) de la Ley del Estatuto de los Trabajadores
					</p>
					<p>
						En Torremanzanas a <?php print($last_work_day . ' de ' . $month_names[$month] . ' de ' . $year); ?>
					</p>
				</td>
			</tr>
		</tfoot>
	</table>
	<table class="firmas">
		<tr>
			<th>Firma de la empresa</th>
			<th></th>
			<th>Firma del trabajador</th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</body>

</html>