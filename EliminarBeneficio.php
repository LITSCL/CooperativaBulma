<?php require_once 'Beneficio.php'; ?>

<?php 
session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
if (empty($_SESSION["usuario"])) { //Se esta preguntando si la sesi�n existe.
    header("Location: Login.php");
    exit(); //Finaliza el Script (No se lee nada mas que este abajo de esta isntrucci�n).
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "0") {
?>
    <?php echo "<!doctype html>"; ?>
    <html lang="es">
    <head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link href="vendor/bulma-0.8.0/css/bulma.min.css" rel="stylesheet">
    </head>
    <body>
    	<!-- NOTA: Todo lo que esta como atributo en las clases, son "Helpers" del FrameWork Bulma, osea, ejecutan funciones muy puntuales. -->
    
    	<!-- Comienzo del encabezado de la página utilizando Bulma. -->
    	<section class="hero is-primary"> <!-- La etiqueta section es un contenedor, el atributo de la clase est� estableciendo el color (se utiliza is porque es un contenedor). -->
    		<div class="hero-body">
    			<br>
    			<div class="container"> <!-- La clase container representa que el componente puede contener otros componentes. -->
    				<h1 class="title has-text-black"> <!-- El atributo de la clase est� estableciendo el color (se utiliza has porque es un elemento). -->
    					Coocretal
    				</h1>
    				<h2 class="subtitle has-text-black"> <!-- El atributo de la clase est� estableciendo el color (se utiliza has porque es un elemento). -->
    					Cooperativa de Ahorro y Credito
    				</h2>
    			</div>
    		</div>
    	</section>
    	<!-- Final del encabezado de la p�gina utilizando Bulma. -->
    	<?php
        echo "Los socios no pueden acceder a esta pagina";
        echo "<a href='ListaBeneficiosSocio.php'> Volver a la lista</a>";
        ?>
    </body>
    </html>
<?php
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], - 1) === "1") {
    $codigo = $_REQUEST["codigo"];
    $beneficio = new Beneficio();
    $eliminarBeneficio = $beneficio->remove($codigo);
    if ($eliminarBeneficio == 1) {
?>
    <!doctype html>
    <html lang="es">
    <head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link href="vendor/bulma-0.8.0/css/bulma.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free-5.13.0-web/css/all.min.css" rel="stylesheet">
    </head>
    <body>
    	<!-- NOTA: Todo lo que esta como atributo en las clases, son "Helpers" del FrameWork Bulma, osea, ejecutan funciones muy puntuales. -->
    
    	<!-- Comienzo del encabezado de la p�gina utilizando Bulma. -->
    	<section class="hero is-primary"> <!-- La etiqueta section es un contenedor, el atributo de la clase est� estableciendo el color (se utiliza is porque es un contenedor). -->
    		<div class="hero-body">
                <?php
                echo "<div style='text-align: right;'>Bienvenido Administador: " . substr($_SESSION["usuario"], 0, - 1); // Aca se toman todos los caracteres menos el ultimo.
                echo "<a href='Logout.php'> Cerrar Sesion</a></div>";
                ?>
            	<div class="container"> <!-- La clase container representa que el componente puede contener otros componentes. -->
    				<h1 class="title has-text-black"> <!-- El atributo de la clase est� estableciendo el color (se utiliza has porque es un elemento). -->
    					Coocretal
    				</h1>
    				<h2 class="subtitle has-text-black"> <!-- El atributo de la clase est� estableciendo el color (se utiliza has porque es un elemento). -->
    					Cooperativa de Ahorro y Credito
    				</h2>
    			</div>
    		</div>
    	</section>
    	<!-- Final del encabezado de la p�gina utilizando Bulma. -->
    
    	<br/>
    	Beneficio eliminado
    	<a href="ListaBeneficiosAdministrador.php">
    		<br/>
			<button class="button is-link" type="button">Mostrar lista</button>
		</a>
    </body>
    </html>
    <?php
    } else {
        echo "<script>alert('Error al eliminar'); window.location='ListaBeneficiosAdministrador.php'</script>";
    }
}
    ?>