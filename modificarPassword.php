<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="modificarPassword";
	$titulo="Actualizar Contraseña";
?>

<?php require_once("inc/encabezado.php"); ?>

<?php 
function imprimirFormulario(){
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="form-group">
			<label for="password">Contraseña Actual</label>
			<input type="password" class="form-control" id="password" name="password" autofocus="autofocus" />
		</div>
		<div class="form-group">
			<label for="newpass">Nueva Contraseña</label>
			<input type="password" class="form-control" id="newpass" name="newpass" />
		</div>
		<div class="form-group">
			<label for="newpass2">Repita Nueva Contraseña</label>
			<input type="password" class="form-control" id="newpass2" name="newpass2" />
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
      <h1 class="display-3">Actualizar Contraseña</h1>
			
	<?php
		if(isset($_SESSION['usuario'])){
			if(!isset($_REQUEST['guardar'])){
				imprimirFormulario();
			}else{
				$errores="";
				$datos=seleccionarUsuario($_SESSION['usuario']);
				$password=$datos['password'];
				
				//recogemos valores formulario
				$pass=recoge('password');
				$newpass=recoge('newpass');
				$newpass2=recoge('newpass2');
				
				//comprobamos campos formulario				
				if($password==""){
					$errores=$errores."<li>El campo contraseña actual no puede estar vacío.</li>";
				}
				
				if($newpass==""){
					$errores=$errores."<li>El campo nueva contraseña no puede estar vacío.</li>";
				}
				
				if($newpass2==""){
					$errores=$errores."<li>El campo repita nueva contraseña no puede estar vacío.</li>";
				}
				
				if(password_verify($password, $pass)){
					$errores=$errores."<li>La contraseña actual no es correcta.</li>";
				}
				
				if($newpass!=$newpass2){
					$errores=$errores."<li>La nueva contraseña no coincide.</li>";
				}
				
				//comprobar si hay errores
				if($errores!=""){
					echo "<div class='alert alert-danger' role='alert'><ul>$errores</ul></div>";
					imprimirFormulario();
				}else{
					$user=actualizarPassword($_SESSION['usuario'],$newpass);
					//comprobamos si se actualizo correctamente
					if($user==1){
						echo "<div class='alert alert-success' role='alert'>";
							echo "La contraseña se actualizo correctamente";
						echo "</div>";
						echo "<a href='misDatos.php' class='btn btn-success'>Volver Mis Datos</a>";
					}else{
						echo "<div class='alert alert-danger' role='alert'>";
							echo "ERROR: Contraseña no actualizada";
						echo "</div>";
						imprimirFormulario();
					}
					
				}
				
			} //fin if
			
		} // fin if
	?>
    </div>
  </div>

</main>

<?php require_once("inc/pie.php"); ?>