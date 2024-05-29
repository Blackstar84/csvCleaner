<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    // Asegurarse de que la carpeta de salida existe
    $outputDir = __DIR__ . '/output';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $allowedfileExtensions = ['csv'];

    if (in_array($fileExtension, $allowedfileExtensions)) {
        $cleanedData = [];
        $buffer = '';
        $insideQuotes = false;

        // Leer el archivo CSV en codificación UTF-8
        if (($handle = fopen($fileTmpPath, 'r')) !== false) {
            while (($line = fgets($handle)) !== false) {
                $line = mb_convert_encoding($line, 'UTF-8', 'auto');
                $buffer .= $line;

                // Verificar si estamos dentro de comillas
                $quoteCount = substr_count($line, '"');
                if ($quoteCount % 2 != 0) {
                    $insideQuotes = !$insideQuotes;
                }

                // Si no estamos dentro de comillas, procesamos la línea
                if (!$insideQuotes) {
                    $data = str_getcsv($buffer);
                    $cleanedRow = [];
                    foreach ($data as $cell) {
                        $cell = str_replace(array("\r", "\n"), ' ', $cell); // Eliminar saltos de línea dentro de las celdas
                        $cleanedCell = strip_tags($cell);
                        $cleanedRow[] = $cleanedCell;
                    }
                    $cleanedData[] = $cleanedRow;
                    $buffer = ''; // Resetear el buffer para la siguiente línea
                }
            }
            fclose($handle);
        }

        // Generar un nombre único para el archivo de salida
        $cleanedFileName = 'cleaned_' . time() . '.csv';
        $outputFile = $outputDir . '/' . $cleanedFileName;

        // Escribir los datos limpios en un nuevo archivo CSV en UTF-8
        if (($handle = fopen($outputFile, 'w')) !== false) {
            // Añadir BOM para UTF-8
            fwrite($handle, "\xEF\xBB\xBF");
            foreach ($cleanedData as $cleanedRow) {
                fputcsv($handle, $cleanedRow);
            }
            fclose($handle);
            // Redirigir a la página principal con el nombre del archivo para descargar
            header('Location: index.php?file=' . urlencode($cleanedFileName));
            exit;
        } else {
            echo "Error al abrir el archivo para escritura: $outputFile";
        }
    }
}