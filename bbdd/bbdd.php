<?php include("configuracion.php"); ?>

<?php
//Función para conectar a la base de datos
function conectarBD(){
	try{
		$con=new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8",USER,PASS); //establecemos conexión
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //lanzar los errores como excepciones
	}catch(PDOException $e){
		echo "Error: Error al conectar con la BD: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	return $con;
}
?>

<?php
//Función para desconectarnos de la base de datos
function desconectarBD($con){
	$con=NULL;	
	
	return $con;
}
?>

<?php
//Función para Seleccionar una serie de productos
function seleccionarOfertasPortada($numOfertas){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT * FROM productos LIMIT :numOfertas";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":numOfertas",$numOfertas, PDO::PARAM_INT); //PDO::PARAM_INT -> fuerza que el valor sea del tipo INT
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar una serie de productos: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>

<?php
//Función para Seleccionar todos los productos
function seleccionarTodasOfertas(){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT * FROM productos WHERE online=1";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar todos los productos: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>

<?php
//Función para Seleccionar un producto
function seleccionarProducto($idProducto){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT * FROM productos WHERE idProducto=:idProducto";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idProducto",$idProducto, PDO::PARAM_INT); //PDO::PARAM_INT -> fuerza que el valor sea del tipo INT
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$row=$stmt->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar un producto: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $row;
}
?>





