<?php
require_once '../lib/class/ImageUpload.php';
// Image File Upload
if(isset($_FILES['userfile'])){
	$file = $_FILES['userfile']['name'];
	$img = new ImageUpload(800,'userfile',$file);
	$img->deleteImg();
	echo($img->result_txt);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ImageUpload</title>
</head>

<body>
<?php if(!isset($_FILES['userfile'])): ?>
<form enctype="multipart/form-data" action="index.php" method="POST">
<label for="deleteImg">Delete Image</label><input type="checkbox" name="deleteImg" id="deleteImg"><br>

Diese Datei hochladen: <input name="userfile" type="file" />
<input type="hidden" name="MAX_FILE_SIZE" value="3000000 " />
<input type="submit" value="Submit">
</form>
<?php else: ?>
<?php 
echo("<img src='../img/movies/upload/".$_FILES['userfile']['name']."'><br>");
echo("<img src='../img/movies/content/".$_FILES['userfile']['name']."'><br>");
echo("<img src='../img/movies/thumbs/".$_FILES['userfile']['name']."'><br>");
?>
<?php endif ?>

</body>

</html> 
