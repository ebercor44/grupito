<?php session_start();

	include_once("inc/funciones.php");
	include_once("bbdd/bbdd.php");
	
	$pagina="Mis pedidos";
	$titulo="Todos sus pedidos";

	include_once("inc/encabezado.php");

?>
	<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h2 class="display-3">Todos mis pedidos</h2>
    </div>
  </div>
	
	<div class="container">
	
	<div class="row px-5">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Email</th>
				<th scope="col">IdPedido</th>
				<th scope="col">Fecha</th>
				<th scope="col">Estado</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<tbody>
<?php	
	if(!isset($_SESSION['mail'])){
		echo "Para ver sus pedidos, debe iniciar sesión.";
		echo "<a href=\"login.php\" class=\"btn btn-primary ml-3\">Iniciar sesión</a>";
		
	}else{
		$idUsuario = $_SESSION['idUsuario'];
		$mail = $_SESSION['mail'];
	
		$pedidos = mostrarPedidos($idUsuario);
	
		foreach($pedidos as $pedido){
			$idPedido = $pedido['idPedido'];
			$fecha = $pedido['fecha'];
			$estado = $pedido['estado'];
			$total = $pedido['total'];
		
		?>
			<tr>
				<td scope="col"><?php echo $mail; ?></td>
				<td scope="col"><?php echo $idPedido; ?></td>
				<td scope="col"><?php echo $fecha; ?></td>
				<td scope="col"><?php echo $estado; ?></td>
				<td scope="col"><?php echo "$total &euro;"; ?></td>
				<td scope="col"><a href="detallePedido.php?idPedido=<?php echo $idPedido; ?>" class="btn btn-success ml-3">Detalles</a></td>
			<tr>
		<?php
		}
		?>
				</tbody>
		<?php
	}
	
?>		</table>
			</div>
		</div>
	</main>
	
<?php include_once("inc/pie.php"); ?>