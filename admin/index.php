<?php session_start(); ?>
<?php require_once("inc/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php require_once("inc/encabezado.php"); ?>

<?php 
function imprimirFormulario($usuario){
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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

<main role="main" class="container">
	<h1 class="mt-5">Inicio de sesión</h1>
	
<?php
	if(isset($_REQUEST['redirigido'])){
		echo "<div class='alert alert-danger' role='alert'>Debes estar logueado para continuar.</div>";
	}
	
	if(!isset($_REQUEST["iniciar"])){
		$usuario="";
		imprimirFormulario($usuario);
	}else{
		$errores="";
		//datos formularios
		$usuario=recoge("usuario");
		$password=recoge("password");
	}

?>

</main>

<?php require_once("inc/pie.php"); ?>