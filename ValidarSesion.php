<?php require_once 'Usuario.php'; ?>

<?php
$rutRecibido = $_REQUEST["rut"];
$claveRecibida = $_REQUEST["clave"];

$usuario = new Usuario();
$listaUsuarios = $usuario->buscar($rutRecibido);

if ($listaUsuarios) {
    foreach ($listaUsuarios as $filaUsuario) {
        if ($filaUsuario["clave"] === $claveRecibida && $filaUsuario["tipo"] === "1") {
            session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
            $_SESSION["usuario"] = $rutRecibido . "1"; //Se crea una sesion.
            header("Location: PanelAdministrador.php"); //Se redirige al usuario al documento "Contenido.php".
            
        }
        else if ($filaUsuario["clave"] === $claveRecibida && $filaUsuario["tipo"] === "0") {
            session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
            $_SESSION["usuario"] = $rutRecibido . "0"; //Se crea una sesion.
            header("Location: ListaBeneficiosSocio.php"); //Se redirige al usuario al documento "Contenido.php".
        }
    }
}
?>
    <?php echo "<!doctype html>"; ?>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
    	<link href="vendor/bulma-1.0.0/css/bulma.min.css" rel="stylesheet">
    </head>
    <body>
    	<!-- NOTA: Todo lo que esta como atributo en las clases, son "Helpers" del FrameWork Bulma, osea, ejecutan funciones muy puntuales. -->
    
    	<!-- Comienzo del encabezado de la página utilizando Bulma. -->
    	<section class="hero is-primary"> <!-- La etiqueta section es un contenedor, el atributo de la clase está estableciendo el color (se utiliza is porque es un contenedor). -->
    		<div class="hero-body">
    			<br>
    			<div class="container"> <!-- La clase container representa que el componente puede contener otros componentes. -->
    				<h1 class="title has-text-black"> <!-- El atributo de la clase está estableciendo el color (se utiliza has porque es un elemento). -->
    					Coocretal
    				</h1>
    				<h2 class="subtitle has-text-black"> <!-- El atributo de la clase está estableciendo el color (se utiliza has porque es un elemento). -->
    					Cooperativa de Ahorro y Credito
    				</h2>
    			</div>
    		</div>
    	</section>
    	<!-- Final del encabezado de la página utilizando Bulma. -->
  <?php 
  echo "Usuario Y/O clave no valido";
  echo "<a href='Login.php'> Volver al Login</a>";
  ?>
</body>
</html>