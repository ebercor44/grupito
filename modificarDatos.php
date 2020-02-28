<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="modificarDatos";
	$titulo="Actualizar Datos";
?>

<?php require_once("inc/encabezado.php"); ?>

<?php 
function imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono){
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="form-group">
			<label for="nombre">Usuario</label>
			<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" autofocus="autofocus" />
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
		
		<button type="submit" class="btn btn-success" name="guardar" value="guardar">Guardar</button>
		<a href="misDatos.php" class="btn btn-danger">Cancelar</a>
	</form>
	
<?php
} //fin imprimirFormulario
?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Actualizar Datos</h1>
			
	<?php
		if(isset($_SESSION['usuario'])){
			if(!isset($_REQUEST['guardar'])){
				$datos=seleccionarUsuario($_SESSION['usuario']);
			
				$usuario=$datos['email'];
				$nombre=$datos['nombre'];
				$apellidos=$datos['apellidos'];
				$direccion=$datos['direccion'];
				$telefono=$datos['telefono'];
				
				imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
			}else{
				$errores="";
				
				//recogemos valores formulario
				$usuario=recoge('usuario');
				$nombre=recoge('nombre');
				$apellidos=recoge('apellidos');
				$direccion=recoge('direccion');
				$telefono=recoge('telefono');
				
				//comprobamos campos formulario				
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
				
				//comprobar si hay errores
				if($errores!=""){
					echo "<div class='alert alert-danger' role='alert'><ul>$errores</ul></div>";
					imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
				}else{
					$user=actualizarUsuario($usuario,$nombre,$apellidos,$direccion,$telefono);
					//comprobamos si se actualizo correctamente
					if($user==1){
						echo "<div class='alert alert-success' role='alert'>";
							echo "El usuario $usuario ha sido insertado correctamente";
						echo "</div>";
						echo "<a href='misDatos.php' class='btn btn-success'>Volver Mis Datos</a>";
					}else{
						echo "<div class='alert alert-danger' role='alert'>";
							echo "ERROR: Usuario no insertado";
						echo "</div>";
						imprimirFormulario($usuario,$nombre,$apellidos,$direccion,$telefono);
					}
				}
				
			} //fin if
			
		} // fin if
	?>
    </div>
  </div>

</main>

<?php require_once("inc/pie.php"); ?>