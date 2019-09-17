<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name=$_POST['ProductName'];
	$age=$_POST['ProductDescription'];
	$email=$_POST['ProductPrice'];	
	
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
	} else {	
		//updating the table
		$sql = "UPDATE users SET =ProductName:ProductName, ProductDescription=:ProductDescription, ProductPrice=:ProductPrice WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':ProductName', $ProductName);
		$query->bindparam(':ProductDescription', $ProductDescription);
		$query->bindparam(':ProductPrice', $ProductPrice);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM users WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$name = $row['ProductName'];
	$age = $row['ProductDescription'];
	$email = $row['ProductPrice'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>ProductName</td>
				<td><input type="text" name="ProductName" value="<?php echo $ProductName;?>"></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="ProductDescription" value="<?php echo $ProductDescription;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="ProductPrice" value="<?php echo $ProductPrice;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
