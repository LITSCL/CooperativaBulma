<?php require_once 'Categoria.php'; ?>

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
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "1") {
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8" />
    <title></title>
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
      
	<?php
	if (isset($_REQUEST["agregar"])) { //Aca se esta consultando si se dio click al bot�n Agregar.
	    $categoria = new Categoria();
	    $crearCategoria = $categoria->create($_REQUEST["codigo"], $_REQUEST["nombre"]);
	    if ($crearCategoria == 1) { //Si create es igual a 1 singnifica True (Si ingreso el registro).
	        echo "<br>Categoria ingresada";
	?>
			<a href="ListaCategoriasAdministrador.php">
			<br>
			<button class="button is-link" type="button">Mostrar lista</button></a>
	<?php 
	    }
	    else {
	        echo "<script>alert('Error de ingreso'); window.location='AgregarCategoria.php'</script>";
	    }
	}
	else { //Si no se le dio click al bot�n Agregar se muestra el formulario.
	?>
    	<div>
        	<form action="AgregarCategoria.php" method="GET">
        		<div>
            		<label class="label" for="codigo">Codigo</label>
            		<input class="input" style="width : 300px" type="number" name="codigo" required/>
        		</div>
        		<div>
            		<label class="label" for="nombre">Nombre</label>
            		<input class="input" style="width : 300px" type="text" name="nombre" required/>
        		</div>
        		<br>
				<input class="button is-link" type="submit" name="agregar" value="Agregar"/>
				<a href="ListaCategoriasAdministrador.php"><button class="button is-danger" type="button">Cancelar</button></a>
			</form>
    	</div>
	<?php 
	}
}
    ?>
</body>
</html>