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

<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Detalle del pedido Nº<?php echo $idPedido; ?></h1>
    </div>
  </div>
	
	<div class="row px-5">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">IdPedido</th>
					<th scope="col">IdProducto</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Precio</th>
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
			$detalles=seleccionarDetallePedido($idPedido);
			$total=0;
			
			foreach($detalles as $detalle){
				$idDetallePedido=$detalle['idDetallePedido'];
				$idPedido=$detalle['idPedido'];
				$idProducto=$detalle['idProducto'];
				$cantidad=$detalle['cantidad'];
				$precio=$detalle['precio'];
				$total=$total+($precio*$cantidad);
	?>
				<tr>
					<td scope="col"><?php echo $idPedido; ?></td>
					<td scope="col"><?php echo $idProducto; ?></td>
					<td scope="col"><?php echo $cantidad; ?></td>
					<td scope="col"><?php echo "$precio &euro;"; ?></td>
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
		
		<a href="misPedidos.php" class="btn btn-danger">Volver</a>
		
	</div>

</main>

<?php require_once("inc/pie.php"); ?>