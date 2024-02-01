<?php require_once 'Beneficio.php'; ?>
<?php require_once 'Categoria.php'; ?>

<?php 
session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
if (empty($_SESSION["usuario"])) { //Se esta preguntando si la sesión existe.
    header("Location: Login.php");
    exit(); //Finaliza el Script (No se lee nada mas que este abajo de esta isntrucción).
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "1") {
?>
    <?php echo "<!doctype html>"; ?>
    <html lang="es">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
    	<link href="vendor/bulma-0.8.0/css/bulma.min.css" rel="stylesheet">
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
        echo "Los administradores no pueden acceder a esta pagina";
        echo "<a href='PanelAdministrador.php'> Volver al panel</a>";
        ?>
	</body>
    </html>
<?php
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "0") {
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="vendor/bulma-0.8.0/css/bulma.min.css" rel="stylesheet">
	<link href="vendor/fontawesome-free-6.5.0-web/css/all.min.css" rel="stylesheet">
</head>
<body>
	<!-- Comienzo del encabezado de la página utilizando Bulma. -->
	<section class="hero is-primary"> <!-- La etiqueta section es un contenedor, el atributo de la clase está estableciendo el color (se utiliza is porque es un contenedor). -->
		<div class="hero-body">
            <?php
            echo "<div style='text-align: right;'>Bienvenido Socio: " . substr($_SESSION["usuario"], 0, - 1); // Aca se toman todos los caracteres menos el ultimo.
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
	$categoria = new Categoria();
	$beneficio = new Beneficio();
	$listaCategorias = $categoria->getAll();
	$listaBeneficios = $beneficio->getAll();
	
	if ($listaBeneficios) {
	?>
		<form action="ListaBeneficiosSocio.php" method="GET">

      		<input class="button is-link" type="submit" name="filtrar" value="Filtrar"/>
      		<div class="select">
          		<select name="categoriaFiltrada">
      			<?php 
      			foreach ($listaCategorias as $filaCategoria) {
      			    if (isset($_REQUEST["categoriaFiltrada"])) {
      			        if ($_REQUEST["categoriaFiltrada"] == $filaCategoria["codigo"]) {
      			            echo "<option selected='selected' value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
      			        }
      			        else {
      			            echo "<option value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
      			        }
      			    }
      			    else { 
      			       echo "<option value=" . $filaCategoria["codigo"] . ">".$filaCategoria["nombre"] . "</option>";
      			    }
      			}
		        ?>
          		</select>
      		</div>
				
		</form>

		<section class="section has-background-grey-lighter">
			<div class="table-container">
				<table class="table is-narrow is-fullwidth is-hoverable is-striped">
        			<tr>
        				<th>Codigo</th>
        				<th>Nombre</th>
        				<th>Descripcion</th>
        				<th>Estado</th>
        				<th>Fecha</th>
        				<th>Categoria</th>
        			</tr>
        			<?php
        			if (isset($_REQUEST["filtrar"])) {
        			    foreach ($listaBeneficios as $filaBeneficios) {
        			        if ($filaBeneficios["categoria_codigo"] == $_REQUEST["categoriaFiltrada"]) {
        			            if ($filaBeneficios["estado"] == 1){
        			                echo "<tr>";
        			                echo "<td>" . $filaBeneficios["codigo"] . "</td>";
        			                echo "<td>" . $filaBeneficios["nombre"] . "</td>";
        			                echo "<td>" . $filaBeneficios["descripcion"] . "</td>";
        			                echo "<td>" . "Activo"."</td>";
        			                echo "<td>" . $filaBeneficios["fecha_inicio"] . "</td>";
        			                foreach ($listaCategorias as $filaCategorias) {
        			                    if ($filaBeneficios["categoria_codigo"] == $filaCategorias["codigo"]) {
        			                        echo "<td>" . $filaCategorias["nombre"] . "</td>";
        			                        break;
        			                    }
        			                }
        			            }
        			        }
        			    }
        			}
                    else {
        			    foreach ($listaBeneficios as $filaBeneficios) {
        			        if ($filaBeneficios["estado"] == 1) {
        			            echo "<tr>";
        			            echo "<td>" . $filaBeneficios["codigo"] . "</td>";
        			            echo "<td>" . $filaBeneficios["nombre"] . "</td>";
        			            echo "<td>" . $filaBeneficios["descripcion"] . "</td>";
        			            echo "<td>" . "Activo" . "</td>";
        			            echo "<td>" . $filaBeneficios["fecha_inicio"] . "</td>";
        			            foreach ($listaCategorias as $filaCategorias) {
        			                if ($filaBeneficios["categoria_codigo"] == $filaCategorias["codigo"]) {
        			                    echo "<td>" . $filaCategorias["nombre"] . "</td>";
        			                    break;
        			                }
        			            }
        			        }
        			    }
        			}
        			?>
				</table>
			</div>
		</section>
	<?php 
	}
}
	?>
</body>
</html>
