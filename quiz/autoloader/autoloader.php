<?php

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);

    $prefix = 'quiz/classes/';

    $file = $prefix . $className . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
