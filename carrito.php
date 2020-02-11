<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="carrito";
	$titulo="Tu Compra";
?>

<?php require_once("inc/encabezado.php"); ?>

<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carrito de la compra</h1>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando »</a></p>
    </div>
  </div>

<?php
	if(empty($_SESSION['carrito'])){
		$mensaje="Carrito vacío";
		mostrarMensaje($mensaje);
	}else{
?>

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
			$total=0;
			foreach($_SESSION['carrito'] as $id => $cantidad){
				$producto=seleccionarProducto($id);
				
				$nombre=$producto['nombre'];
				$precio=$producto['precioOferta'];
				$subtotal=$precio*$cantidad;
				$total=$total+$subtotal;
		?>
					<tr>
						<td><a href="producto.php?idProducto=<?php echo $id; ?>"><?php echo $nombre; ?></a></td>
						<td><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=remove"><i class="fas fa-minus-circle"></i></a> <?php echo $cantidad; ?> <a href="procesarCarrito.php?id=<?php echo $id; ?>&op=add"><i class="fas fa-plus-circle"></i></a></td>
						<td><?php echo $precio; ?> €</td>
						<td><?php echo $subtotal; ?> €</td>
					</tr>

		<?php
			} //fin foreach
		?>
				
				</tbody>
				<tfoot>
					<tr>
						<th scope="row" colspan="3" class="text-right">Total</th>
						<td><?php echo $total; ?> € </td>
					</tr>
				</tfoot>
			</table>
			<a href="procesarCarrito.php?id=0&op=empty" class="btn btn-danger">Vaciar carrito</a>
			<a href="confirmarPedido.php" class="btn btn-success ml-3">Confirmar pedido</a>
		</div>
	</div>
	
<?php
		$_SESSION['total']=$total;
	} //fin if
?>

</main>


<?php require_once("inc/pie.php"); ?>