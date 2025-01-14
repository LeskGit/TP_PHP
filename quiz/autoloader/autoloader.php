<?php

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);

    $prefix = __DIR__ . "/../classes/";

    $file = $prefix . $className . '.php';

    var_dump($file);

    if (file_exists($file)) {
        require $file;
    }
});
