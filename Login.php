<!doctype html>
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
  
	<form action="ValidarSesion.php" method="GET">
    	<div>
    		<label class="label" for="rut">Usuario</label>
    		<input class="input" style="width : 300px" type="text" name="rut">
    	</div>
    	<div>
    		<label class="label" for="clave">Clave</label>
    		<input class="input" style="width : 300px" type="password" name="clave">
    	</div>
    	<div>
    		<input class="button is-link" type="submit" name="ingresar" value="Ingresar">
    	</div>
    </form>
</body>
</html>