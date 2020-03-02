<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="contacto";
	$titulo="Contacto";
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
}
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
      <p>Formulario de contacto</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Nuestras ofertas »</a></p>
    </div>
  </div>

  <div class="container">

  </div> <!-- /container -->

</main>

<?php require_once("inc/pie.php"); ?>