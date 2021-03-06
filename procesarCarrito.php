<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
	//recogemos valores URL
	$idProducto=recoge("id");
	$op=recoge("op");
	
	if($idProducto=="" or $op==""){
		header("Location: index.php");
	}
	
	//seleccionamos todos datos del producto
	$producto=seleccionarProducto($idProducto);
	
	//si los datos vienen vacios
	if(empty($producto)){
		header("Location: index.php");
	}
	
	switch($op){
		case "add":
			//comprobamos si el producto ya está en el carrito
			if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto]++;
				$_SESSION['unidades']++;
			}else{
				$_SESSION['carrito'][$idProducto]=1;
				$_SESSION['unidades']=(isset($_SESSION['unidades']))? $_SESSION['unidades']+1 : 1; //si existe $_SESSION['unidades'] sumamos 1 y sino lo igualamos a 1
			}
			break;
			
		case "remove":
			//comprobamos si el producto ya está en el carrito
			if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto]--;
				$_SESSION['unidades']--;
				
				//comprobamos si las unidades son menores o iguales a 0
				if($_SESSION['carrito'][$idProducto]<=0){
					unset($_SESSION['carrito'][$idProducto]); //eliminamos el producto
				}
			}
			break;
		
		case "empty":
			unset($_SESSION['carrito']); //eliminamos todo el carrito
			unset($_SESSION['unidades']); //eliminamos unidades
			unset($_SESSION['total']); //eliminamos total
			break;
			
		default:
			header("Location: index.php");
	} //fin switch
	
	header("Location: carrito.php");
	
?>