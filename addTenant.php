<!DOCTYPE html>
<html>
    <head>
        <title>Add Tenant</title>
    </head>
    <body>
	    <?php echo 
		'<form method="post"> 
		 ID: <input type="text" name="id" maxlength="255" size="50"><br>
		 Name: <input type="text" name="name" maxlength="255" size="50"><br>
         Phone Number: <input type="text" name="phone" maxlength="511" size="50"><br>
		 Email: <input type="email" name="email" maxlength="255" size="50"><br>
		 Check-in Date: <input type="date" name="in_date" maxlength="255" size="50"><br>
		 Check-out Date: <input type="date" name="out_date" maxlength="255" size="50"><br>
		 Apartment Number: <input type="text" name="apartment_number" maxlength="255" size="50"><br>
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
					$name = $_POST['name'];
					$phone = $_POST['phone'];
					$email = $_POST['email'];
					$in_date = $_POST['in_date'];
					$out_date = $_POST['out_date'];
					$apartment_number = $_POST['apartment_number'];
					
					$sql = "INSERT INTO tenant (`ID`, `name`, `phone`, `email`, `in_date`, `out_date`, `apartment`) VALUES ('$id','$name','$phone','$email','$in_date','$out_date','$apartment_number')";
                    $sql1 = "INSERT INTO user (`ID`, `type`) VALUES ('$id', 'tenant')";
					
					if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
					  echo "New rent established";
					} else {
					  echo "Error adding tenant: " . $conn->error;
					}
				}
				
			}
			$conn->close();
		?> 

		<?php echo '<form method="POST" action="manager.php"> <input type="submit" value="Back to previous page"/> </form>'; ?>
    </body>
</html>