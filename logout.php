<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
		if(isset($_SESSION["usuario"])){
			session_destroy(); //eliminar sesion
			header("Location:index.php");
		}else{
			header("Location:index.php?redirigido=true");
		}
?>