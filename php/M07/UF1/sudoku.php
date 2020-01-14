<?php
    session_start();
    if($_POST['username']=="admin" && $_POST['password']=="admin"){
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
    }else if(isset($_POST['logout'])){
		session_destroy();
		header('Location:./sudoku.php');
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sudoku</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>



		<!-- 
		----------------------------------------------------------------
		*
		* ERRORES CONOCIDOS
		*
		* Al intentar crear una nueva partida, la sesión se destruye,
		* por lo tanto el nombre de usuario y la contraseña se pierden
		* y vuelve a pedir inicio de sesión.
		*
		*
		----------------------------------------------------------------
		-->






		<!-- 
		*
		* NUEVA PARTIDA, Y RECUPERACION DE LOS NUMEROS
		*
		* Estas funciones crean una nueva partida, o en
		* caso de enviar solucion, guardan los numeros
		* y los vuelven a poner en su posicion.
		*
		* Tambien se llama a la funcion de comprobar las
		* filas.
		*
		-->

		<?php
			// Detecta si la se ha establecido el post destroy, destruye la sesion, y recarga la pagina
			if ($_POST['texto']['destroy']=="Nova Partida") {
				// session_destroy();
                // header('Location:./sudoku.php');
				echo '<meta http-equiv="refresh" content="0; URL=./sudoku.php">';
			}
			// Detecta si se ha establecido numeros, y en caso que si los guarda
			if (!isset($_POST['texto']) && isset($_SESSION['numeros'])) {
				$_POST['texto']=$_SESSION['numeros'];
			}
			// Detecta si se ha establecido los numeros defecto, y en caso que si los guarda
			if (isset($_SESSION['defecto'])) {
				$defecto=$_SESSION['defecto'];
			}
			// Detecta si se ha establecido numeros por el usuario, y en caso que si los guarda con la posicion
			if (isset($_POST['texto'])) {
				$numeros=$_POST['texto'];
				// Guardamos los valores, pero si es nulo se omite
				foreach ($_POST['texto'] as $tex => $value) {//Recogemos los valores que envian salvo si es nulo
					if ($value!=NULL) {
						$error2=0;
						// Necesitamos pasar el valor a string para comprobar si es nulo o no
						$tex2=(string)$tex;
						$col=$tex2[1];
						$fil=$tex2[0];
						$cord=(string)$fil.$col;
						$temporal=(int)$value;
						// Si la posicion es vacia, asignamos 0
						if (empty($defecto[$cord])) { 
							$error2=0;
						}
						// Llamamos a las funciones de comprobacion
						comprobarfil($defecto,$col,$fil,$cord,$error,$error2,$temporal);
						comprobarcol($defecto,$col,$fil,$cord,$error,$error2,$temporal);
						comprobarcuad($defecto,$col,$fil,$cord,$error,$error2,$temporal);
						// Si error es 0 le asignamos un valor, y si no lo dejamos vacio
						if ($error2==0) {
							$numeros[$cord]=$temporal;
						}else{
							$numeros[$cord]=NULL;
						}
					}
				}
				$_SESSION['numeros']=$numeros;
			}else{
				$error2=0;
				// Si los numeros defecto ya estan asignados, los guardamos
				if (isset($_SESSION['defecto'])){
					$defecto=$_SESSION['defecto'];
				}else{
					// Si los numeros defecto no estan asignados/guardados, los generamos y comprobamos
					for ($i=0; $i <20; $i++) { 
						$error=0;
						while ($error == 0) {			
							$col=rand(0,8);
							$fil=rand(0,8);
							$cord=(string)$fil.$col;
							if (empty($defecto[$cord])) {
								$error++;
							}
							
							$temporal=rand(1,9);
							comprobarfil($defecto,$col,$fil,$cord,$error,$error2,$temporal);
							comprobarcol($defecto,$col,$fil,$cord,$error,$error2,$temporal);
							comprobarcuad($defecto,$col,$fil,$cord,$error,$error2,$temporal);
						}
						$defecto[$cord]=$temporal;
					}
					$_SESSION['defecto']=$defecto;	
				}
			}
		?>

		<!-- 
		*
		* COMPROBACION DE LOS NUMEROS
		*
		* Estas funciones comprueban las filas, las columnas,
		* y cada cuadrante.
		*
		-->

		<?php
		// Funcion comprobar filas
		function comprobarfil($defecto,$col,$fil,$cord,&$error,&$error2,$temporal){
			for ($i=0; $i <9 ; $i++) { 
				if ($i != $fil) {
					$cord2=(string)$i.$col;
					if ($defecto[$cord2]==$temporal){
						$error=0;
						$error2++;
					}
				}
			}
		}

		// Funcion comprobar columnas
		function comprobarcol($defecto,$col,$fil,$cord,&$error,&$error2,$temporal){
			for ($i=0; $i <9 ; $i++) { 
				
				if ($i != $col) {
					$cord2=(string)$fil.$i;
					if ($defecto[$cord2]==$temporal){

						$error=0;
						$error2++;
					}
				}
			}
		}
		
		// Funcion comprobar cuadrante
		function comprobarcuad($defecto,$col,$fil,$cord,&$error,&$error2,$temporal){
			$valorminf;
			$valormaxf;
			$valorminc;
			$valormaxc;
			if($fil<3){
				$valorminf=0;
				$valormaxf=3;
				if ($col<3) {
					$valorminc=0;
					$valormaxc=3;
				}else if ($col>=3 && $col<6) {
					$valorminc=3;
					$valormaxc=6;
				}else{
					$valorminc=6;
					$valormaxc=9;
				}
			}else if ($fil>=3 && $fil<6) {
				$valorminf=3;
				$valormaxf=6;
				if ($col<3) {
					$valorminc=0;
					$valormaxc=3;
				}else if ($col>=3 && $col<6) {
					$valorminc=3;
					$valormaxc=6;
				}else{
					$valorminc=6;
					$valormaxc=9;
				}
			}else{
				$valorminf=6;
				$valormaxf=9;
				if ($col<3) {
					$valorminc=0;
					$valormaxc=3;
				}else if ($col>=3 && $col<6) {
					$valorminc=3;
					$valormaxc=6;
				}else{
					$valorminc=6;
					$valormaxc=9;
				}
			}
			for ($i=$valorminf; $i <$valormaxf ; $i++) { 
				for ($j=$valorminc; $j <$valormaxc ; $j++) { 
					if ($i != $fil) {
						if ($j != $col) {
							$cord2=(string)$i.$j;				
							if ($defecto[$cord2]==$temporal){
								$error=0;
								$error2++;
							}
						}
					}
				}
			}
			
		};
		?>

		<!-- 
		*
		* MAIN
		*
		* Estas funciones/html crean y pintan la tabla
		* principal (incluyendo todo el estilo), tambien
		* detecta si la sesion esta iniciada, en caso que no
		* salta el login.
		*
		-->

		<?php
			if ($_SESSION["username"]=="admin" && $_SESSION["password"]=="admin") {
		?>
			<div style='width: 650px; height: 700px; margin: 0 auto; margin-top: 2%;'>
				<h4>Sudoku</h4>
				<br/>
				<!-- Creamos el form -->
				<form method="POST" action="./sudoku.php"> 
				<!-- Dibujamos la tabla -->
					<table class="centered z-depth-3" style="border-collapse: collapse; text-align: center; width: 100%; height: 100%;">
						<?php
							for ($i=0; $i <9 ; $i++) {
								echo ("<tr>");
									for ($j=0; $j <9 ; $j++) {
										if($i==0){
											if($j==0){
												echo ("<td style='border-top: 4px solid black; border-left: 4px solid black; border-bottom: 1px solid black; border-right: 1px solid black; width: 60px; height: 60px;'>");
											}else{
												if (($j+1)%3==0)  {
													echo ("<td style='border-top: 4px solid black; border-right: 4px solid black; border-bottom: 1px solid black; border-left: 1px solid black; width: 60px; height: 60px;'>");
												}else{
													echo ("<td style='border-top: 4px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; width: 60px; height: 60px;'>");
												}
											}
										}else if(($i+1)%3==0){
											if (($j+1)%3==0) {
												echo ("<td style='border-right: 4px solid black; border-bottom: 4px solid black; border-left: 1px solid black; border-top: 1px solid black; width: 60px; height: 60px;'>");
											}else{
												if(($i+1)%3==0&&($j==0)){
													echo ("<td style='border-left: 4px solid black; border-bottom: 4px solid black; border-right: 1px solid black; border-top: 1px solid black;'>");
												}else{
													echo ("<td style='border-bottom: 4px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black:'>");
												}
											}
										}else if(($j+1)%3==0){
											echo ("<td style='border-right: 4px solid black; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black;'>");
										}else if($j==0){
											echo ("<td style='border-left: 4px solid black; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black;'>");
										}else{
											echo ("<td style='border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black;'>");
										}
							?>
							<!-- Guardamos las posiciones y creamos el array -->
							<?php
								$posicion=(string)$i.$j;
									// Esto ocurre si hay algo que los random
									if(isset($numeros)){
										if(isset($defecto["$posicion"])){
							?>
											<input class="browser-default" style="width: 50px; height: 40px; border: none; text-align: center; font-size: 18px; padding-left: 15px; background-color: white; color: green; background-color: lightgreen; border-radius: 30px;" type="number" name="texto[<?php echo($i.$j); ?>]" value="<?php echo $defecto["$posicion"]; ?>" maxlength="1" disabled />
							<?php
										}else{
							?>
											<input class="browser-default" style="width: 50px; height: 40px; border: none; text-align: center; font-size: 18px; padding-left: 15px;" type="number" min="1" max="9" name="texto[<?php echo($i.$j); ?>]" value="<?php echo $numeros["$posicion"]; ?>" maxlength="1"/>
							<?php
										}
									}else{
										// Esto ocurre solo si estan los random
										if(isset($defecto["$posicion"])){
							?>
											<input class="browser-default" style="width: 50px; height: 40px; border: none; text-align: center; font-size: 18px; background-color: white; color: green; background-color: lightgreen; border-radius: 30px;" type="text" name="texto[<?php echo($i.$j); ?>]" value="<?php echo $defecto["$posicion"]; ?>" maxlength="1" disabled />
							<?php
										}else{
							?>
											<input class="browser-default" style="width: 50px; height: 40px; border: none; text-align: center; font-size: 18px;" type="number" min="1" max="9" name="texto[<?php echo($i.$j); ?>]" maxlength="1"/>
							<?php
										}
									}
									echo ("</td>");
									}
								echo ("</tr>");
						}
							?>
						<!-- Creamos los botones -->
						<tr> 
							<td colspan="3" style='margin: left; border-right: 1px solid white; width: 60px; height: 60px;'>
								<button class='col s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1'>
									<input type="submit" value="Enviar solución" style="margin-right: -15px;"/><i class="material-icons right">send</i>
								</button>
							</td>
							<td colspan="3" style="margin-left: 0px; border-left: 1px solid white; width: 60px; height: 60px;">
								<button name='logout' class='col s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1'>
									<input type="submit" name="texto[<?php echo('destroy'); ?>]" value="Nova Partida"><i class="material-icons right" style="margin-left: 0.1px;">sync</i>
								</button>
							</td>
							<td colspan="3" style="margin: left; border-right: 1px solid white; border-left: 1px solid white; width: 60px; height: 60px;">
								<form method='POST' action='sudoku.php'>
									<button style='margin-left: 15px;' type='submit' value='Send' name='logout' class='col s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1'>Logout<i class="material-icons right" style="margin-left: 5px;">exit_to_app</i></button>
								</form>
							</td>
						</tr>	
					</table>
				</form>
			</div>
		<?php
			}else{
				// Formulario Inicio Sesión
				echo "
				<center>
				<div class='container z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row' style='display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px; solid #EEE; width: 500px;'>
					<form method='POST' action='sudoku.php'>  
					<div class='row'>
						<div class='input-field col s12'>
							<input class='validate' type='text' name='username' id='username' required />
							<label for='email'>Usuario</label>
						</div>
					</div>
					<div class='row'>
						<div class='input-field col m12'>
							<input class='validate' type='password' name='password' id='password' required />
							<label for='password'>Contraseña</label>
						</div>
					</div>
					<br/>
					<div class='row'>
						<button style='margin-left:85px;' type='submit' value='Send' class='col  s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1'>Login</button>
					</div>
					</form>
				</div>
				</center>
				";
			}
		?>
	</body>
</html>