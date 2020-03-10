<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="misDatos";
	$titulo="Mis Datos";
?>

<?php require_once("inc/encabezado.php"); ?>

<?php 
function imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono){
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="form-group">
			<label for="usuario">Usuario</label>
			<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="apellidos">Apellidos</label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" readonly="readonly" />
		</div>
		
		<a href="modificarDatos.php" class="btn btn-primary">Modificar Datos</a>
		<a href="modificarPassword.php" class="btn btn-success">Modificar Contraseña</a>
		<a href="index.php" class="btn btn-danger">Volver</a>
	</form>
	
<?php
} //fin imprimirFormulario
?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Mis Datos</h1>
			
	<?php
		if(isset($_SESSION['usuario'])){
			$datos=seleccionarUsuario($_SESSION['usuario']);
			
			$usuario=$datos['email'];
			$nombre=$datos['nombre'];
			$apellidos=$datos['apellidos'];
			$direccion=$datos['direccion'];
			$telefono=$datos['telefono'];
			
			imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
		}
	?>
    </div>
  </div>

</main>

<?php require_once("inc/pie.php"); ?>