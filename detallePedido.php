<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="detallePedido";
	$titulo="Detalle del pedido";
?>

<?php require_once("inc/encabezado.php"); ?>

<?php
	$idPedido=recoge('idPedido');
	$usuario=$_SESSION['usuario'];
?>

<?php
	//comprobamos si existe la variable de sesión carrito
			if(!isset($_SESSION['usuario'])){
				echo "<div class='alert alert-danger' role='alert'>";
					echo "Para tener acceso a sus pedidos, debe iniciar sesión.";
				echo "</div>";
				echo "<a href='login.php' class='btn btn-success'>Identifícate</a>";
				
			}else{
				$datos=seleccionarDatosPedido($idPedido);
				$estados=seleccionarEstados();
	
				foreach($datos as $dato){
					$fecha=$dato['fecha'];
					$email=$dato['email'];
					$nombre=$dato['nombre'];
					$apellidos=$dato['apellidos'];
					$direccion=$dato['direccion'];
					$telefono=$dato['telefono'];
					$estadoP=$dato['estado'];
				}
			}	
?>

<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Detalle del pedido Nº<?php echo $idPedido; ?></h1>
			<br />
      <h4 class="display-5"><strong>Usuario:</strong> <?php echo $email; ?></h4>
      <h4 class="display-5"><strong>Nombre:</strong> <?php echo "$nombre $apellidos"; ?></h4>
      <h4 class="display-5"><strong>Dirección:</strong> <?php echo $direccion; ?></h4>
      <h4 class="display-5"><strong>Teléfono:</strong> <?php echo $telefono; ?></h4>
      <h4 class="display-5"><strong>Estado:</strong>
				<select name="estado">
					<?php
						foreach($estados as $estado){
							$idEstado=$estado['idEstadoPedido'];
							$nombreEstado=$estado['estado'];
					?>	
							<option value='<?php echo "$idEstado"; ?>' <?php if($idEstado==$estadoP){ echo " selected"; } ?>> <?php echo $nombreEstado; ?> </option>
					<?php	
						}
					?>
				</select>
			</h4>
    </div>
  </div>
	
	<div class="container">
		<div class="row px-5">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Producto</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Precio</th>
						<th scope="col">Subtotal</th>
					</tr>
				</thead>
				<tbody>
		<?php
			//comprobamos si existe la variable de sesión carrito
			if(!isset($_SESSION['usuario'])){
				echo "<div class='alert alert-danger' role='alert'>";
					echo "Para tener acceso a sus pedidos, debe iniciar sesión.";
				echo "</div>";
				echo "<a href='login.php' class='btn btn-success'>Identifícate</a>";
				
			}else{
				$detalles=seleccionarDatosDetallePedido($idPedido);
				$total=0;
				
				foreach($detalles as $detalle){
					$producto=$detalle['nombre'];
					$cantidad=$detalle['cantidad'];
					$precio=$detalle['precio'];
					$subtotal=$precio*$cantidad;
					$total=$total+($precio*$cantidad);
		?>
					<tr>
						<td scope="col"><?php echo $producto; ?></td>
						<td scope="col"><?php echo $cantidad; ?></td>
						<td scope="col"><?php echo "$precio &euro;"; ?></td>
						<td scope="col"><?php echo "$subtotal &euro;"; ?></td>
					</tr>
		<?php
				}
			}
		?>
					<tr>
						<td scope="row" colspan="4" class="text-right"><strong>TOTAL=<?php echo "$total &euro;"; ?></strong></td>
					</tr>
				</tbody>
			</table>
			
			<p><a href="misPedidos.php" class="btn btn-danger">Volver</a></p>
			
		</div>
	</div>

</main>

<?php require_once("inc/pie.php"); ?>