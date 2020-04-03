<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("email/enviarEmail.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="contacto";
	$titulo="Contacto";
?>

<?php require_once("inc/encabezado.php"); ?>

<?php
function imprimirFormulario($nombre,$email,$asunto,$mensaje){
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" name="nombre" autofocus="autofocus" value="<?php echo $nombre; ?>" />
		</div>
		<div class="form-group">
			<label for="email">Correo electrónico</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" />
		</div>
		<div class="form-group">
			<label for="asunto">Asunto</label>
			<input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo $asunto; ?>" />
		</div>
		<div class="form-group">
			<label for="mensaje">Mensaje</label>
			<textarea class="form-control" name="mensaje" id="mensaje" rows="10" cols="40" ></textarea>
		</div>
		
		<button type="submit" class="btn btn-success" name="enviar" value="enviar">Enviar</button>
		<a href="index.php" class="btn btn-danger">Cancelar</a>
	</form>

<?php
}
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
 
 <?php
		if(!isset($_REQUEST['enviar'])){
			$nombre="";
			$email="";
			$asunto="";
			$mensaje="";
			
			imprimirFormulario($nombre,$email,$asunto,$mensaje);
		}else{
			$errores="";
			
			//recogemos valores formulario
			$nombre=recoge('nombre');
			$email=recoge('email');
			$asunto=recoge('asunto');
			$mensaje=recoge('mensaje');
			
			//comprobamos campos formulario
			if($nombre==""){
				$errores=$errores."<li>El campo nombre no puede estar vacío.</li>";
			}
			
			if($email==""){
				$errores=$errores."<li>El campo correo electrónico no puede estar vacío.</li>";
			}
			
			if($asunto==""){
				$errores=$errores."<li>El campo asunto no puede estar vacío.</li>";
			}
			
			if($mensaje==""){
				$errores=$errores."<li>El campo mensaje no puede estar vacío.</li>";
			}
			
			//comprobar si hay errores
			if($errores!=""){
					echo "<div class='alert alert-danger' role='alert'><ul>$errores</ul></div>";
					imprimirFormulario($nombre,$email,$asunto,$mensaje);
			}else{
				$emailOK=enviarEmail($nombre,$email,$asunto,$mensaje);
				//comprobamos si se actualizo correctamente
				if($emailOK){
					echo "<div class='alert alert-success' role='alert'>";
						echo "Correo enviado correctamente.";
					echo "</div>";
					echo "<a href='index.php' class='btn btn-success'>Volver Página Principal</a>";
				}else{
					echo "<div class='alert alert-danger' role='alert'>";
						echo "ERROR: Correo no enviado";
					echo "</div>";
					imprimirFormulario($nombre,$email,$asunto,$mensaje);
				}
			}	
		}
	?>
    </div>
  </div>

</main>

<?php require_once("inc/pie.php"); ?>