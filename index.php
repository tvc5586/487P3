<!DOCTYPE html>
<html>
    <head>
        <title>Main</title>
    </head>
    <body>
		<?php echo 
		'<form method="post"> 
		 ID: <input type="text" name="id" maxlength="255" size="50"><br>
		 <input type="submit" name="login" value="Login"/> 		 
		 </form>';
		?>
		
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "p3";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} else {
			
				if(isset($_POST['login'])) {
					$id = $_POST['id'];
					
					$sql = "SELECT ID, type FROM user WHERE ID='$id'";
				
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							if ($row["type"] == "tenant") {
								header("Location: tenant.php");
								exit();
							}
							
							elseif ($row["type"] == "maintenance") {
								header("Location: maintenance.php");
								exit();
							}
							
							elseif ($row["type"] == "manager") {
								header("Location: manager.php");
								exit();
							}
						}
					} else {
						echo "Login Failed";
					}
				}
					
			}
			$conn->close();
		?> 
		
    </body>
</html>