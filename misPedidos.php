<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="misPedidos";
	$titulo="Todos sus pedidos";
?>

<?php require_once("inc/encabezado.php"); ?>

<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Todos mis pedidos</h1>
    </div>
  </div>
	
	<div class="container">
		<div class="row px-5">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">IdPedido</th>
						<th scope="col">Email</th>
						<th scope="col">Fecha</th>
						<th scope="col">Estado</th>
						<th scope="col">Total</th>
						<th scope="col"></th>
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
				$idUsuario=$_SESSION['idUsuario'];
				$usuario=$_SESSION['usuario'];
				$pedidos=seleccionarPedidos($idUsuario);
				
				foreach($pedidos as $pedido){
					$idPedido=$pedido['idPedido'];
					$fecha=$pedido['fecha'];
					$estado=$pedido['estado'];
					$total=$pedido['total'];
		?>
					<tr>
						<td scope="col"><?php echo $idPedido; ?></td>
						<td scope="col"><?php echo $usuario; ?></td>
						<td scope="col"><?php echo $fecha; ?></td>
						<td scope="col"><?php echo $estado; ?></td>
						<td scope="col"><?php echo "$total &euro;"; ?></td>
						<td scope="col"><a href="detallePedido.php?idPedido=<?php echo $idPedido; ?>" class="btn btn-success m1-3">Detalle</a></td>
					</tr>
		<?php
				}
			}
		?>
				</tbody>
			</table>
		</div>
	</div>

</main>

<?php require_once("inc/pie.php"); ?>