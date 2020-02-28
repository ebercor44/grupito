<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="registrarse";
	$titulo="Registrase";
?>

<?php 
function imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono){
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="form-group">
			<label for="nombre">Usuario</label>
			<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario; ?>" autofocus="autofocus" />
		</div>
		<div class="form-group">
			<label for="password">Contraseña</label>
			<input type="password" class="form-control" id="password" name="password" />
		</div>
		<div class="form-group">
			<label for="password2">Repita Contraseña</label>
			<input type="password" class="form-control" id="password2" name="password2" />
		</div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" />
		</div>
		<div class="form-group">
			<label for="apellidos">Apellidos</label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" />
		</div>
		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" />
		</div>
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" />
		</div>
		
		<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
		
		<button type="submit" class="btn btn-success" name="guardar" value="guardar">Guardar</button>
		<a href="login.php" class="btn btn-danger">Volver</a>
	</form>
	
<?php
} //fin imprimirFormulario
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Registrarse</h1>
			
	<?php
		if(!isset($_REQUEST['guardar'])){
			$usuario="";
			$nombre="";
			$apellidos="";
			$direccion="";
			$telefono="";
			
			imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
		}else{
			$errores="";
			
			//validar Captcha
			$recaptcha_url='https://www.google.com/recaptcha/api/siteverify'; 
			$recaptcha_secret=CLAVE_SECRETA; 
			$recaptcha_response=recoge('recaptcha_response'); 
			$recaptcha=file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
			$recaptcha=json_decode($recaptcha); 

			if($recaptcha->score < 0.7){
				$errores=$errores."<li>Detectado robot.</li>";
			}
			
			//recogemos valores formulario
			$usuario=recoge("usuario");
			$password=recoge("password");
			$password2=recoge("password2");
			$nombre=recoge("nombre");
			$apellidos=recoge("apellidos");
			$direccion=recoge("direccion");
			$telefono=recoge("telefono");
			
			//comprobamos campos formulario
			if($usuario==""){
				$errores=$errores."<li>El campo usuario no puede estar vacío.</li>";
			}
			
			if($password=="" or $password2==""){
				$errores=$errores."<li>El campo contraseña no puede estar vacío.</li>";
			}
			
			if($nombre==""){
				$errores=$errores."<li>El campo nombre no puede estar vacío.</li>";
			}
			
			if($apellidos==""){
				$errores=$errores."<li>El apellidos nombre no puede estar vacío.</li>";
			}
			
			if($direccion==""){
				$errores=$errores."<li>El campo dirección no puede estar vacío.</li>";
			}
			
			if($telefono==""){
				$errores=$errores."<li>El teléfono nombre no puede estar vacío.</li>";
			}
			
			//comprobamos si hay errores
			if($password==$password2){
				if($errores!=""){
					echo "<div class='alert alert-danger' role='alert'><ul>$errores</ul></div>";
					imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
				}else{
					$user=insertarUsuario($usuario,$password,$nombre,$apellidos,$direccion,$telefono);
					//comprobamos si se inserto correctamente
					if($user==1){
						echo "<div class='alert alert-success' role='alert'>";
							echo "El usuario $usuario ha sido insertado correctamente";
						echo "</div>";
						header("Location:login.php");
					}else{
						echo "<div class='alert alert-danger' role='alert'>";
							echo "ERROR: Usuario no insertado";
						echo "</div>";
						imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
					}
				}
			}else{
				$errores=$errores."<li>La contraseña no coincide.</li>";
				echo "<div class='alert alert-danger' role='alert'><ul>$errores</ul></div>";
				imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
			}
		}
	?>
    </div>
  </div>

</main>

<?php require_once("inc/encabezado.php"); ?>