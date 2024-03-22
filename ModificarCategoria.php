<?php require_once 'Categoria.php'; ?>

<?php 
session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
if (empty($_SESSION["usuario"])) { //Se esta preguntando si la sesión existe.
    header("Location: Login.php");
    exit(); //Finaliza el Script (No se lee nada mas que este abajo de esta isntrucción).
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "0") {
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
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link href="vendor/bulma-1.0.0/css/bulma.min.css" rel="stylesheet">
		<link href="vendor/fontawesome-free-6.5.0-web/css/all.min.css" rel="stylesheet">
    </head>
    <body>
    	<!-- NOTA: Todo lo que esta como atributo en las clases, son "Helpers" del FrameWork Bulma, osea, ejecutan funciones muy puntuales. -->
    
    	<!-- Comienzo del encabezado de la página utilizando Bulma. -->
    	<section class="hero is-primary"> <!-- La etiqueta section es un contenedor, el atributo de la clase está estableciendo el color (se utiliza is porque es un contenedor). -->
    		<div class="hero-body">
                <?php
                echo "<div style='text-align: right;'>Bienvenido Administador: " . substr($_SESSION["usuario"], 0, - 1); // Aca se toman todos los caracteres menos el ultimo.
                echo "<a href='Logout.php'> Cerrar Sesion</a></div>";
                ?>
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
    $codigo = $_REQUEST["codigo"];
    $categoria = new Categoria();
    $listaCategorias = $categoria->buscar($codigo);
    if (isset($_REQUEST["modificar"]) != "Modificar") { //Aca se esta verificando que no se haya enviado el formulario antes.
        if ($listaCategorias) {
            foreach ($listaCategorias as $fila) { //Se recorre una lista con un solo objeto.
    ?>          <div>
            		<form action="ModificarCategoria.php" method="GET">
                		<div>
                    		<label class="label" for="codigo">Codigo</label>
                    		<input class="input" style="width : 300px" type="number" name="codigo" value="<?php echo $fila['codigo']; ?>" readonly/>
                		</div>
                		<div>
                    		<label class="label" for="nombre">Nombre</label>
                    		<input class="input" style="width : 300px" type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required/>
                		</div>
                		<br>
    					<input class="button is-link" type="submit"  name="modificar" value="Modificar"/>
    					<a href="ListaCategoriasAdministrador.php"><button class="button is-danger" type="button">Cancelar</button></a>
					</form>
        		</div>
    <?php 
            }
        }
    }
    ?>
    
    <?php 
    if (isset($_REQUEST["modificar"])) {
        $codigo = $_REQUEST["codigo"];
        $nombre = $_REQUEST["nombre"];
        
        $categoria = new Categoria();
        $modificarCategoria = $categoria->update($codigo, $nombre);
        if ($modificarCategoria == 1) {
            echo "";    
    ?>
    	<br>Categoria modificada
    	<br>
    	<a href="ListaCategoriasAdministrador.php"><button class="button is-link">Mostrar lista</button></a>
    <?php
        }
        else {
            echo "<script>alert('Error de ingreso'); window.location='ListaCategoriasAdministrador.php'</script>";
        }    
    }
}
    ?>
</body>
</html>