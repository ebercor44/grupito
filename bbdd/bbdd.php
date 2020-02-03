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
//Función para insertar un producto
function insertarProducto($nombre, $introDescripcion, $descripcion, $imagen, $precio, $precioOferta, $online){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="INSERT INTO productos(nombre,introDescripcion,descripcion,imagen,precio,precioOferta,online) VALUES(:nombre,:introDescripcion,:descripcion,:imagen,:precio,:precioOferta,:online)";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":nombre",$nombre);
		$stmt->bindParam(":introDescripcion",$introDescripcion);
		$stmt->bindParam(":descripcion",$descripcion);
		$stmt->bindParam(":imagen",$imagen);
		$stmt->bindParam(":precio",$precio);
		$stmt->bindParam(":precioOferta",$precioOferta);
		$stmt->bindParam(":online",$online);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al insertar producto: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el ID del ultimo registro insertado
	return $con->lastInsertId();
}
?>

<?php
//Función para actualizar un producto
function actualizarProducto($idProducto, $nombre, $introDescripcion, $descripcion, $imagen, $precio, $precioOferta, $online){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="UPDATE productos SET nombre=:nombre, introDescripcion:=introDescripcion, descripcion=:descripcion, imagen=:imagen, precio=:precio, precioOferta=:precioOferta, online=:online WHERE idProducto:=idProducto";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idProducto",$idProducto);
		$stmt->bindParam(":introDescripcion",$introDescripcion);
		$stmt->bindParam(":descripcion",$descripcion);
		$stmt->bindParam(":imagen",$imagen);
		$stmt->bindParam(":precio",$precio);
		$stmt->bindParam(":precioOferta",$precioOferta);
		$stmt->bindParam(":online",$online);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al actualizar producto: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el número de filas que se modificaron
	return $stmt->rowCount();
}
?>

<?php
//Función para borrar un producto
function eliminarProducto($idProducto){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="DELETE FROM productos WHERE idProducto=:idProducto";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idProducto",$idProducto);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al eliminar producto: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el número de filas que se modificaron
	return $stmt->rowCount();
}
?>





