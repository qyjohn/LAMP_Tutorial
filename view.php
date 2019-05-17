<html>
<head>
<META http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title>Uploaded File</title>
</head>
<body>

<?php
session_start();
$session_id = session_id();
$server   = $_SERVER['SERVER_ADDR'];
echo "<H1>$server</H1><BR>\n";
echo "<HR>\n";
echo "Session: $session_id <BR>\n";
echo "<P>";
show_upload_records();

function show_upload_records()
{
        // Create a PDO connection
        $db = new PDO("mysql:host=localhost;dbname=demo;charset=utf8", "username", "password");
	// The SQL statement to retrieve the latest 20 records 
	$sql = "SELECT * FROM uploads ORDER BY timeline DESC LIMIT 20";
	// Execute the query 
	$statement = $db->prepare($sql);
	$statement->execute();
	// Display all records
	$images = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($images as $image)
        {
		$filename = $image['filename'];
		echo "<a href='uploads/$filename'>$filename</a><BR>\n";
	}
}
?>

</body> 
</html>
