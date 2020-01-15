<?php
	try {//Creamos la conexión a la base de datos especificando los campos clave
				$hostname = "localhost";//Donde se hara la consulta
				$dbname = "world";//Que tabla
				$username = "root";//Que usuario
				$pw = "";//Password
				$dbh = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");//Creamos el PDO con la conexión
		  	} catch (PDOException $e) {
				echo "Failed to get DB handle: " . $e->getMessage() . "\n";
				exit;
		  	}
		    //require_once("registro.php");

		    try {//Realizamos la primera consulta para Seleccionar los continentes sin repetir Gracias al Distinct
	    		$stmt = $dbh->prepare("SELECT DISTINCT Continent FROM country");
				$stmt->execute(array('100','crack'));
				$row=$stmt->fetchAll(PDO::FETCH_ASSOC);//Y Guardamos el resultado en $Row
		   	}catch(PDOExecption $e) {
				print "Error!: " . $e->getMessage() . " Desfem</br>";
		    }
		    if (isset($_POST["continentes"])) {//Si hemos enviado por $_POST el continente lo guardaremos para hacer el filtro
		    	$continentes=$_POST["continentes"];
		    	try {//Ahora recogemos el nombre, continente y población de cada país
	    		$stmt = $dbh->prepare("SELECT Name,Continent,Population FROM country WHERE Continent = ?");
				$stmt->execute(array($continentes));//En la query se cambiará el ? por $contienentes
				$row2=$stmt->fetchAll(PDO::FETCH_ASSOC);//Y guardamos los resultados
			   	}catch(PDOExecption $e) {
					print "Error!: " . $e->getMessage() . " Desfem</br>";
			    }
			    try {//Ahora sumara la poblacion total de todos los paises
	    		$stmt = $dbh->prepare("SELECT sum(Population) as PoblacionTotal FROM `country`");
				$stmt->execute(array('100','crack'));
				$row3=$stmt->fetchAll(PDO::FETCH_ASSOC);//y la guardamos para operar luego
			   	}catch(PDOExecption $e) {
					print "Error!: " . $e->getMessage() . " Desfem</br>";
			    }
		    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Examen PHP UF 3</title>
</head>
<body>
	<h1>Continentes</h1>
	<form method="POST" action="./main.php" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					<select name="continentes">
						<?php
							//Mostramos todos los continentes que hemos recogido de la query gracias al Count y los vamos mostrando como Opciones
							for ($i=0; $i<count($row) ; $i++) { 
						?>
								<option value="<?php echo $row[$i]["Continent"]?>"><?php echo $row[$i]["Continent"]?></option>
						<?php
							 }
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" name="SEND"></td>
				<?php
					//Enviamos el formulario para recoger el parametro de continentes
				?> 
			</tr>
		</table>
	</form>
	<?php
		if (isset($_POST["continentes"])) {//Si el continente no es NULL mostraremos estos campos
	?>
			<table border="1">
				<tr>
					<td style="background-color: skyblue">Nombre del Pais</td>
					<td style="background-color: skyblue">Continente</td>
					<td style="background-color: skyblue">Poblacion</td>
				</tr>
				<?php
				//Iniciamos la variables a 0 para evitar problemas
				$suma=0;
				$PoblacionTotal=0;
					for ($i=0; $i<count($row2) ; $i++) { //Ahora mostraremos cada país con su continente y población
				?>
						<tr>
							<td><?php echo $row2[$i]["Name"]?></td>
							<td><?php echo $row2[$i]["Continent"]?></td>
							<td><?php echo $row2[$i]["Population"]?></td>
							<td hidden="hidden"><?php $suma+=$row2[$i]["Population"]?></td>
							<?php
								//En un campo oculto iremos sumando la población de cada país
							?>
						</tr>
				<?php
					 }
				?>
				<tr>
					<td style="background-color: skyblue">La poblacion total es </td>
					<td><?php echo $suma ?></td>
					<td>Personas </td>
				</tr>
				<?php
				//Aquí mostramos la suma de cada continente
				//$PoblacionTotal=$suma;
				?>
				<tr>
					<td style="background-color: skyblue">El % de Poblacion en el mundo es </td>
					<td>
						<?php 
							//Y calculamos el % en la poblacionTOTAL
							echo $PoblacionTotal=100*($suma/$row3[0]["PoblacionTotal"]);
						?>		
					</td>
					<td>%</td>
				</tr>
			</table>
	<?php
		}
	?>

</body>
</html>