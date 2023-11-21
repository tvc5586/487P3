<!DOCTYPE html>
<html>
    <head>
        <title>Edit Tenant</title>
    </head>
    <body>
	    <?php echo 
		'<form method="post"> 
		 ID: <input type="text" name="id" maxlength="255" size="50"><br>
		 Apartment Number: <input type="text" name="apartment_number" maxlength="255" size="50"><br>
		 <input type="submit" name="move" value="Move Tenant"/> 
		 <input type="submit" name="delete" value="Delete Tenant"/> 
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
			
				if(isset($_POST['move'])) {
					$id = $_POST['id'];
					$apartment_number = $_POST['apartment_number'];
					
					$sql = "UPDATE tenant SET `apartment`='$apartment_number' WHERE `ID`='$id'";
					
					if ($conn->query($sql) === TRUE) {
					  header("Location: editTenant.php");
					  exit();
					} else {
					  echo "Error: " . $conn->error;
					}
					
				} 
				elseif(isset($_POST['delete'])) {
					$id = $_POST['id'];
					
					$sql = "DELETE FROM tenant WHERE `ID`='$id'";
					$sql1 = "DELETE FROM user WHERE `ID`='$id'";
					
					if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
					  header("Location: editTenant.php");
					  exit();
					} else {
					  echo "Error: " . $conn->error;
					}
					
				} else {
					$sql = "SELECT `ID`, `name`, `phone`, `email`, `in_date`, `out_date`, `apartment` FROM tenant";
					
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "Tenant ID: " . $row["ID"]. "<br>";
							echo "Tenant Name: " . $row["name"]. '<br>';
							echo "Tenant Phone: " . $row["phone"]. "<br>";
							echo "Tenant Email: " . $row["email"]. "<br>";
							echo "Tenant Apartment: " . $row["apartment"]. "<br>";
							echo "Tenant Rental Period: From " . $row["in_date"]. " to " . $row["out_date"]. "<br>";
					
							echo "\r\n". "<br>";
						}
					} else {
						echo "0 results";
					}
				}
				
			}
			$conn->close();
		?> 

		<?php echo '<form method="POST" action="manager.php"> <input type="submit" value="Back to previous pagee"/> </form>'; ?>
    </body>
</html>