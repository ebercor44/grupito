<?php session_start();

	$titulo="Confirmar pedido";
	$pagina="Mi pedido";

	include_once("inc/encabezado.php");
	include_once("inc/funciones.php");
	include_once("bbdd/bbdd.php");


?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Confirmar pedido</h1>
    </div>
  </div>

  <div class="container">
		
		<?php
			if(!isset($_SESSION['carrito'])){
				
				echo "Tu carrito esta vacío.";
				echo "<a href=\"index.php\" class=\"btn btn-primary ml-3\">Volver.</a>";
				
			}else{
				
				if(!isset($_SESSION['mail'])){
					echo "Para procesar la compra, debe iniciar sesión.";
					echo "<a href=\"login.php\" class=\"btn btn-primary ml-3\">Iniciar sesión</a>";
					
				}else{
					
					$idUsuario=$_SESSION['idUsuario'];
					
					$detallePedido=$_SESSION['carrito'];
					
					$total=0;
					foreach($detallePedido as $id=>$cantidad){
						$producto = seleccionarProducto($id);
						$precio = $producto['precioOferta'];
						$subtotal = $precio * $cantidad;
						$total = $total + $subtotal;
					}
					
					$pedidoOK=insertarPedido($idUsuario, $detallePedido, $total);
					
					if($pedidoOK){
							echo "El pedido fue insertado";
							
						
					}else{
							echo "El pedido NO fue insetado";
							
					}
				
				}
				
			}





		?>

  </div> <!-- /container -->

</main>

<?php
	include_once("inc/pie.php");
?>