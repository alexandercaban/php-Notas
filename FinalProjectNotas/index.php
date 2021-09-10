<!DOCTYPE html>
<html lang= "es">
	<head>
		<link rel="stylesheet" href="stylesheet.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.7/js/bootstrap.min.js"></script>
		<title>LOGIN</title>
	</head>
<body>
		<div class="login">
				<form class="form-vertical" action="login.php" method="post">
					<div class="col-sm-5">
					
					</div>	
					<div class="col-sm-3">
						<div class="input-group">													
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" name="email" id = "email" class="form-control" placeholder ="Email">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" name="password" id = "password" class="form-control" placeholder ="Contraseña">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-1">
							<button name="" class="btn btn-primary" class="form-control">Ingresar</button>
						</div>
						<div class= "mensaje">
						<?php
						if(isset($_GET['mensaje'])){
							$mensaje=$_GET['mensaje'];
							echo $mensaje;
						}
						?>
						</div>					
					</div>
					
				</form>	
		</div>
		<div class="formulario">
			<div class="col-sm-12">
			</br><label>FORMULARIO DE REGISTRO</label></br></br>
			</div>			
			<form class="form-horizontal" action="registro.php" method="post">			
					<div class="form-group">							
							<div class="col-sm-12">
							<label for="inputNombre" >Nombre</label>
							<input type="text" name="nombre" id = "nombre" class="form-control">
							</div>
					</div>			
					<div class="form-group">						
							<div class="col-sm-12">
							<label for="inputEmail" >Email</label>
							<input type="text" name="email" id = "email" class="form-control">
							</div>
					</div>
					<div class="form-group">							
							<div class="col-sm-12">
							<label for="inputContrasena" >Contraseña</label>
							<input type="password" name="contrasena" id = "contrasena" class="form-control">
							</div>
					</div>					
					<div class="form-group">							
							<div class="col-sm-12">
							<label for="inputCentro" >Centro de Formación</label>
							<select  type="text" name="centro" id = "centro" class="form-control" >
								<option value="">Seleccione...</option>
								<?php
									$conn=mysqli_connect("localhost","root","","notas_aprendices");
									$consulta_mysql="select * from tbcentro";
									$resultado = $conn->query($consulta_mysql);  
										while($lista = $resultado->fetch_assoc()) {
										   echo "<option  value='".$lista["id"]."'>".$lista["nombre_centro"]."</option>"; 
										}
								?>
							</select>
							</div>
					</div>
					<div class="form-group">
							<div class="col-sm-1">
							<button name="" class="btn btn-primary" class="form-control">Registrar</button>
							</div>
						
					</div>
<div class= "mensajeexito">
						<?php
						if(isset($_GET['mensajeexito'])){
							$mensaje=$_GET['mensajeexito'];
							echo $mensaje;
						}
						?>
						</div>				
			</form>			
		</div>
</body>
</html>