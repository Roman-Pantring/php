<?php
class ImageUpload { 
	function __construct($maxwidth,$fieldname,$filetitle) {
       //print "Im BaseClass Konstruktor\n".$maxwidth.' '.$fieldname.'<br>';
		$this->result_txt = "";
		$file = $filetitle;
		$this->filetitle = $filetitle;
		$this->fieldname = $fieldname;
		if(isset($_FILES[$fieldname])){
			if ($_FILES[$fieldname]['error'] == 0  && isset($_FILES[$fieldname]['error']) && $_FILES[$fieldname]['size']<=$_POST['MAX_FILE_SIZE'] ) {
				$name = $_FILES[$fieldname]['name'];
				$name_array = explode(".",$name);
				$filename = $file.'.'.$name_array[1];
				$this->filename = $filename;
				$path = '../img/movies/upload/';
				move_uploaded_file($_FILES[$fieldname]['tmp_name'], $path.$filename);
				chmod($path.$filename,0666);				
				// http://php.net/manual/de/function.imagecopyresized.php
				// http://php.net/manual/de/function.imagejpeg.php
				// Neue Größe berechnen
				list($width, $height) = getimagesize($path.$filename);
				
				// content Image
				$maxwidth = 800;
				$percent = $maxwidth/$width;
				$newwidth = $width * $percent;
				$newheight = ceil($height * $percent);
				// Bild laden
				if($newwidth<$width){
					$thumb = imagecreatetruecolor($newwidth, $newheight);
					$source = imagecreatefromjpeg($path.$filename);
					// Skalieren
					imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				}else{
					$thumb = imagecreatetruecolor($width, $height);
					$source = imagecreatefromjpeg($path.$filename);
					// Skalieren
					imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $width, $height);
				}				
				// Ausgabe
				$pathcontent = '../img/movies/content/';
				imagejpeg($thumb,$pathcontent.$filename,86);
				
				// thumbnail image
				$maxheight = 200;
				$percent = $maxheight/$height;
				$newwidth = ceil($width * $percent);
				$newheight = $height * $percent;			
				// Bild laden
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				$source = imagecreatefromjpeg($path.$filename);
				// Skalieren
				imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				// Ausgabe
				$pathcontent = '../img/movies/thumbs/';
				imagejpeg($thumb,$pathcontent.$filename,86);
				
				// Reult Text
				$this->result_txt .= ("<p>File $name uploaded succesfully!</p>");			
			}
		}
	}    
	function deleteImg(){
		if(isset($_POST['deleteImg'])){			
			//echo 'delete img = '.$_POST['deleteImg'].'<br>';
			$pathcontent = '../img/movies/content/';
			$file = $pathcontent.$this->filetitle.'.jpg';		
			if(file_exists($file)){
				//echo($file);
				unlink($file);
			}
			$pathcontent = '../img/movies/thumbs/';
			$file = $pathcontent.$this->filetitle.'.jpg';		
			if(file_exists($file)){
				//echo($file);
				unlink($file);
			}
		}
	}
} 