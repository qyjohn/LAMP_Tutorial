
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
        // Obtain the name of the uploaded file
        $filename = $uploadedFile["name"];
        // Decide the path of the target file
        $targetFile  = $folder."/".$filename;
        // Move the uploaded file to the target file
        move_uploaded_file($uploadedFile["tmp_name"], $targetFile);
        // Echo the download URL back to the end user
        echo "<a href='$targetFile'>$targetFile</a>";
}
?>

</body>
</html>
