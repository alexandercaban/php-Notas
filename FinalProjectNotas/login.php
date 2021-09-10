<?php
  session_start();
  
  // Datos para conectar a la base de datos.
  $nombreServidor = "localhost";
  $nombreUsuario = "root";
  $passwordBaseDeDatos = "";
  $nombreBaseDeDatos = "notas_aprendices";
   
  // Obtengo los datos cargados en el formulario de login.
  $repuesta[0] = "";
  $email = $_POST['email'];
  $password = $_POST['password'];
   
  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
   
  // Validar la conexión de base de datos.
  if ($conn ->connect_error) {
    $repuesta[0] = $conn ->connect_error;
  }
  $arregloDatos = null;
  // Consulta segura para evitar inyecciones SQL.
  $sql = ("SELECT * FROM tbusuarios WHERE correo='$email' AND contrasena = '$password'");
  $resultado = $conn->query($sql);

  if ($resultado->num_rows > 0) {          
		while($row = $resultado->fetch_assoc()) {
            $arregloDatos[] = $row;
			$id = $row["id"];
        }
		// Guardo en la sesión el email del usuario.
		$_SESSION['email'] = $email;		
		$_SESSION['id'] = $id;
		// Redirecciono al usuario a la página principal del sitio.
		header("HTTP/1.1 302 Moved Temporarily");
		header("Location: notas.php");			
        $repuesta[0] = $arregloDatos;
    } else {
		header("HTTP/1.1 302 Moved Temporarily");
		
		header("Location: index.php?mensaje=Usuario o contraseña incorrectos. Intentelo nuevamente");			
        $repuesta[0] = false;
    }
		echo json_encode($arregloDatos);
?>