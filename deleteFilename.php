<?php
require_once 'logger.php';
 
$uploadDir = "upload";
 
if (isset($_GET['file'])) {
    $fileToDelete = $_GET['file'];
    $filePath = $uploadDir . DIRECTORY_SEPARATOR . $fileToDelete;
 
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            logEvent("Удалено: $fileToDelete", "INFO");
            header("Location: index.php"); 
            exit;
        } else {
            logEvent("Ошибка при удалении: $fileToDelete", "ERROR");
        }
    } else {
        logEvent("Файл $fileToDelete несуществует", "ERROR");
    }
}
 
header("Location: index.php"); 
exit;
?>