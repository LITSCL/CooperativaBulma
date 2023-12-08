<?php require_once 'Beneficio.php'; ?>
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
    $codigo = $_REQUEST["codigo"];
    $beneficio = new Beneficio();
    $listaBeneficios = $beneficio->buscar($codigo);
    if (isset($_REQUEST["modificar"]) != "Modificar") { //Aca se esta verificando que no se haya enviado el formulario antes.
        if ($listaBeneficios) {
            foreach ($listaBeneficios as $fila) { //Se recorre una lista con un solo objeto.
    ?>
            	<div>
                	<form action="ModificarBeneficio.php" method="GET">
                	
                	<div>
                		<label class="label" for="codigo">Codigo</label>
                		<input class="input" style="width : 300px" type="number" name="codigo" value="<?php echo $fila['codigo']; ?>" readonly/>
        			</div>
        			<div>
                		<label class="label" for="nombre">Nombre</label>
                		<input class="input" style="width : 300px" type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required/>
        			</div>
        			<div>
                		<label class="label" for="descripcion">Descripcion</label>
                		<input class="input" style="width : 300px" type="text" name="descripcion" value="<?php echo $fila['descripcion']; ?>" required/>
        			</div>
    			    <?php 
            		if ($fila["estado"] === "1") {
            		    echo "
                        <div class='control'>
                      	    <label class='radio'>
                            <input type='radio' name='estado' value='1' checked>
                            Activo
                          	</label>
                          	<label class='radio'>
                            <input type='radio' name='estado' value='0'>
                            Inactivo
                          	</label>
                	   </div>";

            		}
            		else {
            		    echo "
                        <div class='control'>
                      	    <label class='radio'>
                            <input type='radio' name='estado' value='1'>
                            Activo
                          	</label>
                          	<label class='radio'>
                            <input type='radio' name='estado' value='0' checked>
                            Inactivo
                          	</label>
                	   </div>";
            		}
            		?>
        			<div>
            			<label class="label" for="fecha_inicio">Fecha</label>
            			<input class="input" style="width : 300px" type="date" name="fecha_inicio" value="<?php echo $fila['fecha_inicio']; ?>"required/>
        			</div>
            		<div>
                		<label class="label" for="categoria_codigo">Categoria</label>
                    	<?php 
                    	$categoria = new Categoria();
                    	$listaCategorias = $categoria->getAll();
                    	?>
                    	<select class="select" name="categoria_codigo">
                    	<?php 
                    	foreach ($listaCategorias as $filaCategoria) {
                    	    if ($fila["categoria_codigo"] == $filaCategoria["codigo"]) {
                    	        echo "<option selected='selected' value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
                    	    }
                    	    else {
                    	        echo "<option value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
                    	    }
                    	}
                    	?>
                    	</select>
            		</div>
            		<br>
					<input class="button is-link" type="submit" name="modificar" value="Modificar"/>
                	<a href="ListaBeneficiosAdministrador.php"><button class="button is-danger" type="button">Cancelar</button></a> <!-- Al colocar type="button" se logra que no cargue el formulario. -->
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
        $descripcion = $_REQUEST["descripcion"];
        $estado = $_REQUEST["estado"];
        $fecha_inicio = $_REQUEST["fecha_inicio"];
        $categoria_codigo = $_REQUEST["categoria_codigo"];
        
        $beneficio = new Beneficio();
        $modificarBeneficio = $beneficio->update($codigo, $nombre, $descripcion, $estado, $fecha_inicio, $categoria_codigo);
        if ($modificarBeneficio == 1) {        
    ?>
    	<br>Beneficio modificado
    	<br>
    	<a href="ListaBeneficiosAdministrador.php"><button class="button is-link">Mostrar lista</button></a>
    <?php
        }
        else {
            echo "<script>alert('Error de ingreso'); window.location='ListaBeneficiosAdministrador.php'</script>";
        }    
    }
}
    ?>
</body>
</html>