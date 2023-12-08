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
  
        <!-- Comienzo del menú de navegación. -->
        <nav> <!-- El elemento <nav></nav> representa una sección de una página cuyo propósito es proporcionar enlaces de navegación. -->
            <div class="tabs is-centered"> <!-- Se crea un tab y se centra utilizando un helper de Bulma. -->
                <ul>
                    <li><a href="ListaBeneficiosAdministrador.php">Lista Beneficios</a></li>
                    <li><a href="ListaCategoriasAdministrador.php">Lista Categorias</a></li>
                </ul>
            </div>
        </nav>
        <!-- Final del menú de navegación. -->
        
    	<a href="AgregarCategoria.php"><button class="button is-link">Agregar</button></a>
    	<?php 
    	$categoria = new Categoria();
    	$listaCategorias = $categoria->getAll();
    	
    	if ($listaCategorias) {
    	?>
            <!-- Comienzo de la sección principal de la página. -->
          	<section class="section has-background-grey-lighter">
                <div class="table-container">
                    <table class="table is-narrow is-fullwidth is-hoverable is-striped">
            			<tr>
            				<th>Codigo</th>
            				<th>Nombre</th>
            				<th>Opcion 1</th>
            				<th>Opcion 2</th>
            			</tr>
            			<?php
            			foreach ($listaCategorias as $fila){
            			    echo "<tr>";
            			    echo "<td>";
            			    echo $fila["codigo"];
            			    echo "</td>";
            			    echo "<td>";
            			    echo $fila["nombre"];
            			    echo "</td>";
            			    echo "<td>" . "<a href='ModificarCategoria.php?codigo=" . $fila['codigo'] . "'" . ">Modificar</a>" . "</td>";
            			    echo "<td>" . "<a href='EliminarCategoria.php?codigo=" . $fila['codigo'] . "'" . ">Eliminar</a>" . "</td>";
            			    echo "</tr>";
            			}
            			?>
            		</table>
            	</div>
            </section>	
            <!-- Final de la sección principal de la página. -->
    	<?php 
    	}
    }
	    ?>
</body>
</html>