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
```php
Diese Datei hochladen: <input name="userfile" type="file" />
<input type="hidden" name="MAX_FILE_SIZE" value="3000000 " />
