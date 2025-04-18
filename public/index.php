<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../'));

// Autoload simples
spl_autoload_register(function ($class) {
    $paths = [
        BASE_PATH . '/core/' . $class . '.php',
        BASE_PATH . '/app/Controllers/' . $class . '.php',
        BASE_PATH . '/app/Models/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});


require_once BASE_PATH . '/config/database.php';


require_once BASE_PATH . '/core/App.php';
