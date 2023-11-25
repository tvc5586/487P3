<!DOCTYPE html>
<html>
    <head>
        <title>Maintenance</title>
    </head>
    <body>
	    <?php echo 
		'<form method="post"> 
         <input type="submit" name="sortApartmentNumber" value="Sort by Apartment Number"/> 
         <input type="submit" name="sortArea" value="Sort by Area"/> 
		 <input type="submit" name="sortDate" value="Sort by Date Range"/>
		 <input type="submit" name="sortStatus" value="Sort by Status"/>
		 <input type="submit" name="default" value="Default"/><br>
		 Start Date: <input type="date" name="start_date" maxlength="255" size="50">
		 End Date: <input type="date" name="end_date" maxlength="255" size="50"><br>
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
			
				if(isset($_POST['sortApartmentNumber'])) {
					$sql = "SELECT ID, user_id, apartment, area, description, time, image_link, status FROM request ORDER BY apartment";
				} 
				elseif(isset($_POST['sortArea'])) {
					$sql = "SELECT ID, user_id, apartment, area, description, time, image_link, status FROM request ORDER BY area";
				}
				elseif(isset($_POST['sortDate'])) {
					$start_date=$_POST['start_date'];
					$end_date=$_POST['end_date'];
					
					$sql = "SELECT ID, user_id, apartment, area, description, time, image_link, status FROM request WHERE time >= '$start_date' AND time <= '$end_date'";
				}
				elseif(isset($_POST['sortStatus'])) {
					$sql = "SELECT ID, user_id, apartment, area, description, time, image_link, status FROM request ORDER BY status";
				}
				elseif(isset($_POST['default'])) {
					$sql = "SELECT ID, user_id, apartment, area, description, time, image_link, status FROM request";
				} else {
					$sql = "SELECT ID, user_id, apartment, area, description, time, image_link, status FROM request";
				}
				
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "Request ID: " . $row["ID"]. " Submitted Time: " . $row["time"]. '<br>';
						echo "Tenant ID: " . $row["user_id"]. '<br>';
						echo "Apartment Number: " . $row["apartment"]. '<br>';
						echo "Area: " . $row["area"]. '<br>';
						echo "Description: " . $row["description"]. "<br>";
					
						$image = $row["image_link"];
						if($image != NULL) {
							$imageData = base64_encode(file_get_contents($image));
							echo "Photo provided: <br>".'<img src="data:image/jpeg;base64,'.$imageData.'"><br>';
						}
						
						echo "Status: " . $row["status"]. "<br>";
						
						echo "\r\n". "<br>";
					}
				} else {
					echo "0 results";
				}
			}
			$conn->close();
		?> 

		<?php echo 
		'<form method="post"> 
		 Request ID: <input type="int" name="request_id" maxlength="255" size="5">
		 <input type="submit" name="complete" value="Mark Complete"/><br>
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
			
				if(isset($_POST['complete'])) {
					$id = $_POST['request_id'];
					
					$sql = "UPDATE request SET status='Complete' WHERE id='$id'";

					if ($conn->query($sql) === TRUE) {
					  echo "Request $id completed";
					} else {
					  echo "Error updating request: " . $conn->error;
					}
				}
			}
			$conn->close();
			
		?> 

		<?php echo '<form method="POST" action="index.php"> <input type="submit" value="Logout"/> </form>'; ?>
    </body>
</html>