<?php

if (isset($_GET['file'])) {
    $fileName = urldecode($_GET['file']);
    $filePath = __DIR__ . '/output/' . $fileName;

    if (file_exists($filePath)) {
        // Forzar la descarga del archivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);

        // Eliminar el archivo después de la descarga
        unlink($filePath);
        exit;
    } else {
        echo "Error: Archivo no encontrado.";
    }
} else {
    echo "Error: No se especificó ningún archivo para descargar.";
}
