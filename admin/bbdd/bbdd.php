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



<?php
//Función para Insertar un usuario
function insertarUsuario($email,$password,$nombre,$apellidos,$direccion,$telefono){
	$con=conectarBD();
	$passEncrip=password_hash($password, PASSWORD_DEFAULT);
	$online=1;
	
	try{
		//1º-Creamos sentencia sql
		$sql="INSERT INTO usuarios(email,password,nombre,apellidos,direccion,telefono,online) VALUES(:email,:password,:nombre,:apellidos,:direccion,:telefono,:online)";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":password",$passEncrip);
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
function actualizarUsuario($email,$nombre,$apellidos,$direccion,$telefono){
	$con=conectarBD();
	$online=1;
	
	try{
		//1º-Creamos sentencia sql
		$sql="UPDATE usuarios SET nombre=:nombre,apellidos=:apellidos,direccion=:direccion,telefono=:telefono,online=:online WHERE email=:email";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":nombre",$nombre);
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
function seleccionarUsuario($usuario){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="SELECT * FROM usuarios WHERE email=:email";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":email",$usuario);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
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
//Función para Actualizar contraseña a un usuario
function actualizarPassword($email,$password){
	$con=conectarBD();
	$passEncrip=password_hash($password, PASSWORD_DEFAULT);
	
	try{
		//1º-Creamos sentencia sql
		$sql="UPDATE usuarios SET password=:password WHERE email=:email";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":password",$passEncrip);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al actualizar contraseña del usuario: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el número de filas que se modificaron
	return $stmt->rowCount();
}
?>


<?php
//Función para Insertar un pedido
function insertarPedido($idUsuario,$detallePedido,$total){
	$con=conectarBD();
	$estado=1; // 1 -> pendiente de envío
	
	try{
		//creamos una transacción
		$con->beginTransaction();
		//1º-Creamos sentencia sql
		$sql="INSERT INTO pedidos(idUsuario,estado,total) VALUES(:idUsuario,:estado,:total)";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idUsuario",$idUsuario);
		$stmt->bindParam(":estado",$estado);
		$stmt->bindParam(":total",$total);
		//4º-Ejecutar sentencia
		$stmt->execute();
		
		//guardamos el idPedido de la última linea insertada
		$idPedido=$con->lastInsertId();
		
		//recorremos array con las líneas de pedido
		foreach($detallePedido as $idProducto => $cantidad){
			//funcion para seleccionar un producto
			$producto=seleccionarProducto($idProducto);
			$precio=$producto['precioOferta'];
			
			//1º-Creamos sentencia sql
			$sql2="INSERT INTO detallepedido(idPedido,idProducto,cantidad,precio) VALUES(:idPedido,:idProducto,:cantidad,:precio)";
			//2º-Preparamos la sentencia sql (precompilada)
			$stmt=$con->prepare($sql2);
			//3º-Enlazar los parametros con los valores
			$stmt->bindParam(":idPedido",$idPedido);
			$stmt->bindParam(":idProducto",$idProducto);
			$stmt->bindParam(":cantidad",$cantidad);
			$stmt->bindParam(":precio",$precio);
			//4º-Ejecutar sentencia
			$stmt->execute();
			
		} //fin foreach
		
		//confirmamos las inserciones
		$con->commit();
		
	}catch(PDOException $e){
		//deshacemos las inserciones
		$con->rollback();
		
		echo "Error: Error al insertar un pedido: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	//devuelve el idPedido
	return $idPedido;
	
} //fin insertarPedido
?>


<?php
//Función para Seleccionar todos los pedidos
function seleccionarPedidos(){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT idPedido,p.idUsuario,fecha,total,estado,p.online,email FROM pedidos p JOIN usuarios u ON p.idUsuario=u.idUsuario";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar todos los pedidos de un usuario: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>

<?php
//Función para Seleccionar todos los detalles pedido de un pedido
function seleccionarDetallePedido($idPedido){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT * FROM detallepedido WHERE idPedido=:idPedido";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idPedido",$idPedido);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar todos los detalles pedido: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>

<?php
//Función para Seleccionar los datos de un usuario y de su pedido
function seleccionarDatosPedido($idPedido){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT idPedido,fecha,total,estado,email,nombre,apellidos,direccion,telefono FROM pedidos p JOIN usuarios u ON p.idUsuario=u.idUsuario WHERE idPedido=:idPedido";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idPedido",$idPedido);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar los datos pedido: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>

<?php
//Función para Seleccionar los datos de un usuario y de su pedido
function seleccionarDatosDetallePedido($idPedido){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT idPedido,cantidad,d.precio,nombre FROM detallepedido d JOIN productos p ON d.idProducto=p.idProducto WHERE idPedido=:idPedido";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":idPedido",$idPedido);
		//4º-Ejecutar sentencia
		$stmt->execute();
		//5º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar los datos detalle pedido: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>

<?php
//Función para Seleccionar todos los estados
function seleccionarEstados(){
	$con=conectarBD();
	
	try{
		//1º- Creamos sentencia sql
		$sql="SELECT * FROM estadopedido";
		//2º-Ejecutar sentencia
		$stmt=$con->query($sql);
		//3º-Creamos un array bidimensional con el resultado de la sentencia sql
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> parametro para que nos devuelve un array asociativo
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar todos los estados: ".$e->getMessage();
		
		//función que añade contenido en un archivo
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	
	return $rows;
}
?>




<?php
//Función para Seleccionar un administrador
function seleccionarAdministrador($usuario){
	$con=conectarBD();	
	
	try{
		//1º-Creamos sentencia sql
		$sql="SELECT * FROM administradores WHERE usuario=:usuario";
		//2º-Preparamos la sentencia sql (precompilada)
		$stmt=$con->prepare($sql);
		//3º-Enlazar los parametros con los valores
		$stmt->bindParam(":usuario",$usuario);
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
