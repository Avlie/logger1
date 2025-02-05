<?php
$uploadDir = "upload";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777);
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', ' application/docx', 'application/txt'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx', 'txt'];
 
    $fileName = $_FILES['file']['name'];
    $fileType = mime_content_type($_FILES['file']['tmp_name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
 
    if (in_array($fileType, $allowedTypes) && in_array($fileExtension, $allowedExtensions)) {
        
        echo "Файл принят.<br>";
 
        
        $newFilename = mb_strtolower($fileName, 'UTF-8');
        $newFilename = str_replace(['ą', 'ę', 'ć', 'ń', 'ó', 'ś', 'ż', 'ź', ' '], ['a', 'e', 'c', 'n', 'o', 's', 'z', 'z', '_'], $newFilename); // Added space replacement
        $newFilename = preg_replace('/[^a-zA-Z0-9._-]/', '', $newFilename); 
        $newFilename = preg_replace('/\.{2,}/', '.', $newFilename); 
        
        $targetPath = $uploadDir. DIRECTORY_SEPARATOR. $newFilename;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            echo "Файл успешно загружен: ". $targetPath;
        } else {
            echo "Ошибка загрузки файла.";
        }
 
    } else {
        echo "Недопустимый тип или расширение файла.";
    }
    echo "<h2>Файлики:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Название</th><th>Удалить</th></tr>";
 
    $files = scandir($uploadDir);
    foreach ($files as $file) {
        if ($file != ".") { 
            echo "<tr><td>$file</td><td><a href='deleteFilename.php?file=$file'>Удалить</a></td></tr>";
        }
    }
    echo "</table>";

}?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
</head>
 
<body>
    <div class="container">
        <form method="POST" enctype="multipart/form-data">  <fieldset>
            <input class="text"  type="text" >
                <input id="file" class="form-control" type="file" name="file" required> <button class="button" type="submit" name="submit">Wyślij</button>
            </fieldset>
        </form>

    </div>
</body>
 
</html>