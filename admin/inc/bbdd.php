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
		$sql="UPDATE productos SET online=0 WHERE idProducto=:idProducto";
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

<?php
//Función para Seleccionar un producto
function seleccionarTarea($idProducto){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="SELECT * FROM productos WHERE idProducto=:idProducto";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idProducto",$idProducto);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5ºCreamos un array bidimensional con el resultado de la sentencia sql
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

<?php
//Función para Seleccionar una serie de productos
function seleccionarTareas($inicio,$productosPagina){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="SELECT * FROM usuarios LIMIT :inicio,:productosPagina";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":inicio",$inicio, PDO::PARAM_INT); //PDO::PARAM_INT -> fuerza que el valor sea del tipo INT
		$stmt->bindParam(":productosPagina",$productosPagina, PDO::PARAM_INT); //PDO::PARAM_INT -> fuerza que el valor sea del tipo INT
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
//Función para Insertar un usuario
function insertarUsuario($email, $password, $nombre, $apellidos, $direccion, $telefono, $online){
	$con=conectarBD();
	
	try{
		//1º-Creamos sentencia sql
		$sql="INSERT INTO usuarios(email,password,nombre,apellidos,direccion,telefono,online) VALUES(:email,:password,:nombre,:apellidos,:direccion,:telefono,:online)";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":password",$password);
		$stmt->bindParam(":nombre",$nombre);
		$stmt->bindParam(":apellidos",$apellidos);
		$stmt->bindParam(":direccion",$direccion);
		$stmt->bindParam(":telefono",$telefono);
		$stmt->bindParam(":online",$online);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al insertar usuario: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el número de filas que se modificaron
	return $stmt->rowCount();
}
?>

<?php
//Función para Actualizar un usuario
function actualizarUsuario($idUsuario, $email, $password, $apellidos, $direccion, $telefono, $online){
	$con=conectarBD();	
	$passEncrip=password_hash($password, PASSWORD_DEFAULT);
	
	try{
		//1º-Creamos sentencia sql
		$sql="UPDATE usuarios SET email=:email,password=:password,apellidos=:apellidos,direccion=:direccion,telefono=:telefono,online=:online WHERE idUsuario=:idUsuario";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idUsuario",$idUsuario);
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":password",$passEncrip);
		$stmt->bindParam(":apellidos",$apellidos);
		$stmt->bindParam(":direccion",$direccion);
		$stmt->bindParam(":telefono",$telefono);
		$stmt->bindParam(":online",$online);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al actualizar usuario: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el número de filas que se modificaron
	return $stmt->rowCount();
}
?>
	
<?php
//Función para Borrar un usuario
function eliminarUsuario($idUsuario){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="UPDATE usuarios SET online=0 WHERE idUsuario=:idUsuario";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idUsuario",$idUsuario);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al eliminar usuario: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el número de filas que se modificaron
	return $stmt->rowCount();
}
?>

<?php
//Función para Seleccionar un usuario
function seleccionarUsuario($idUsuario){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="SELECT * FROM usuarios WHERE idUsuario=:idUsuario";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idUsuario",$idUsuario);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5ºCreamos un array bidimensional con el resultado de la sentencia sql
		$row=$stmt->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar un usuario: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $row;
}
?>
	
<?php
//Función para Seleccionar una serie de usuarios
function seleccionarUsuarios($inicio,$usuariosPagina){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="SELECT * FROM usuarios LIMIT :inicio,:usuariosPagina";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":inicio",$inicio, PDO::PARAM_INT); //PDO::PARAM_INT -> fuerza que el valor sea del tipo INT
		$stmt->bindParam(":usuariosPagina",$usuariosPagina, PDO::PARAM_INT); //PDO::PARAM_INT -> fuerza que el valor sea del tipo INT
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar una serie de usuarios: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>
