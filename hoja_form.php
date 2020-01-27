<?php
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Hoja firmas</title>
	<link rel="stylesheet" href="css/hoja_firmas.css" />
</head>

<body>
	<h1>Hoja Firmas</h1>
	<form action="hoja_firmas.php" method="get">
		<label>
			<span>Mes</span>
			<select name="month">
				<?php
					foreach( $month_names as $id_month => $name_month ) {
						$actual_month = date('m');
				?>
					<option value="<?php print($id_month);?>" <?php print($id_month == $actual_month ? 'selected':'');?>><?php print($name_month);?></option>
				<?php
					}
				?>
			</select>
		</label>

		<label>
			<span>Año</span>
			<input type="text" name="year" value="<?php print(date('Y'));?>" />
		</label>

		<label>
			<span>Horas</span>
			<input type="text" name="hours" value="40" />
		</label>

		<input type="submit" value="Generar" />
	</form>
</body>

</html>