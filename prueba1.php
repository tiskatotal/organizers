<?php
	session_start();
	$contactos = array();
	if (isset($_SESSION['prueba_con'])) {
		$contactos = $_SESSION['prueba_con'];
	}

	// Código de guardar contacto
	if (isset($_REQUEST['nombre']) && !empty($_REQUEST['nombre'])) {
		$contactos[] = array(
			'nombre' => $_REQUEST['nombre'],
		);
	}

	$_SESSION['prueba_con'] = $contactos;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pruebas</title>
	<script>
		sessionStorage.setItem("sessionData", "I am set in session storage.");
		localStorage.setItem("localData", "I am set in local storage.");
	</script>
</head>
<body>
<div>
	<form action="prueba1.php" method="post" enctype="multipart/form-data">
		<label>
			<div>Nombre</div>
			<div><input name="nombre" /></div>
		</label>
		<input type="submit" value="Añadir" />
	</form>
	<hr>
	<h2>Contactos:</h2>
	<?php
		foreach ($contactos as $idx => $con) {
			echo '<div>Nombre: ' . $con['nombre'] . '</div>';
		}
	?>
</div>
</body>
</html>
