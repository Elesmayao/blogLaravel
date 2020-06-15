                                                  Manual instalación:

El blog está construido con el lenguaje PHP y el framework Laravel (Versión 5.8). Servidor Apache.

Para comenzar , creamos una BBDD con el nombre:
-	blogLaravel
Debemos de meter el proyecto en la siguiente dirección: 
Xampp/htdocs( Introducimos el proyecto en esta )

A continuación abrimos la consola ( cmd ) y nos dirigimos al proyecto.
“cd xampp/htdocs/blogLaravel”

Iniciamos el servicio con el comando:
“php artisan serve” , la cual nos dará una dirección la cual debemos de pegar en el navegador.
127.0.0.1:8000

Esta consola la debemos de dejar abierta, lo cual abrimos otra consola para hacer los siguientes pasos.

Cmd -> nos ubicamos en la carpeta bloglaravel ( xampp/htdocs/blogLaravel )

Antes de todo tenemos que tener iniciados los servicios ( Apache y MySQL )

Iniciamos las migraciones y los seeders con el comando:
“php artisan migrate:refresh  --seed”

Nos dirigimos a la BBDD

			PARA ADMINISTRADOR

 En la tabla users: 
-	Le damos un usuario “email_verified_at” una fecha para que tenga el correo verificado y le permita entrar.
En la tabla role_user: 
-	Buscamos la user_id del usuario que hemos hecho el paso anterior de la tabla users, y le damos un role_id(3)
En la tabla roles:
-	Cambiamos los nombres de rol ( Aparecen por defecto los tres en (usuario) ) donde:
o	 id 1 tendrá nombre usuario
o	 id 2 tendrá nombre moderador
o	 id 3 tendrá nombre administrador 
( Debes de ponerlo tal cual para que no haya problemas ) 
Por último nos dirigimos a la tabla users y copiamos el email del usuario al que hemos asignado como administrador.
Nos dirigimos al blog y clickeamos en login, introducimos el correo copiado y la contraseña por defecto de todos los usuarios que se crean automáticamente es “12345”
Nos aparecerá el perfil del usuario y arriba a la derecha nos indica un desplegable con su nombre, vemos si ese desplegable tiene “Panel Admin”, accedemos y veríamos su panel.
(Si no sale el panel admin, vuelve a realizar los pasos)

				PARA MODERADOR
En la tabla users: 
-	Le damos un usuario “email_verified_at” una fecha para que tenga el correo verificado y le permita entrar.
En la tabla role_user: 
-	Buscamos la user_id del usuario que hemos hecho el paso anterior de la tabla users, y le damos un role_id(2)
En la tabla roles:
-	Cambiamos los nombres de rol ( Aparecen por defecto los tres en (usuario) ) donde:
o	 id 1 tendrá nombre usuario
o	 id 2 tendrá nombre moderador
o	 id 3 tendrá nombre administrador
Por último nos dirigimos a la tabla users y copiamos el email del usuario al que hemos asignado como moderador. 
Nos dirigimos al blog y clickeamos en login, introducimos el correo copiado y la contraseña por defecto de todos los usuarios que se crean automáticamente es “12345”
Nos aparecerá el perfil del usuario y arriba a la derecha nos indica un desplegable con su nombre, vemos si ese desplegable tiene “Panel Moderador”, accedemos y veríamos su panel.
(Si no sale el panel moderador, vuelve a realizar los pasos)

				




USUARIO REGISTRADO
En la tabla users: 
-	Le damos un usuario “email_verified_at” una fecha para que tenga el correo verificado y le permita entrar.
En la tabla role_user: 
-	Buscamos la user_id del usuario que hemos hecho el paso anterior de la tabla users), por defecto todos los usuarios tienen role_id ( 1 ) lo cual no debemos de hacer ningún cambio, si no estuviera así debemos de darle valor (1).
En la tabla roles:
-	Cambiamos los nombres de rol ( Aparecen por defecto los tres en (usuario) ) donde:
o	 id 1 tendrá nombre usuario
o	 id 2 tendrá nombre moderador
o	 id 3 tendrá nombre administrador

Por último nos dirigimos a la tabla users y copiamos el email del usuario al que hemos asignado como moderador. 
Nos dirigimos al blog y clickeamos en login, introducimos el correo copiado y la contraseña por defecto de todos los usuarios que se crean automáticamente es “12345”
Nos aparecerá el perfil del usuario y arriba a la derecha nos indica un desplegable con su nombre, donde solo tendrá acceso al “Perfil” de usuario
(Si no sale el perfil, vuelve a realizar los pasos)


                                                         Manual Usuario:

Encabezado:
	- Registro: Donde pueder registrarse
	- Login: Donde poder iniciar sesión
	- Desplegable: Temas principales
	- Botón de inicio: para poder volver a la página principal

Una vez iniciado sesión: 

	  - Usuario registrado y verificado:
		- Nombre de usuario en el encabezado con un desplegable, el cual le aparece el perfil ( Donde puede modificar sus datos ) y para           poder cerrar sesión.
	  - Usuario tipo moderador: 
	    	- Nombre de usuario en el encabezado con un desplegable, el cual le aparece el panel moderador ( Donde podrá añadir, editar y             eliminar sus artículos), el perfil ( Donde puede modificar sus datos ) y para poder cerrar sesión.
        - Botón ( Blog para volver a la página de inicio )
	  - Usuario tipo administrador:
		  - Nombre de usuario en el encabezado con un desplegable, el cual le aparece el panel administrador
        Donde podrá:
			    - Añadir, editar y eliminar un tema
		  	  - Añadir un artículo y buscar, editar y eliminar un artículo de cualquier usuario 
		  	  - Buscar un usuario y editar sus permisos
			    - Enviar un correo masivo a todos los usuarios 
		      - Botón ( Blog para volver a la página de inicio )
