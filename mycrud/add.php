<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$ProductName = $_POST['ProductName'];
	$ProductDescription = $_POST['ProductDescription'];
	$ProductPrice = $_POST['ProductPrice'];
			
	// checking empty fields
	if(empty($ProductName) || empty($ProductDescription) || empty($ProductPrice)) {
				
		if(empty($ProductName)) {
			echo "<font color='red'>ProductName field is empty.</font><br/>";
		}
		
		if(empty($ProductDescription)) {
			echo "<font color='red'>ProductDescription field is empty.</font><br/>";
		}
		
		if(empty($ProductPrice)) {
			echo "<font color='red'>ProductPrice field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO users(ProductName,ProductDescription, ProductPrice) VALUES(:ProductName, :ProductDescription, :ProductPrice)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':ProductName', $ProductName);
		$query->bindparam(':ProductDescription', $ProductDescription);
		$query->bindparam(':ProductPrice', $ProductPrice);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
