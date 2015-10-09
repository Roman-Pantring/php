# ImageUpload Class

```php
<?php
require_once 'lib/class/ImageUpload.php';

// Image File Upload
$img = new ImageUpload(800,'userfile',$file);
$img->deleteImg();
?>
```
### HTML
```html
<label for="deleteImg">Delete Image</label><input type="checkbox" name="deleteImg" id="deleteImg"><br>

Diese Datei hochladen: <input name="userfile" type="file" />
<input type="hidden" name="MAX_FILE_SIZE" value="3000000 " />
