<!DOCTYPE html>
<head>
		<link rel="stylesheet" href="stylesheet.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.7/js/bootstrap.min.js"></script>
		<title>NOTAS</title>
</head>
<body>
		<div class="login">	
			<?php
			  session_start();			   
			  // Controlo si el usuario ya está logueado en el sistema.
			  if(isset($_SESSION['email'])){
				// Le doy la bienvenida al usuario.
				echo '<div class ="bienvenida">Bienvenido <strong>' . $_SESSION['email'] . '</strong> </br><a href="cerrar-sesion.php">cerrar sesión</a> </div>';
				
			  }else{
				// Si no está logueado lo redireccion a la página de login.
				header("HTTP/1.1 302 Moved Temporarily");
				header("Location: index.php");
			  }
			?>		
			<h2>MIS NOTAS</h2>
		</div>
		<div class="container">	
			<?php			
				$id = $_SESSION['id'];
				$conn=mysqli_connect("localhost","root","","notas_aprendices");
				$consulta_mysql="select * from tbnotas where id_usuario = '$id'";
				$resultado = $conn->query($consulta_mysql);  
					while($lista = $resultado->fetch_assoc()) {
						 echo "<div class ='cadacuadro'>".$lista["nota"]."</div>"; 
					}								
			?>									
		</div>
</body>
</html>