<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Comentario</title>
</head>
<body>
	<p>
		Se ha realizado un nuevo Comentario!
	</p>
	<p>
		Estos son los Comentarios del cliente:
	</p>
	<ul>
		<li>
			<strong>Nombre:</strong>
			{{ $nombrecliente }}
		</li>
		<li>
			<strong>E.mail:</strong>
			{{ $emailcliente }}
		</li>
		<li>
			<strong>Mensaje</strong>
			{{ $txtmensaje }}
		</li>
	</ul>
	<hr>
</body>
</html>