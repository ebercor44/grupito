<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="login";
	$titulo="Iniciar Sesión";
?>

<?php 
function imprimirFormulario($usuario){
?>
	<form action="#" method="post">
		<div class="form-group">
			<label for="usuario">Usuario</label>
			<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario; ?>" autofocus="autofocus" />
		</div>
		<div class="form-group">
			<label for="password">Contraseña</label>
			<input type="password" class="form-control" id="password" name="password" />
		</div>
		<button type="submit" class="btn btn-success" name="iniciar" value="iniciar">Iniciar Sesión</button>
	</form>
	
<?php
} //fin imprimirFormulario
?>

<?php require_once("inc/encabezado.php"); ?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Iniciar Sesión</h1>
			
	<?php
		if(isset($_REQUEST['redirigido'])){
			echo "<div class='alert alert-danger' role='alert'>Debes estar logueado para continuar.</div>";
		}
		
		if(!isset($_REQUEST['iniciar'])){
			$usuario="";
			imprimirFormulario($usuario);
		}else{
			$errores="";
			
			//datos formulario
			$usuario=recoge('usuario');
			$password=recoge('password');
			
			//datos bbdd
			$datos=seleccionarUsuario($usuario);
			
			$idUser=$datos['idUsuario'];
			$user=$datos['email'];
			$pass=$datos['password'];
			
			//comprobamos campos formulario
			if($usuario==""){
				$errores=$errores."<li>El campo usuario no puede estar vacío.</li>";
			}
			
			if($password==""){
				$errores=$errores."<li>El campo contraseña no puede estar vacío.</li>";
			}
	
			//comprobamos si hay errores
			if($errores==""){
				if(password_verify($password, $pass)){
					$_SESSION['usuario']=$usuario;
					$_SESSION['idUsuario']=$idUser;
					header("Location:index.php");
				}else{
					$errores=$errores."<li>Los campos usuario o contraseña son incorrectos.</li>";
					echo "<div class='alert alert-danger' role='alert'><ul>$errores</ul></div>";
					imprimirFormulario($usuario);
				}
			}else{
				echo "<div class='alert alert-danger' role='alert'><ul>$errores</ul></div>";
				imprimirFormulario($usuario);
			}
		}
	?>
			
			<br />
      <p>Si no tiene cuenta, pulsa en el botón Registrarse.</p>
			<p><a class="btn btn-primary" href="registrarse.php" role="button">Registrarse »</a></p>
    </div>
  </div>

</main>

<?php require_once("inc/pie.php"); ?>