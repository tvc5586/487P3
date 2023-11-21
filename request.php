<!DOCTYPE html>
<html>
    <head>
        <title>Maintenance Request</title>
    </head>
    <body>
	    <?php echo 
		// Currently only supports online image
		'<form method="post"> 
		 ID: <input type="text" name="id" maxlength="255" size="50"><br>
		 Apartment Number: <input type="text" name="apartment_number" maxlength="255" size="50"><br>
         Area: <input type="text" name="area" maxlength="511" size="50"><br>
		 Description: <input type="text" name="description" maxlength="255" size="50"><br>
		 Image link: <input type="text" name="image_link" maxlength="255" size="50"><br>
		 <input type="submit" name="updateAll" value="Submit"/> 		 
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
			
				if(isset($_POST['updateAll'])) {
					$id = $_POST['id'];
					$apartment_number = $_POST['apartment_number'];
					$area = $_POST['area'];
					$description = $_POST['description'];
					$image_link = $_POST['image_link']; // Currently only supports online image
					$datetime = date("Y-m-d h:i:sa");
					
					$sql = "SELECT ID, apartment FROM tenant WHERE ID = '$id'";
					
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							if($row["ID"] == $id && $row["apartment"] == $apartment_number) {
								
								$sql = "INSERT INTO request(`user_id`, `apartment`, `area`, `description`, `time`, `image_link`, `status`) 
										VALUES ('$id','$apartment_number','$area','$description','$datetime','$image_link','Pending')";

								if ($conn->query($sql) === TRUE) {
									echo "New request submitted";
								} else {
									echo "Request submission failed!";
								}
							} else {
								echo "You can only request maintenance for your own apartment!";
							}
						}
					}
				}
				
			}
			$conn->close();
		?> 

		<?php echo '<form method="POST" action="tenant.php"> <input type="submit" value="Back to previous page"/> </form>'; ?>
    </body>
</html>