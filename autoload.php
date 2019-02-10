<?php

spl_autoload_register(function($className) {
    $prefix = 'Classes\\';
    $base_dir = __DIR__ . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR;

    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        return;
    }
    $relative_class = substr($className, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});