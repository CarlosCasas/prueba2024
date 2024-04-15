<?php

// app/autoload.php

spl_autoload_register(function ($className) {
    // Define el directorio base de tu proyecto
    $baseDir = __DIR__ . '/';

    // Mapea el espacio de nombres a los directorios de archivos
    $namespace = 'App\\';
    $directory = str_replace($namespace, '', $className);
    $file = $baseDir . str_replace('\\', '/', $directory) . '.php';

    // Incluye el archivo si existe
    if (file_exists($file)) {
        require_once $file;
    }
});
