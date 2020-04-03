<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	$pagina="confirmarPedido";
	$titulo="Mi Pedido";
?>

<?php require_once("inc/encabezado.php"); ?>

<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Confirmar pedido</h1>
    </div>
  </div>

<?php
	//comprobamos si existe la variable de sesión carrito
	if(!isset($_SESSION['carrito'])){
		echo "<div class='alert alert-danger' role='alert'>";
			echo "Tu carrito está vacío.";
		echo "</div>";
		echo "<a href='index.php' class='btn btn-success'>Volver Página Principal</a>";
		
	}else{
		//comprobamos si no existe la variable de sesión usuario
		if(!isset($_SESSION['usuario'])){
			echo "<div class='alert alert-danger' role='alert'>";
				echo "Para seguir con su compra, debe iniciar sesión.";
			echo "</div>";
			echo "<a href='login.php' class='btn btn-success'>Identifícate</a>";
			
		}else{
			$usuario=$_SESSION['idUsuario'];
			$pedido=$_SESSION['carrito'];
			$total=0;
			
			//bucle para recorrer las lineas/detalle del pedido
			foreach($pedido as $idProducto => $cantidad){
				$producto=seleccionarProducto($idProducto);
				$precio=$producto['precioOferta'];
				$subtotal=$precio*$cantidad;
				$total=$total+$subtotal;
			}
			
			//insertamos el pedido en la bbdd
			$pedidoOK=insertarPedido($usuario,$pedido,$total);
			
			//comprobamos si se inserto correctamente
			if($pedidoOK){
				//eliminamos variables de sesion del carrito y del total
				unset($_SESSION['carrito']); //eliminamos todo el carrito
				$_SESSION['unidades']=0; //eliminamos unidades
				
				echo "<div class='alert alert-success' role='alert'>";
					echo "El pedido fue insertado correctamente.";
				echo "</div>";
				
			}else{
				echo "<div class='alert alert-danger' role='alert'>";
					echo "El pedido no ha sido insertado.";
				echo "</div>";
				
			}
			
		} //fin if $_SESSION['usuario']
		
	} //fin if $_SESSION['carrito']
?>

</main>

<?php require_once("inc/pie.php"); ?>