</!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Noticia Importante</title>
</head>
<body>
	<p><strong>Hola {{ $usuario->name }}</strong></p>
	<p>
		{{!! $contenido !!}}
	</p>
	<p>
		<a href="{{ config('app.url') }}">Cuarentena Blog</a>
	</p>
</body>
</html>