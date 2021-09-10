<?php
   header('Access-Control-Allow-Origin: *');

   // Define database connection parameters
   $hn      = 'localhost';
   $un      = 'myhostin_main';            //username-of-database-here
   $pwd     = 'jgo2cDWXdA';                //password-for-database-here
   $db      = 'myhostin_hibridos'; //name-of-database
   $cs      = 'utf8';

   // Set up the PDO parameters
   $dsn  = "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
   $opt  = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo  = new PDO($dsn, $un, $pwd, $opt);

   // Retrieve specific parameter from supplied URL
   $key  = strip_tags($_REQUEST['key']);
   $table = strip_tags($_REQUEST['table']);
    if($table =="")
		$table="inventario";
   
         // Sanitise URL supplied values
  $producto = filter_var($_REQUEST['producto'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
  $existencia   = filter_var($_REQUEST['existencia'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
	$precio   = filter_var($_REQUEST['precio'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
  $proveedor   = filter_var($_REQUEST['proveedor'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
  $foto   = filter_var($_REQUEST['foto'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
	$nombre   = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
	$email   = filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
	$password   = filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);	

		 
   $data    = array();
   /*
   print_r("<pre>");
   print_r($_REQUEST);
   print_r("</pre>");
   */

   // Determine which mode is being requested
   switch($key)
   {
	  case "query" :
	  
	    switch($table)
        {
	      case "inventario" :
           // Attempt to query database table and retrieve data
           try {  
                $stmt    = $pdo->query('SELECT * FROM inventario ORDER BY id ASC');
                while($row  = $stmt->fetch(PDO::FETCH_OBJ))
                { 
                   // Assign each row of data to associative array
                  $data[] = $row;
                }

                // Return data as JSON
                echo json_encode($data);
            }
           catch(PDOException $e)
           {
                echo $e->getMessage();
           }
		  break;
	      case "usuario" :
           // Attempt to query database table and retrieve data
           try {  
		        //$recordID   =  filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);
		        //echo 'UPDATE usuario SET nombre = "'. $nombre. '",email= "'.$email. '",password = "'. $password.'" WHERE id=' . $recordID;
                $stmt    = $pdo->query('SELECT * FROM usuario ORDER BY id ASC');
                while($row  = $stmt->fetch(PDO::FETCH_OBJ))
                { 
                   // Assign each row of data to associative array
                  $data[] = $row;
                }

                // Return data as JSON
                echo json_encode($data);
            }
           catch(PDOException $e)
           {
                echo $e->getMessage();
           }
		  break;		  
		  default : echo json_encode(array('message' => 'Fail !! ... No Table Exist, Retry','status' => -1));
        }		   

      break;
      // Add a new record to the inventario table
      case "create":

	    switch($table)
        {
         case "inventario" :
          // Attempt to run PDO prepared statement
          try {
            $sql  = "INSERT INTO inventario(producto, existencia,precio,proveedor,foto) VALUES(:producto, :existencia,:precio,:proveedor,:foto)";
            $stmt    = $pdo->prepare($sql);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':existencia', $existencia, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
            $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_INT);	
			$stmt->bindParam(':foto', $foto, PDO::PARAM_INT);	
            $stmt->execute();

            echo json_encode(array('message' => 'Congratulations the record ' . $producto . ' was added to the database','status' => 1));
          }
          // Catch any errors in running the prepared statement
          catch(PDOException $e)
          {
			 
			 echo json_encode(array('message' => 'Something went wrong! into server addeding record','status' => -1)); 
			 //echo "{status : -1,message:'Something went wrong! into server addeding record'}";
             echo $e->getMessage();
          }
		 break;
         case "usuario" :	
          // Attempt to run PDO prepared statement
          try {
            //$sql  = "INSERT INTO usuario(nombre, email,password) VALUES('".$nombre."','".$mail."','".$password."')";
			$sql  = "INSERT INTO usuario(nombre, email,password) VALUES(:nombre,:email,:password)";
            $stmt    = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(array('message' => 'Congratulations the record ' . $nombre . ' was added to the database','status' => 1));
          }
          // Catch any errors in running the prepared statement
          catch(PDOException $e)
          {
			 
			 echo json_encode(array('message' => 'Something went wrong! into server addeding record','status' => -1)); 
			 //echo "{status : -1,message:'Something went wrong! into server addeding record'}";
             echo $e->getMessage();
          }

         break;
         default : echo json_encode(array('message' => 'Fail !! ... No Table Exist, Retry','status' => -1));		 
		 
		} 

      break;


      // Update an existing record in the inventario table
      case "update":

	    switch($table)
        {
         case "inventario" :
          // Attempt to run PDO prepared statement
          try {
                $recordID   =  filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);
                $sql = "UPDATE inventario SET producto = :producto, existencia = :existencia, precio= :precio, proveedor = :proveedor, foto = :foto WHERE id = :recordID";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
                $stmt->bindParam(':existencia', $existencia, PDO::PARAM_STR);
                $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
                $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_INT);
                $stmt->bindParam(':foto', $foto, PDO::PARAM_INT);
                $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
                $stmt->execute();
            echo json_encode(array('message' => 'Congratulations the record ' . $producto . ' was updated','status' => 1));
          }
          // Catch any errors in running the prepared statement
          catch(PDOException $e)
          {
			 
			 echo json_encode(array('message' => 'Something went wrong! into server updating record','status' => -1)); 
			 //echo "{status : -1,message:'Something went wrong! into server addeding record'}";
             //echo $e->getMessage();
          }
		 break;
         case "usuario" :	
          // Attempt to run PDO prepared statement
          try {
			   $recordID   =  filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);
               //$sql  = 'UPDATE usuario SET nombre = "'. $nombre. '",email= "'.$email. '",password = "'. $password.'" WHERE id=' . $recordID;
			   $sql  = 'UPDATE usuario SET nombre = :nombre,email= :email ,password = :password WHERE id= :recordID';
               $stmt    = $pdo->prepare($sql);
               $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
               $stmt->bindParam(':email', $email, PDO::PARAM_STR);
               $stmt->bindParam(':password', $password, PDO::PARAM_INT);
			   $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
               $stmt->execute();

            echo json_encode(array('message' => 'Congratulations the record ' . $nombre . ' was updated to the database','status' => 1));
          }
          // Catch any errors in running the prepared statement
          catch(PDOException $e)
          {
			 
			 echo json_encode(array('message' => 'Something went wrong! into server addeding record','status' => -1)); 
			 //echo "{status : -1,message:'Something went wrong! into server addeding record'}";
             //echo $e->getMessage();
          }

         break;
         default : echo json_encode(array('message' => 'Fail !! ... No Table Exist, Retry','status' => -1));		 
		 
		} 

      break;



      // Remove an existing record in the inventario table
      case "delete":

	    switch($table)
        {
         case "inventario" :
         // Sanitise supplied record ID for matching to table record
         $recordID   =  filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);

         // Attempt to run PDO prepared statement
         try {
            $pdo  = new PDO($dsn, $un, $pwd);
            $sql  = "DELETE FROM inventario WHERE id = :recordID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
            $stmt->execute();
            
			echo json_encode(array('message' => 'Congratulations the record was deleted','status' => 1));
			//echo "{status : 1,message:'Congratulations the record was uopdate'}";
            //echo json_encode('Congratulations the record ' . $name . ' was removed');
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
			echo json_encode(array('message' => 'Something went wrong! into server deleting record','status' => -1));   
		    //echo "{status : -1,message:'Something went wrong! into server deleting record'}";
            //echo $e->getMessage();
         }
		 break;
		 
         case "usuario" :
         // Sanitise supplied record ID for matching to table record
         $recordID   =  filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);

         // Attempt to run PDO prepared statement
         try {
            $pdo  = new PDO($dsn, $un, $pwd);
            $sql  = "DELETE FROM usuario WHERE id = :recordID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
            $stmt->execute();
            
			echo json_encode(array('message' => 'Congratulations the record was deleted','status' => 1));
			//echo "{status : 1,message:'Congratulations the record was uopdate'}";
            //echo json_encode('Congratulations the record ' . $name . ' was removed');
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
			echo json_encode(array('message' => 'Something went wrong! into server deleting record','status' => -1));   
		    //echo "{status : -1,message:'Something went wrong! into server deleting record'}";
            //echo $e->getMessage();
         }
		 break;
		 default : echo json_encode(array('message' => 'Fail !! ... No Table Exist, Retry','status' => -1)); 
		} 

      break;
	  
	  case "auth":
	      case "usuario" :
           // Attempt to query database table and retrieve data
           try {  
		        //echo "SELECT * FROM usuario where email= '".$email."' and password=  '".$password."'";
                $stmt    = $pdo->query("SELECT * FROM usuario where email= '".$email."' and password=  '".$password."'");
                //$stmt    = $pdo->prepare($sql);
                //$stmt->bindParam(':email', $email, PDO::PARAM_STR);
               // $stmt->bindParam(':password', $password, PDO::PARAM_INT);
                $stmt->execute();				
                while($row  = $stmt->fetch(PDO::FETCH_OBJ))
                { 
                   // Assign each row of data to associative array
                  $data[] = $row;
                }
                if(!$data)
				   //echo json_encode(array('id' => '0','email' => '_','password' => '_'));
                   echo json_encode(array(array('id' => '_','nombre' => '','email' => '','password' => '','status' => -1,'message' => 'Usuario Invalido'))); 				
                // Return data as JSON
				else
				{
                  //$data[]["status"] = 1;	
                  //print_r($data);				  
                  echo json_encode($data);
				}  
            }
           catch(PDOException $e)
           {
			    echo json_encode(array('message' => 'Something went wrong! validating user','status' => -1)); 
                //echo $e->getMessage();
           }
		  break;	    
	  break;
	  case "camera":
            
           // Attempt to query database table and retrieve data
           try {  
                  header('Access-Control-Allow-Origin: *');
                  $target_path = "uploads/";
 
                  $target_path = $target_path . basename( $_FILES['file']['name']);
                  $filename2='pictures/pic_'.date("YmdHis").'.jpg'; //Ok
				  $file=$_GET['fileName']; 
	              $filename = 'pictures/'.$file;
				  
                  if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                       echo "Upload and move success";
                  } 
				  else {
                     echo $target_path;
                        echo "There was an error uploading the file, please try again!";
                  }

           } // Fin Try
           catch(Exception $e)
           {
			    echo json_encode(array('message' => 'Something went wrong! validating user','status' => -1)); 
                //echo $e->getMessage();
           }
    
	  break;	  
	  default : echo json_encode(array('message' => 'Fail !! ... No Method Exist, Retry','response' => -1,'status' => 1));   
   }
   


?>

