<?php
 
function logEvent($message, $type = "INFO") {
    $logFile = "DATA_log.txt";
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = "[$timestamp][$type] - $message\n";
 
    if (!file_exists($logFile)) {
        touch($logFile);
    }
 
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}
 
?>