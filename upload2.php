
<html>
<head>
<META http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title>Uploaded File</title>
</head>
<body>

<?php
if (isset($_FILES["fileToUpload"]))
{
	save_upload_to_hd($_FILES["fileToUpload"], "uploads");
}

function save_upload_to_hd($uploadedFile, $folder)
{
	// Obtain the IP address of the end user
	$address = $_SERVER['REMOTE_ADDR'];
	// Obtain the name of the uploaded file
	$filename = $uploadedFile["name"];
	// Decide the path of the target file
	$targetFile  = $folder."/".$filename;
	// Move the uploaded file to the target file
	move_uploaded_file($uploadedFile["tmp_name"], $targetFile);
	// Write a record to the database
	save_upload_record($address, $filename);
	// Echo the download URL back to the end user
	echo "<a href='$targetFile'>$targetFile</a>";
}

function save_upload_record($address, $filename)
{
	// Create a PDO connection
	$db = new PDO("mysql:host=localhost;dbname=demo;charset=utf8", "username", "password");
	// The SQL statement to INSERT a record into the uploads table
	$sql = "INSERT INTO uploads (address, filename) VALUES (?, ?)";	
	// Use prepared statement to update the database
	$statement = $db->prepare($sql);
	$statement->execute(array($address, $filename));
}
?>

</body>
</html>
