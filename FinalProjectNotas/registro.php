<?php
    
    $nombreServidor = "localhost";
    $nombreUsuario = "root";
    $passwordBaseDeDatos = "";
    $nombreBaseDeDatos = "notas_aprendices";
      
		$repuesta[0] = "";
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
		$contrasena = $_POST["contrasena"];
		$centro = $_POST["centro"];		
    
    // Create connection
    $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
    // Check connection
    if ($conn->connect_error) {
        $repuesta[0] = $conn->connect_error;
    }  
        $sql = "INSERT INTO tbusuarios VALUES (null, '$nombre', '$email', '$contrasena', '0', '$centro',  '0',  '0')";

        if ($conn->query($sql) === TRUE) {			
				$destinatario =  $email; 
				$asunto = "Correo de Confirmacion de Registro"; 
				$cuerpo = ' 
				<html> 
				<head> 
				   <title>Correo de Confirmacion de Registro</title> 
				</head> 
				<body>  
				<p> 
				<b>Bienvenidos a la comunidad Sena, tus credenciales de acceso son las siguientes: '.$email.' y tu clave es '.$contrasena.' </b>.  
				</p> 
				</body> 
				</html> 
				'; 
				//para el envío en formato HTML 
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

				//dirección del remitente 
				$headers .= "From: Sena <acabanillas@sena.edu.co>\r\n"; 

				mail($destinatario,$asunto,$cuerpo,$headers);
			
			header("HTTP/1.1 302 Moved Temporarily");
			header("Location: index.php?mensajeexito=Registro Satisfactorio. Se ha enviado un correo de Confirmaciòn");		
            $repuesta[0] = "Registro Satisfactorio";
        } else {
            $repuesta[0] = $conn->error;
        }
	echo json_encode($repuesta);
?>